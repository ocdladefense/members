<?php


function getAnnouncements( $style = "html" ) {
	$connection = mysql_connect('localhost','jbernal','8a9F313a57');
	//if(!$connection) $error_msg="Unable to connect to database.";
	$use = mysql_query('use drupal');	

	$query = "SELECT n.nid, n.title, a.field_date_value AS _date from node n JOIN node_revisions v ON (n.vid=v.vid) JOIN content_type_announcement a ON(n.vid=a.vid) ORDER BY n.nid DESC LIMIT 10";
	
	$exec = mysql_query( $query );
	
	$list = "";
	
	if( $style == "html" ) {
		while( $row = mysql_fetch_assoc( $exec ) ) {
			$list .= "<li>" . date('F j',strtotime($row['_date'])) . " - <a href=\"http://www.hsolc.org/node/{$row['nid']}\">" . $row["title"] . "</a></li>";
		}
		
		return "<ul>" . $list . "</ul>";
	}//if html-formatted
	else if( $style == "text" ) {
		while( $row = mysql_fetch_assoc( $exec ) ) {
			$list .= date('F j',strtotime($row['_date'])) ." - {$row['title']}:\nhttp://www.hsolc.org/node/{$row['nid']}\">\n\n";
		}		
		return $list;
	}//else
}//getAnnouncements