<?php

class Form_ocdla_profiles_contact_types extends FormProcessor
{

	public function __construct($params=array())
	{
		parent::__construct($params);
	}
	
	public function exec()
	{
		$occupation 		= $this->request->getRequestValue('occupation');
		$occupationId 	= $this->request->getRequestValue('occupationId');


		if (empty($occupationId))
		{
			db_query('INSERT INTO {member_interests} (note,memberid) VALUES(:note,:id)',
				array(':note'=>$occupation,':id'=> $occupationId),
				'pdo',
				false);
		}

		try
		{
			$affected = db_query('UPDATE member_interests SET note=:1 WHERE id=:2',
				array($occupation,$occupationId));
		}
		catch(Exception $e)
		{
			print $e->getMessage();exit;
		}
	}
}