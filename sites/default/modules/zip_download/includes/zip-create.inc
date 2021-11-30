<?php


function getSourceAndDestinationDirectories()
{
	$item_id = $_POST["Item_ID"];
	$contact_id = $_POST["contact_id"];
	$download_index = $_POST["pdfi"];

	$product = getProduct( $item_id );
	$filename = substr($product["DownloadLocation"],strrpos($product["DownloadLocation"],'\\')+1);

	// determine filenames for these products
	$source_dir = "\\inetpub\\ocdla\\uploads\\";//this is the Directory of files from which the ZIP file will be created
	$new_dir = "\\inetpub\\ocdla\\html\\downloads\\";
	$old_filename = $source_dir."{$filename}_{$session->getUsername()}".".zip";
	$new_filename = $new_dir."{$filename}_{$session->getUsername()}".".zip";

	// the link that will be produced to the file
	$link = "/downloads/{$filename}_{$session->getUsername()}".".zip";
}


function overwriteZipFile()
{
	if(file_exists($old_filename)) unlink( $old_filename );	
	/**
	 * Otherwise, someone is accessing this file as an ANONYMOUS user
	 * so the index specified in the querystring should be a valid
	* index in the PDFdownloads folder
	 */
	$username=$session->getUsername(); 
	if(empty($username)) $download = anonymousDownloadInfo($download_index);
	$output = createZip($filename, $session->getUsername(), $new_dir); 
	fileMoveToPublicDir($old_filename, $new_filename);
}

/**
 * lookup the download location from the ocdla.catalog table
 * currently the download location is in /inetpub/ocdla/uploads/some_file
 * we've place the download folder outside of the root directory so users don't have easy access to these documents
 */
function getProduct($item_id)
{
	$product = new DBQuery(
		$params = array(
			"type"	=>	"select",
			"tablenames"	=> array(
				0	=> array(
					"name"	=>	"catalog",
					"op"	=>	"",
					"fields"	=>	array()
				)
			),
			"where"	=> array(
				"i={$item_id}"
			)
		)
	);
	$product = $product->exec();
	return $product[0];
}



function anonymousDownloadInfo($index)
{
	global $username, $password;
	$query = "SELECT * FROM downloads WHERE i=$index";
	$result = mysql_query( $query );
	
	//this wasn't a valid index, so we can't identify the purchase
	if(mysql_num_rows($result) !== 1)
	{
		throw new Exception("Your request could not be processed.");
	}
	
	/**
	 * otherwise a password was dynamically generated for this archive AND
	 * that password takes the place of the username usually appended to the ZIP archives to make them unique
	 * but, just in case, if the password is somehow empty then we don't want an uprotected ZIP archive to be generated -
	 * so throw an error
	 */
	$download = mysql_fetch_assoc( $result );
	$username = $download["password"];
	if(empty($username)) throw new Exception("Anonymous user download: Password cannot be empty.");
	
	//otherwise, if everything is ok, then assign the passphrase as the username for this document
	$password = "";
	return $download;	
}



/** FUNCTIONS***
 * use the "zip" command to archive a folder; the zip command is run from inside of the source directory
 * that way the file structure isn't copied into the archive.
 * if an archive already exists for a particular username, delete it first before executing the zip command

	/**
	 * commented out 2011-12-08 to remove password protection
	 *
	 */
function createZip( $filename, $username, $dest = NULL)
{
	global $source_dir;
	$folder_to_zip = $filename; // confusing but the source directory and the base filename share the same name
	$cmd = "\"\"\\inetpub\\ocdla\\html\\sites\\ocdla\\modules\\zip_download\\zip\" -rv9 \"..\\$filename"."_".$username."\" \".\"\"";
	$source = $source_dir . $folder_to_zip;
	chdir( $source );
	chdir( '.' );
	$output = shell_exec( $cmd );
	$return = $output;//$source . $output;
	return $return;
}


/**
 * check to make sure the archive was successfully created
 * if it wasn't return a 404/not found header to the Ajax request
 * and EXIT so that no other headers and code are processed
 */
function fileMoveToPublicDir($old,$new)
{
	if(!copy($old,$new))
	{
		throw new Exception('Your file could not be retrieved.  Error: We couldn\'t copy your new zip archive.');
	}
}

	
	
/**
 * Finally, if the "zip" command creates a document return a link to that document
 * the user can click on this link to retrieve the ZIP archive, which has been password protected with their info
 */
function getGeneratedZipLink($link)
{
	return "<h3><a href=\"{$link}\">Click here to start your download.</a></h3>";
}