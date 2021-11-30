<?php
use PHPUnit\Framework\TestCase;

use Clickpdx\Core\Application;
use Clickpdx\Salesforce\SoqlQueryBuilder;
use Clickpdx\Salesforce\BatchManager;
use Clickpdx\OAuth\OAuthHttpAuthorizationService;
use Clickpdx\SalesforceRestApiService;


require 'bootstrap.php';
require 'sites/default/modules/salesforce/includes/SalesforceController.php';


final class ForceApiTest extends TestCase
{
   
   private function getOauthInstance() {
			$params = array(
				'consumerId' => '3MVG9PE4xB9wtoY9IbhNtYSuAVD5DiwYwsTq2M8Nx47ekk606wmKorbkIvgP_2s6C8KbCLEOWIKC4lSoDlZm_',
				'clientSecret' => '3E8AA3A20EDB66E7DF38DB4B8D53053531CE2F4285FBEFC0EFEE3D30B883DE62',
				'redirectUri' => 'https://membertest.ocdla.org/salesforce/oauth',
				'loginUri' => 'https://test.salesforce.com',
				'authEndpoint' => '/services/oauth2/authorize',
				'accessTokenEndpoint' => '/services/oauth2/token',
				'username' => 'membernation@ocdla.com.ocdpartial',
				'password' => 'asdi49ir4'
			);
						
			$oauth = new OAuthHttpAuthorizationService();
			$oauth->setOAuthParams($params);
			$oauth->registerWriteHandler('POST',function($ch){
				$ch->h = \curl_init($ch->getUri());
				curl_setopt($ch->h, CURLOPT_HEADER, false);
				curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch->h, CURLOPT_POST, true);
				curl_setopt($ch->h, CURLOPT_POSTFIELDS, $ch->formatPostFields());
				return curl_exec($ch->h);
			});
			
