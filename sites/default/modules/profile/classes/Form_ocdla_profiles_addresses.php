<?php
class Form_ocdla_profiles_addresses extends FormProcessor {
	private $address1;
	private $address2;
	private $city;
	private $county;
	private $state;
	private $zip;
	private $FMrecid;


	
	public function __construct( $params = array() ) {
		parent::__construct( $params );
		
		$this->FMrecid 		= $_POST["fm_record_id"];
		$this->id 				= $_POST["id"];
		$this->address1 	= $_POST["address1"];
		$this->address2 	= $_POST["address2"];
		$this->city				= $_POST["city"];
		$this->county			= $_POST["county"];
		$this->state			= $_POST["state"];
		$this->zip				= $_POST["zip"];
		$this->FMDBLayout	=	"web_addresses";
	}//constructor

/*	
one, albeit, small level of abstraction
	$fieldnames = array(
		"address1"	=> array("fm"=>"address_line_1","mysql"=>"address_line_1"),
		"city"			=> array("fm"=>"city", "mysql"=>"address_city")
	);
*/
	
	public function exec() {

		// check to see if the address is being added
		if( empty($this->id) ) {
		$has_address = new DBQuery(
			$params = array(
				'type' => 'insert',
				"tablenames" => array(
					0	=> array(
						"name" 		=>	"member_addresses",
						"op"			=>	"",
						"fields"	=>	array()
					)
				),
				"fields" => array(
					'member_id' => $this->user_id,
					'a_type' => 'MA',
					"address_line_1"	=>	mysql_real_escape_string($this->address1),
					"address_line_2"	=>	mysql_real_escape_string($this->address2),
					"address_city"		=>	mysql_real_escape_string($this->city),
					"address_county"	=>	mysql_real_escape_string($this->county),
					"address_state"		=>	mysql_real_escape_string($this->state),
					"address_zip"		=>	mysql_real_escape_string($this->zip),
				),
			)
		);
		
		}//if
		
		
			else {
			$updateAddresses = new DBQuery(
				$params = array(
					"type" => "update",
					"tablenames" => array(
						0	=> array(
							"name" 		=>	"member_addresses",
							"op"			=>	"",
							"fields"	=>	array()
						)
					),
					"fields" => array(
						"address_line_1"	=>	mysql_real_escape_string($this->address1),
						"address_line_2"	=>	mysql_real_escape_string($this->address2),
						"address_city"		=>	mysql_real_escape_string($this->city),
						"address_county"	=>	mysql_real_escape_string($this->county),
						"address_state"		=>	mysql_real_escape_string($this->state),
						"address_zip"		=>	mysql_real_escape_string($this->zip),
					),
					"keys" => array(
						"id" => $this->id,
					),
					"schema" => array(
						"member_addresses"
					),
				)//$params																				
			);//new DBQuery
			$updateAddresses->exec();
			}//
		
		$this->setStatus("Form Submitted to profiles_addresses object.");
	}//method exec()

}//class Form_ocdla_profiles_addresses