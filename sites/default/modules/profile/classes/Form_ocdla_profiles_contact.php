<?php
/**
 * @file
 * updated to reflect that class methods should not throw errors
 * instead errors should be thrown at the function level in
 * profiles_funcs.php
 */
class Form_ocdla_profiles_contact extends FormProcessor {

	private $FMContactInfoTypesToIDFields;

	private $null_field_name;
	private $FMrecid;
	private $title;
	private $name_first;
	private $name_middle;
	private $name_last;
	private $suffix;
	private $name_company;
	private $bar_number;
	private $psid;
	private $address_www;
	
	private $emails;
	private $pond_email;
	private $work_phone;
	private $cell_phone;
	private $fax_number;
	private $emails_id;
	private $pond_email_id;
	private $work_id;
	private $cell_id;
	private $fax_number_id;
	
	
	public function __construct( $params = array() ) {
		parent::__construct( $params );

		$this->FMContactInfoTypesToIDFields = array(
			"email"	=> 	"emails_id",
			"work"	=>	"work_id",
			"cell"	=>	"cell_id",
			"fax"	=>	"fax_number_id"
		);
		
		$this->FMrecid = $_POST["p_fm_record_id"];
		$this->title = trim($_POST["p_title"]);
		$this->name_first = $_POST["p_first"];
		$this->name_middle = $_POST["p_middle"];
		$this->name_last = $_POST["p_last"];
		$this->suffix = $_POST["p_suffix"];
		$this->name_company = $_POST["p_company"];
		$this->bar_number = trim($_POST["p_bar"]);
		$this->psid = trim($_POST['p_psid']);
		$this->address_www = trim($_POST["p_www"]);
		
		$this->emails = trim($_POST["p_email"]);
		$this->emails_id = $_POST["p_email_id"];
		$this->pond_email = trim($_POST["p_pond_email"]);
		$this->pond_email_id = $_POST["p_pond_email_id"];
		$this->work_phone = trim($_POST["p_work"]);
		$this->work_id = $_POST["p_work_id"];
		$this->cell_phone = trim($_POST["p_cell"]);
		$this->cell_id = $_POST["p_cell_id"];
		$this->fax_number = trim($_POST["p_fax"]);
		$this->fax_number_id = $_POST["p_fax_id"];
		
		$this->updateMemberInfo();	
		
		if( $this->updateEmail( $this->emails_id ) == 0 && !empty($this->emails) && empty($this->emails_id) ) {
			$this->insertContactInfo( 'email', $this->emails );
		}
		elseif( !empty($this->emails_id) && empty($this->emails) ){
			$this->deleteContactInfo( $this->emails_id );
		}
		
		if( $this->updateWorkPhone( $this->work_id ) == 0 && !empty($this->work_phone) && empty($this->work_id) ) $this->insertContactInfo( 'work', $this->work_phone );
			elseif( !empty($this->work_id) && empty($this->work_phone) ) $this->deleteContactInfo( $this->work_id );
		
		if( $this->updateCellPhone( $this->cell_id ) == 0 && !empty($this->cell_phone) && empty($this->cell_id) ) $this->insertContactInfo( 'cell', $this->cell_phone );
			elseif( !empty($this->cell_id) && empty($this->cell_phone) ) $this->deleteContactInfo( $this->cell_id );
		
		if( $this->updateFax( $this->fax_number_id ) == 0 && !empty($this->fax_number) && empty($this->fax_number_id) ) $this->insertContactInfo( 'fax', $this->fax_number );
			elseif( !empty($this->fax_number_id) && empty($this->fax_number) ) $this->deleteContactInfo( $this->fax_number_id );

		

	}


	private function insertContactInfo( $type = NULL, $value = NULL ) {
		
		$update_info = new DBQuery(
			$params = array(
				"type" => "insert",
				"tablenames" => array(
					0 => array(
						"name"		=>	"member_contact_info",
						"op"		=>	"",
						"fields"	=>	array()
					)
				),//tablenames
				"fields" => array(
					"contact_id" => $this->user_id,
					"type" 		=> $type,
					"value"		=> mysql_real_escape_string($value),
					"publish"	=> 1
				),
			)
		);
	}

	
	private function deleteContactInfo( $id ) {
		
		$update_info = new DBQuery(
			$params = array(
				"type" => "delete",
				"tablenames" => array(
					0 => array(
						"name"		=>	"member_contact_info",
						"op"		=>	"",
						"fields"	=>	array()
					)
				),//tablenames
				"where" => array(
					"contact_id={$this->user_id} AND ",
					"id={$id}"
				)
			)
		);
	}
	
	private function updateEmail( $id ) {
//		require('/var/www/members/includes/DBQuery.php');
		$update_info = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"member_contact_info",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),//tablenames
				"fields" => array(
					"value"	=> mysql_real_escape_string($this->emails),
				),
				"where" => array(
					"contact_id = {$this->user_id} AND",
					"id='{$id}'"
				),
			)
		);
		$update_info->exec();
		tail( 'Number of updated emails is: ' .$update_info->getNumRows() ); 
	}
	
	private function updateWorkPhone( $id ) {
	
		$update_info = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"member_contact_info",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),//tablenames
				"fields" => array(
					"value"		=>	mysql_real_escape_string($this->work_phone),
				),
				"where" => array(
					"contact_id = {$this->user_id} AND",
					"id='{$id}'"
				),
			)
		);
		$update_info->exec();
	}
	
	private function updateCellPhone($id)
	{
		$update_info = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"member_contact_info",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),//tablenames
				"fields" => array(
					"value"		=>	mysql_real_escape_string($this->cell_phone),
				),
				"where" => array(
					"contact_id = {$this->user_id} AND",
					"id='{$id}'"
				),
			)
		);
		$update_info->exec();
	}
	
	private function updateFax($id)
	{
		$update_info = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"member_contact_info",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),//tablenames
				"fields" => array(
					"value"		=>	mysql_real_escape_string($this->fax_number),
				),
				"where" => array(
					"contact_id = {$this->user_id} AND",
					"id='{$id}'"
				),
			)
		);
		$update_info->exec();
	}

	private function updateMemberInfo() {

		$update_info = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"members",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),//tablenames
				"fields" => array(
					"title"				=>	mysql_real_escape_string($this->title),
					"name_first"		=>	mysql_real_escape_string($this->name_first),
					"name_middle"		=>	mysql_real_escape_string($this->name_middle),
					"name_last"			=>	mysql_real_escape_string($this->name_last),
					"suffix"				=>	mysql_real_escape_string($this->suffix),
					"name_company"	=>	mysql_real_escape_string($this->name_company),
					"pond_email"		=>	mysql_real_escape_string($this->pond_email),
					"pond_email_id"	=>	mysql_real_escape_string($this->pond_email_id),
					"bar_number"		=>	mysql_real_escape_string($this->bar_number),
					"PSID"		=>	mysql_real_escape_string($this->psid),
					"address_www"		=>	mysql_real_escape_string($this->address_www)
				),
				"keys" => array(
					"id" => $this->user_id,
				),
				"schema" => array(
					"members"
				)
			)//params
		);//object

		$update_info->exec();

	}//method updateMemberInfo()

	public function exec() {
		return;
	}// method exec()

}//class