			return $oauth;
   }
   
   
   
   
    public function testFoobar() {
			// $manager = new ForceToMySqlDataTransferManager($sfObjectName);

			$object = "Order";

			// $forceApi = ResourceLoader::getResource('forceApi');
			// $forceApi->setAuthenticationService(ResourceLoader::getResource('sfOauth'));


			$oauth = $this->getOauthInstance();
			
			$auth = $oauth->authorize();




			$pfx = 'force.import.object.'.strtolower($object);
			
			$builder = new SoqlQueryBuilder();
			$builder->table(\setting($pfx.'.mysqlTableName'));
			$builder->cols(\setting($pfx.'.fields'));
			$builder->orderBy(\setting($pfx.'.breakField'));
			// $builder->setKey(\setting($pfx.'.key'));
			// $builder->limit($batchSize);
			/* if(!empty($this->conditionField))
			{
				// Test if this is a date or not
				// Basically test for the field type
				$builder->dateCondition($this->conditionField,
						$this->conditionValue,
						SoqlQueryBuilder::QUERY_OP_GREATER_THAN);
					
				// $builder->where('Ocdla_Interaction_Line_Item_ID__c = null');
			}
			*/




			
			$batcher = new BatchManager($builder);
			// batch manager should execute sequential queries, processing the result of each batch through 
			// an executor
			// $this->addComment('mysqlQuery',$this->soqlManager->toMysqlInsertQuery());




			if(false && $query) {
				return $batcher->executeQuery($query);
			} else {
				return $batcher->execute();
			}



			// Get the records from Salesforce.
			// $records = $manager->export();
			
			// Put the records into MySQL table.
			// $manager->import($records); 
    }
    
    
    
    
    
    
    
    public function testSalesforceRestApi(){
						
			// trigger_error("Cannot divide by zero", E_USER_ERROR);
						
			$params = array(
				'consumerId' => '3MVG9PE4xB9wtoY9IbhNtYSuAVD5DiwYwsTq2M8Nx47ekk606wmKorbkIvgP_2s6C8KbCLEOWIKC4lSoDlZm_',
				'clientSecret' => '3E8AA3A20EDB66E7DF38DB4B8D53053531CE2F4285FBEFC0EFEE3D30B883DE62',
				'redirectUri' => 'https://membertest.ocdla.org/salesforce/oauth',
				'loginUri' => 'https://test.salesforce.com',
				'authEndpoint' => '/services/oauth2/authorize',
				'accessTokenEndpoint' => '/services/oauth2/token',
				'username' => 'membernation@ocdla.com.ocdpartial',
				'password' => 'asdi49ir4'
			);
						
			$oauth = new OAuthHttpAuthorizationService();
			$oauth->setOAuthParams($params);
			$oauth->registerWriteHandler('POST',function($ch){
				$ch->h = \curl_init($ch->getUri());
				curl_setopt($ch->h, CURLOPT_HEADER, false);
				curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch->h, CURLOPT_POST, true);
				curl_setopt($ch->h, CURLOPT_POSTFIELDS, $ch->formatPostFields());
				return curl_exec($ch->h);
			});
			
			$authres = $oauth->authorize();
			
			
			print_r($authres);
					    	
					  
					  
			$prest = array(
				'consumerId' => '3MVG9PE4xB9wtoY9IbhNtYSuAVD5DiwYwsTq2M8Nx47ekk606wmKorbkIvgP_2s6C8KbCLEOWIKC4lSoDlZm_',
				'clientSecret' => '3E8AA3A20EDB66E7DF38DB4B8D53053531CE2F4285FBEFC0EFEE3D30B883DE62',
				'soqlEndpoint' => '/services/data/v29.0/queryAll',
				'serviceEndpoint' => '/services/data/v29.0',
				'endpoints'=> array(
					'sobjects'					=>'/services/data/v29.0/sobjects',
					'sobject' 					=> '/services/data/v29.0/sobjects/{object}/describe',
					'account-info'			=>'/Account/{id}',
					'all-accounts' 			=> '/SOQL/q={query}'
				)
			);
			  	
			$rest = new SalesforceRestApiService();
			$rest->setDebug(true);
			$rest->setParams($prest);
			// $rest->setEndpoint('queryAll');

			$rest->registerWriteHandler('POST',function(/*HttpMessage*/$ch){
				$ch->h = \curl_init($ch->getUri());
				curl_setopt($ch->h, CURLOPT_HEADER, false);
				curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
				$ch->addHeaders();
				return curl_exec($ch->h);
			});
			
			$rest->setAuthenticationService($oauth);
			$rest->setAccessToken($authres['access_token']);
			$rest->setInstanceUrl($authres['instance_url']);
			$rest->authorize();
					    	
			$result = $rest->executeQuery('SELECT Id, Name FROM Contact LIMIT 5');
			
			foreach($result->fetchAll() as $c){
				print $c['Name']."\n";
			}


    	$this->assertEquals('foobar','foobar');
    }
    
    
    /**
     * @testMethod textExpertController
     *
     * @description Make sure we can query for experts.
     *

    public function testExpertController(){
    
    	$controller = new SalesforceController();
    
    	$rest = $controller->getQueryInstance();
    	
			$result = $rest->executeQuery('SELECT Id, Name FROM Contact LIMIT 5');
			
			foreach($result->fetchAll() as $c){
				print $c['Name']."\n";
			}
    }
    */
    
		/*
    public function testSalesforceSchemaViaRest(){

			$params = array(
				'consumerId' => '3MVG9PE4xB9wtoY9IbhNtYSuAVD5DiwYwsTq2M8Nx47ekk606wmKorbkIvgP_2s6C8KbCLEOWIKC4lSoDlZm_',
				'clientSecret' => '3E8AA3A20EDB66E7DF38DB4B8D53053531CE2F4285FBEFC0EFEE3D30B883DE62',
				'redirectUri' => 'https://membertest.ocdla.org/salesforce/oauth',
				'loginUri' => 'https://test.salesforce.com',
				'authEndpoint' => '/services/oauth2/authorize',
				'accessTokenEndpoint' => '/services/oauth2/token',
				'username' => 'membernation@ocdla.com.ocdpartial',
				'password' => 'asdi49ir4'
			);
						
			$oauth = new OAuthHttpAuthorizationService();
			$oauth->setOAuthParams($params);
			$oauth->registerWriteHandler('POST',function($ch){
				$ch->h = \curl_init($ch->getUri());
				curl_setopt($ch->h, CURLOPT_HEADER, false);
				curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch->h, CURLOPT_POST, true);
				curl_setopt($ch->h, CURLOPT_POSTFIELDS, $ch->formatPostFields());
				return curl_exec($ch->h);
			});
			
			$uth = $oauth->authorize();
			print_r($uth);
					    	
					  
					  
			$prest = array(
				'consumerId' => '3MVG9PE4xB9wtoY9IbhNtYSuAVD5DiwYwsTq2M8Nx47ekk606wmKorbkIvgP_2s6C8KbCLEOWIKC4lSoDlZm_',
				'clientSecret' => '3E8AA3A20EDB66E7DF38DB4B8D53053531CE2F4285FBEFC0EFEE3D30B883DE62',
				'soqlEndpoint' => '/services/data/v29.0/queryAll',
				'serviceEndpoint' => '/services/data/v29.0',
				'endpoints'=> array(
					'sobjects'					=>'/services/data/v29.0/sobjects',
					'sobject' 					=> '/services/data/v29.0/sobjects/{object}/describe',
					'account-info'			=>'/Account/{id}',
					'all-accounts' 			=> '/SOQL/q={query}'
				)
			);
			  	
			$rest = new SalesforceRestApiService();
			$rest->setDebug(true);
			$rest->setParams($prest);
			// $rest->setEndpoint('queryAll');

			$rest->registerWriteHandler('POST',function($ch){
				$ch->h = \curl_init($ch->getUri());
				curl_setopt($ch->h, CURLOPT_HEADER, false);
				curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
				$ch->addHeaders();
				return curl_exec($ch->h);
			});
			
			$rest->setAuthenticationService($oauth);
			$rest->setAccessToken($uth['access_token']);
			$rest->setInstanceUrl($uth['instance_url']);
			$rest->authorize();
					    	
			$result = $rest->getObjectInfo('Contact');
			
			// print_r($result);
			
    	$this->assertEquals('foobar','foobar');
    }
		*/
}
