<?php
class Form_ocdla_ldoc_disclaimer extends FormProcessor 
{

	private $i_accept;
	
	public function __construct( $params = array() )
	{
		parent::__construct( $params );
		$this->i_accept = $_POST["ocdla_ldoc_disclaimer_i_agree"];
	}

	public function exec()
	{
		$member_update = new DBQuery(
			$params = array(
				"type" => "update",
				"tablenames" => array(
					0	=> array(
						"name" 		=>	"members",
						"op"			=>	"",
						"fields"	=>	array()
					)
				),
				"fields" => array(
					"ldoc_flag" => "{$this->i_accept}",
					"ldoc_date" => DBQuery::formatDate(),
					"ldoc_version" => "1.0"
				),
				"keys" => array(
					"id" => $this->getUserId()
				),
				"schema" => array(
					"members"
				),
			)
		);
		$member_update->exec();
		if( $_POST["ocdla_ldoc_disclaimer_action"]=="cancel" )
		{
			$this->setStatus('You\'ve chosen not to accept the disclaimer.');
		}
		else if( $_POST["ocdla_ldoc_disclaimer_action"]=="submit" )
		{			
			$this->setStatus('Thank you for accepting the Legal Document Library disclaimer.');		
			$location = "https://www.ocdla.org/members_only/ldoclib_newocdla.cfm?action=accepted";
			header('Location: ' . $location);
			exit;
		}
	}
}