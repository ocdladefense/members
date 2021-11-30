<?php


class Form_ocdla_profiles_interests extends FormProcessor {
	private $type;
	private $action;
	private $mysql;
	private $post_test;
	private $submit_value;
	private $member_id;
	private $pf_update;		
	private $notes;
	private $intids;
	private $actions;

	public function __construct( $params = array() ) {
		parent::__construct( $params );

		$this->notes = $_POST["p_aoi"];
		//change to "p_intid", eventually
		$this->intids = $_POST["p_aoi_id"];
		$this->actions = $_POST["p_action"];
	

		foreach($this->actions AS $key=>$value) {

				switch($value) {
					case "add":
						$this->addInterest($key);
						break;
						
					case "delete":
						$this->deleteInterest($key);
						break;
						
					case "change":
						$this->updateInterest($key);
						break;
				}
			}

	}
	private function addInterest($key){
		$add_interest = new DBQuery(
			$params = array(
				"type" => "insert",
				"tablenames" => array(
					0	=> array(
						"name" 		=>	"member_interests",
						"op"			=>	"",
						"fields"	=>	array()
					)
				),
				"fields" => array(
					"member_id"						=>	$this->user_id,
					"note_type"						=>	PROFILE_AREA_OF_INTEREST,
					"note" 		=>	mysql_real_escape_string($this->notes[$key]),
				),
				"schema" => array(
					"member_interests"
				),
			)
		);
	}
	private function deleteInterest($key){
		$delete_interest = new DBQuery(
			$params = array(
				"type" => "delete",
				"tablenames" => array(
					0	=> array(
						"name" 		=>	"member_interests",
						"op"			=>	"",
						"fields"	=>	array()
					)
				),
				"keys" => array(
					"id" => $this->intids[$key]
				),
				"schema" => array(
					"member_interests"
				),
			)
		);
	}
	private function updateInterest($key){
		$update_interest = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0 => array(
						"name"			=>	"member_interests",
						"op"				=>	"",
						"fields"		=>	array()
					)
				),
				"fields" => array(
					"note" => mysql_real_escape_string($this->notes[$key])  
				),
				"keys" => array(
					"id" => $this->intids[$key]
				),
				"schema" => array(
					"member_interests"
				)
			)
		);
	
		$update_interest->exec();
	}
	public function exec() {
		return true;
	}
}