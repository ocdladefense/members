<?php

function matchColumns() {
	$col_matches;
	$cn = array("work"=>"work_phone","cell"=>"cell_phone","fax"=>"fax_number","email"=>"emails","pond_email"=>"pond_email","www"=>"address_www","first"=>"name_first","last"=>"name_last","company"=>"name_company","bar"=>"bar_number","status"=>"contact_status");
	foreach($post AS $post_key=>$value) foreach($cn AS $key=>$col_name) {$pattern='/'.$key.'$/'; if(preg_match($pattern,$post_key)) {$col_matches[]=$post_key;break;}}
	print_r($col_matches);
}




function performQuery( $query ) {
	global $pf_update, $debug, $mysql;
	$pf_update = mysql_query( $query );
	if($debug) { echo "$query<p />"; if (!$pf_update) echo mysql_error(); }
}



function parsePostFieldsArray_test($array) {
	$data = array();
	foreach ($array as $key=>$val)
		$data[] = urlencode($key) . '=' . urlencode($val);
	return implode('&', $data);
}





function parsePostFieldsArray($array) {
	$data = array();
	foreach ($array as $key=>$val) {
		if(is_array($array[$key])>0) for($i=0; $i<count($array[$key]); $i++)						//if this is an array within an array as PHP POST syntax allows but cURL apparently doesn't
		{
		  $tmp_key=$key."_".$i;
		  $data[] = urlencode($tmp_key) . '=' . urlencode($array[$key][$i]);
		}
		else $data[] = urlencode($key) . '=' . urlencode($val);
	}
	return implode('&', $data);
}


// Function to create HTML drop-down of Areas of Interest
function getInterests( $selectedOption=null, $with_select=FALSE ) {
	$results = mysql_query('select * from data_interests order by interest');

	$rows = array();
	if ( $with_select ) $interests = '<select name="aoi" >';
	else $interests='';
	$matchedOption=FALSE;
	while( $row = mysql_fetch_row($results)){
		$selected = "";
		if ( $row[0] == $selectedOption && ($row[0] != "" && $row[0]!= null) ) {
			$selected = "selected=\"selected\"";
			$matchedOption=TRUE;
		}
		$interests .= "<option value=\"$row[0]\" $selected>$row[0]</option>";
	}
	if( !$matchedOption && !empty($selectedOption) )
		$interests = "<option value=\"$selectedOption\" selected=\"selected\">$selectedOption</option>".$interests;
	if ( $with_select ) $interests .= '</select>';
	return $interests;
}


// Function to create HTML drop-down of Contact Types
function getContactTypes($selectedOption=null,$with_select=false, $contact_status='R')
{
	$interests = "";
	$s = '<select name="contact_type">';
	if(strpos($contact_status,"R")!==false) {
		if(strpos($selectedOption,"Attorney At Law")!==false || strpos($selectedOption,"Attorney at Law")!==false)
		{
			$interests .= "<option value='Attorney At Law' selected='selected'>Attorney At Law</option><option value='Public Defender'>Public Defender</option>";
		}
		else $interests .= "<option value='Public Defender' selected='selected'>Public Defender</option><option value='Attorney At Law'>Attorney At Law</option>";

		if ( $with_select ) $interests = $s.$interests.'</select>';
		return $interests;
	}

	$results = db_query('SELECT * FROM data_occupations ORDER BY occupation');
	
	$matchedOption=FALSE;
	while ($row = $results->fetch_row())
	{
		$selected = "";
		if ($row[0] == $selectedOption)
		{
			$selected="selected='selected'";
			$matchedOption=TRUE;
		}
		$interests .= "<option value='$row[0]' $selected>$row[0]</option>";
	}
	if (!$matchedOption && !empty($selectedOption) && !is_null($selectedOption))
		$interests="<option value='$selectedOption' select='selected'>$selectedOption</option>".$interests;

	if ( $with_select ) $interests = $s.$interests.'</select>';
	return $interests;
}




/**
	getAllContactTypes
**/

function getAllContactTypes ( $selectedOption=null, $with_select=FALSE, $contact_status=null ) {
	$interests = "";
	$s = '<select name="contact_type" >';

	$stmt = db_query('select * from data_occupations order by occupation');
	$matchedOption=FALSE;
	while( $row = $stmt->fetch_row() ) {
		$selected = "";
		if ( $row[0] == $selectedOption ) {
			$selected="selected=\"selected\"";
			$matchedOption=TRUE;
		}
		$interests .= "<option value=\"$row[0]\" $selected>$row[0]</option>";
	}
	if( !$matchedOption && !empty($selectedOption) && !is_null($selectedOption) )
		$interests="<option value=\"$selectedOption\" selected=\"selected\">$selectedOption</option>".$interests;

	if ( $with_select ) $interests = $s.$interests.'</select>';
	return $interests;
}