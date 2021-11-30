<?php

use Clickpdx\Core\Controller\ControllerBase;
use Clickpdx\Salesforce\ForceApiSubscriptionQuery;

class ForceApiController extends ControllerBase
{
	private $debug = array();
	
	private function getMessages($type = 'debug')
	{
		return $this->debug;
	}
	
	private function addMessage($msg, $type = 'debug')
	{
		$this->debug[] = $msg;
	}

	
	public function testAccess($contactId)
	{
		$api = new ForceApiSubscriptionQuery;
		
		if($api->hasOnlineSubscriptionAccess($contactId))
		{
			print "This member will have access to the Online Subscription service.";
		}
		
		else
		{
			print "This member will not have access to the Online Subscription service.";
		}
		exit;
	}
	
	
	
		
	public function displayApiTest($contactId)
	{
	
	
		/**
		 *
		 * We also have prependPath() and exists()
		 * functions.
		 */
		try
		{
			$api = new ForceApiSubscriptionQuery;
			$sfResult 		= 	$api->doApiRequest(ForceApiSubscriptionQuery::CONTACT_QUERY, $contactId);
			$error 				= 	!$sfResult->count() ? 'No records found for this request.' : "";
			$results 			= 	$sfResult->fetchAll();
		}

		catch(\Exception $e)
		{
			$error = '<h3>' . get_class($e) . ':</h3>' . $e->getMessage();
		} 
		 
		 
		$this->addTemplateLocation(
			'sites/default/modules/force_api/templates'
		);
		return $this->render('apiTest', array(
			'messages' => $this->getMessages(),
			'error' => $error,
			'contacts' => $results
		));		
	}
	
}