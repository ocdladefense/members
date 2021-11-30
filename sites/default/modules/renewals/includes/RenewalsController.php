<?php

use Clickpdx\Core\Controller\ControllerBase;

class RenewalsController extends \SalesforceController
{
	const UNRENEWED_BATCH_SIZE = 100;
	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function show_renewal($page = 1)
	{	
		$page = !empty($page) ? $page-1 : $page;

		$this->addTemplateLocation(
			'sites/default/modules/renewals/templates'
		);

		return array(
			'#attached' => array(
				'css' => array(
					'/sites/default/modules/renewals/css/renewal.css',
					'/sites/default/modules/renewals/css/renewal-print.css'
				)
			),
			'#markup' => $this->render('renewal',array(
				'members' => $this->getUnrenewedMembers(self::UNRENEWED_BATCH_SIZE,$page)
			)),
		);
	}
	
	
	public function show_member_renewal($contactId)
	{	

		$this->addTemplateLocation(
			'sites/default/modules/renewals/templates'
		);
		
		$soql = sprintf(\setting('renewals.queries.unrenewedIndividualSingle'),$contactId);

		$sfResult = $this->doApiRequest($soql);

		return array(
			'#attached' => array(
				'css' => array(
					'/sites/default/modules/renewals/css/renewal.css'
				)
			),
			'#markup' => $this->render('renewal',array(
				'members' => $sfResult->fetchAll()
			)),
		);
	}
	
	
	private function getUnrenewedMembers($batchSize,$page)
	{
		$offset = $page * $batchSize;
		
		$soql = sprintf(\setting('renewals.queries.unrenewedIndividual'),$batchSize,$offset);

		$sfResult = $this->doApiRequest($soql);

		
		return $sfResult->fetchAll();
	
	}



	private function _doUpdateUsername($contactId,$newUsername)
	{
		// Bail if anything important is missing.
		if(empty($contactId) || empty($newUsername)) return false;
		
		$newMwUsername = ucfirst($newUsername);
		$oldMwUsername = null;
		
		
		$data = array(
			'username' 	=> $newUsername,
			'id'			 	=> $contactId
		);

		try
			{
			// Query for the old username (need this to update MediaWiki)
			$results = \db_query_pdo('default','SELECT id, username FROM {members} WHERE id=:id',
				array('id' => $contactId),false)->fetchAll();
			$oldMwUsername = ucfirst($results[0]['username']);
			
			\db_query_pdo('default','UPDATE {members} SET username=:username WHERE id=:id',$data,false);
		
			\db_query_pdo('lod','UPDATE {user} SET user_name=:newMwUsername WHERE user_name=:oldMwUsername',
				array('newMwUsername' => $newMwUsername, 'oldMwUsername' => $oldMwUsername));
		}
		catch(\Exception $e)
		{
			return $e->getMessage();
		}

		return 'CONTACT ID: '.$contactId.' | Username: '.$newUsername;
	}



	public function updateUsername($contactId)
	{
		// if(\setting('dont update silly',true)) return;

		if(strlen($contactId) > 15)
		{
			$contactId = substr($contactId,0,15);
			//003j000000rU9NvAAK
		}
		
		if(count($_POST))
		{
			$newUsername = $_POST['newUsername'];
			$result = $this->_doUpdateUsername($contactId,$newUsername);
		}
		
		/**
		This doesn't work with Salesforce callouts.
		switch($_SERVER['REQUEST_METHOD'])
		{
			case 'GET':
				// $result = $this->_doUpdateUsername($contactId,$username);
				break;
		
			case 'POST':
				$newUsername = $_POST['newUsername'];
				$result = $this->_doUpdateUsername($contactId,$newUsername);
				break;
		}
		*/
		
		print $result;
		exit;
	}
	
	public function updateUsernameTest($contactId)
	{
		// if(\setting('dont update silly',true)) return;
				$newUsername = 'foobar@baz.com';
				$result = $this->_doUpdateUsername($contactId,$newUsername);	

		
		return $result;
	}

}