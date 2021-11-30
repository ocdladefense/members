<?php

namespace Clickpdx\Salesforce;

use Clickpdx\OAuth\OAuthGrantTypes;
use Clickpdx\SfRestApiRequestTypes;
use Clickpdx\Http\HttpRequest;
use Clickpdx\ResourceLoader;
use RestApiAuthenticationException;
use RestApiInvalidUrlException;

class ForceApiSubscriptionQuery
{
	private $debug = array();
	
	const CONTACT_QUERY = "SELECT Id, FirstName, LastName, MiddleName,
	Ocdla_Organization__c,
	MailingStreet, MailingCity, MailingState, MailingPostalCode, Ocdla_Publish_Mailing_Address__c,
	Ocdla_Bar_Number__c,
	Ocdla_Areas_of_Interest_1__c, Ocdla_Areas_of_Interest_2__c, Ocdla_Areas_of_Interest_3__c, Ocdla_Areas_of_Interest_4__c, Ocdla_Areas_of_Interest_5__c,
	OrderApi__Work_Phone__c,
	MobilePhone,
	Fax,
	OrderApi__Work_Email__c,
	Ocdla_Publish_Work_Email__c,
	Ocdla_Website__c
	FROM Contact WHERE Id='%s'";
	
	/**
	 * 
	 * SELECT Id, OrderApi__Line_Description__c FROM OrderApi__Sales_Order_Line__c WHERE OrderApi__Item__c = 'a0wj0000003930v' AND OrderApi__Sales_Order__r.OrderApi__Posting_Status__c='Posted' AND OrderApi__Contact__c='%s'
	 */
	// const SUBSCRIPTION_QUERY = "SELECT Id, OrderApi__Line_Description__c FROM OrderApi__Sales_Order_Line__c WHERE OrderApi__Item__c = 'a0w63000000C1tS' AND OrderApi__Contact__c='%s'"; 
	
	private function getMessages($type = 'debug')
	{
		return $this->debug;
	}
	
	private function addMessage($msg, $type = 'debug')
	{
		$this->debug[] = $msg;
	}
	
	public function doApiRequest($query,$param)
	{
		$oauth = ResourceLoader::getResource('sfOauth');
		$this->addMessage((string)$oauth);
		
		$this->addMessage("<h2>This is the oauth resource loader:</h2>");
		$this->addMessage("Resource is: ".get_class($oauth));
		
		$oauth_result = $oauth->authorize();
		$this->addMessage(entity_toString($oauth_result));

		
		$forceApi = ResourceLoader::getResource('forceApi',true);
		$forceApi->setDebug(false);
		$forceApi->setAuthenticationService($oauth);
		$forceApi->setInstanceUrl($oauth_result['instance_url']);
		$forceApi->setAccessToken($oauth_result['access_token']);

		$sfResult = $forceApi->executeQuery(sprintf($query,$param));
		
		return $sfResult;
	}
		
	public function getLineItem($contactId){}

	
	public function hasOnlineSubscriptionAccess($contactId)
	{
		try
		{
			$sfResult 		= 	$this->doApiRequest(
						setting('subscription.queries.hasOnlineSubscriptionQuery'), $contactId);
			// $error 				= 	!$sfResult->count() ? 'No records found for this request.' : "";
			$results 			= 	$sfResult->fetchAll();
			// print_r($results);
			if(!$sfResult->count())
			{
				return false;
				// throw new \Exception('Access Denied: no valid purchase found.');
			}

		}
		/*
		catch(RestApiAuthenticationException $e)
		{
			$error = $e->getMessage();
		}
		catch(RestApiInvalidUrlException $e)
		{
			$error = $e->getMessage();
		}
		*/
		catch(Exception $e)
		{
			return false;
		}
		return true;
	}

	
}