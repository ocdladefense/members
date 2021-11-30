<?php

use Clickpdx\Core\Controller\ControllerBase;
use Ocdla\Member;
use Clickpdx\Core\User\ForceUser;
use Clickpdx\OAuth\OAuthGrantTypes;
use Clickpdx\SfRestApiRequestTypes;
use Clickpdx\Http\HttpRequest;
use Clickpdx\ResourceLoader;

use Clickpdx\Salesforce\RestApiAuthenticationException;
use Clickpdx\Salesforce\RestApiInvalidUrlException;
use Clickpdx\Salesforce\SoqlQueryBuilder;
use Clickpdx\Salesforce\MysqlImporter;
use Clickpdx\Salesforce\ForceSelect;
use Clickpdx\Salesforce\ForceBackup;
use Clickpdx\Salesforce\BatchJob;

use Clickpdx\OAuth\OAuthHttpAuthorizationService;
use Clickpdx\SalesforceRestApiService;
use Clickpdx\Salesforce\SObject;


class SalesforceController extends ControllerBase
{
	protected $debug = array();
	
	private $comments = array();
	
	// Max number of records that
	// can be included in a a batch.
	const MAX_BATCH_SIZE = 1000;
	
	const MAX_NUM_BATCHES = 1000;
	
	protected function getMessages($type = 'debug')
	{
		return $this->debug;
	}
	
	protected function addMessage($msg, $type = 'debug')
	{
		$this->debug[] = $msg;
	}
	
	protected function prepareApiService()
	{
		$forceApi = ResourceLoader::getResource('forceApi');
		$forceApi->setAuthenticationService(ResourceLoader::getResource('sfOauth'));
		return $forceApi;
	}
	
	protected function connect() {
		$oauth = ResourceLoader::getResource('sfOauth');
		$this->addMessage((string)$oauth);
		
		$this->addMessage("<h2>This is the oauth resource loader:</h2>");
		$this->addMessage("Resource is: ".get_class($oauth));
		// print_r($this->getMessages());
		// exit;
		
		$oauth_result = $oauth->authorize();
		$this->addMessage(entity_toString($oauth_result));

		
		$api = ResourceLoader::getResource('forceApi',true);
		$api->setDebug(false);
		$api->setAuthenticationService($oauth);
		$api->setInstanceUrl($oauth_result['instance_url']);
		$api->setAccessToken($oauth_result['access_token']);
		$api->authorize();
		
		return $api;
	}
	
	protected function prepareApiServiceDebug()
	{
		$oauth = ResourceLoader::getResource('sfOauth');
		$forceApi = ResourceLoader::getResource('forceApi',true);
		print $oauth;
		$forceApi->setAuthenticationService($oauth);
		return $forceApi;
	}
	
	
	public function getProductsJson()
	{
		$settingPrefix = 'force.importProductsSearch.url';
		$url = \setting($settingPrefix);
		$resource = curl_init($url);
		
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// grab URL and pass it to the browser
		curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	
	public function importDeletedObjectRecords($sfObjectName)
	{
		$manager = new ForceToMySqlDataTransferManager($sfObjectName.'Deleted');
		$records = $manager->export('SELECT Id FROM Contact WHERE isDeleted = True');
		// $manager->import($records);
		// return $manager->getComments();

		$settingPrefix = 'force.import.object.'.strtolower($sfObjectName);
		$mysqlTable = \setting($settingPrefix.'.mysqlTableName');
		
		// \get_connection()->query('LOCK TABLES '.$mysqlTable.' WRITE');
		// $mysql = \db_query('LOCK TABLES '.$this->mysqlTable.' WRITE','pdo',true);

		foreach($records as $record)
		{
			// if(++$counter>10) break;
			unset($record['attributes']);
			//print "<br />{$record['Id']}";
			\db_query('INSERT INTO force__contact_deleted (Id,Type) VALUES(:Id,:Type) ON DUPLICATE KEY UPDATE Id=VALUES(Id), Type=VALUES(Type)',$record+array('Type'=>'Contact'),'pdo',false);
		}

		// \get_connection()->query('UNLOCK TABLES');
		

		$this->addTemplateLocation(
			'sites/default/modules/salesforce/templates'
		);
		return $this->render('forceImportToMysql', array(
			'error' 	=> $error,
			'result' 	=> 'Imported '.$records->count() .' records: ' . $manager->getComments(),
			'queries' => $records->getComment('queries')
		));
	}
	
	
	
	public function showDeleted($object)
	{
		$sfResult = $this->queryDeleted($object);
		
		
		$error = !$sfResult->count() ? 'No records found for this request.' : "";
		$results = $sfResult->fetchAll();
		
		print "<h3>Results are: </h3><p><pre>".print_r($results,true)."</pre></p>";exit;
		
		$this->addTemplateLocation(
			'sites/default/modules/salesforce/templates'
		);
		return $this->render('deleted-results', array(
			'error' => $error,
			'results' => $results
		));
	}
	
	public function queryDeleted($object)
	{
		$query = sprintf('SELECT Id FROM %s WHERE isDeleted = True',$object);
		
		$forceApi = $this->queryAll();
		$sfResult = $forceApi->executeQuery($query);
		return $sfResult;
	}



	protected function queryAll()
	{
		// Fetch the settings
		$settings = ResourceLoader::getResourceInfo('forceApi')['params'];
		// print '<pre>'.print_r($settings,true).'</pre>';exit;
	
		$forceApi = new Clickpdx\SalesforceRestApiService($settings);
		$forceApi->setDebug(true);
		// $svc->setParams($params);
		$forceApi->setEndpoint('queryAll');
		$forceApi->registerWriteHandler('POST',function(/*HttpMessage*/$ch){
			$ch->h = \curl_init($ch->getUri());
			curl_setopt($ch->h, CURLOPT_HEADER, false);
			curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
			$ch->addHeaders();
			return curl_exec($ch->h);
		});
		
		$oauth = ResourceLoader::getResource('sfOauth');
		// print $oauth;
		$forceApi->setAuthenticationService($oauth);
		$forceApi->authorize();
		
		return $forceApi;
	}




	/**
	 * @method getQueryInstance
	 *
	 * @description Connect to Salesforce and return an authenticated instance of
	 *  a SalesforceRestApi ready for querying.
	 * 
	 * @example 
	 */
	public function getQueryInstance() {
			
		
		$params = ResourceLoader::getResourceInfo('sfOauth')['params'];
					
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
		
		
		// Connection complete, so consume the Salesforce REST API now.
		$prest = ResourceLoader::getResourceInfo('forceApi')['params'];
				
		$rest = new SalesforceRestApiService();
		$rest->setDebug(true);
		$rest->setParams($prest);
		$rest->setEndpoint('query');

		$rest->registerWriteHandler('POST',function(/*HttpMessage*/$ch){
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


		
		
		// $this->setOAuthSession($data['access_token']);
		// $this->saveInstanceUrlSession($data['instance_url']);

		return $rest;
	}


	public function debugForceApi($param="hen")
	{	
		static $retries = 0;
		if(++$retries > 3)
		{
			throw new \Exception("There was an error loading the OCDLA Membership Directory.");
		}
		
		$directoryService = $this->prepareApiServiceDebug(); // should we specify the endpoint here?
		print $directoryService;
		// exit;
		// $directoryService->authorize();
		// $directoryService->deleteAccessToken();
		
		try
		{
			$sfResult = $directoryService->executeQuery(
				sprintf(\setting('directory.queries.searchLastName'),$param)
			);
			$error = !$sfResult->count()?'No records found for this request.':"";
			$results = $sfResult->fetchAll();
		}
		catch(RestApiAuthenticationException $e)
		{
			$directoryService->authorize();
			$this->debugForceApi($param);
		}
		catch(RestApiInvalidUrlException $e)
		{
			$directoryService->authorize();
			$this->debugForceApi($param);
		}
		catch(\Exception $e)
		{
			$error = $e->getMessage();
		}

		/**
		 *
		 * We also have prependPath() and exists()
		 * functions.
		 */
		$this->addTemplateLocation(
			'sites/default/modules/directory/templates'
		);
		return $this->render('search-results', array(
			'error' => $error,
			'query' => $directoryService->getSoqlQuery(),
			'link' => $instanceUrl,
			'results' => $results
		));
	}	
	





	public function doApiRequest($soql)
	{
		$oauth = ResourceLoader::getResource('sfOauth');
		$this->addMessage((string)$oauth);
		
		$this->addMessage("<h2>This is the oauth resource loader:</h2>");
		$this->addMessage("Resource is: ".get_class($oauth));
		// print_r($this->getMessages());
		// exit;
		
		$oauth_result = $oauth->authorize();
		$this->addMessage(entity_toString($oauth_result));

		
		$forceApi = ResourceLoader::getResource('forceApi',true);
		$forceApi->setDebug(false);
		$forceApi->setAuthenticationService($oauth);
		$forceApi->setInstanceUrl($oauth_result['instance_url']);
		$forceApi->setAccessToken($oauth_result['access_token']);
		$forceApi->authorize();

		$sfResult = $forceApi->executeQuery($soql);

		return $sfResult;
	}
	
	
	public function doApiSchemaRequest($forceObjectName)
	{
		$oauth = ResourceLoader::getResource('sfOauth');
		$this->addMessage((string)$oauth);
		
		$this->addMessage("<h2>This is the oauth resource loader:</h2>");
		$this->addMessage("Resource is: ".get_class($oauth));
		// print_r($this->getMessages());
		// exit;
		
		$oauth_result = $oauth->authorize();
		$this->addMessage(entity_toString($oauth_result));

		
		$forceApi = ResourceLoader::getResource('forceApi',true);
		$forceApi->setDebug(false);
		$forceApi->setAuthenticationService($oauth);
		$forceApi->setInstanceUrl($oauth_result['instance_url']);
		$forceApi->setAccessToken($oauth_result['access_token']);

		$sfResult = $forceApi->getObjectInfo($forceObjectName);
		// $object = new SfObject($forceObjectName);
		// $fields = $object->getFields();
		// $picklistField = $object->getField('somePicklistField');
		// $options = $picklistField->getPicklistOptions();


		return $sfResult;
	}






	
	public function importSalesforceObjectRecords($oName)
	{
	
		$api = $this->connect();
		// $api->setDebug(true);
		
		// Max number of records to include in a batch.
		$batchSize = \setting('force.import.maxBatchSize',self::MAX_BATCH_SIZE);
		
		// How many batches should be processed?
		$maxBatches = \setting('force.import.maxBatches', self::MAX_NUM_BATCHES);
		
		// Get settings from the application.
		// Should be an application-level call.
		$pfx = 'force.import.object.'.strtolower($oName);


		// Set the target table
		// We'll import Salesforce data here
		$mysqlTable = \setting($pfx.'.mysqlTableName');
		
		
		// Prepare to send SOQL query.
		$soql = new SoqlQueryBuilder();
		$soql->table($oName);
		$soql->cols(\setting($pfx.'.fields'));
		$soql->setBreakColumn(\setting($pfx.'.breakField'));
		$soql->addOption('LIMIT',$batchSize);
		$soql->addOption('ORDER BY',\setting($pfx.'.breakField'));
		$soql->setKey(\setting($pfx.'.key'));
		

		
		// print $soql."<br />";
		

		
		$backup = new ForceBackup();
		$backup->setApi($api);
		$backup->setSoql($soql);
		

		
		$batch = new BatchJob($backup, 1000);

		 
		$info = $batch->getJobInfo();

		
		
		$count = 999; // $info["countRecords"];
		$queries = "some query"; // $info["queries"];
		
		// return $manager->getComments();
		$this->addTemplateLocation(
			'sites/default/modules/directory/templates'
		);
		

		return $this->render('forceImportToMysql', array(
			'error' 	=> $error,
			'result' 	=> $info->getLog(),
			'queries' => array()
		));
	}








	public function importRecentSalesforceObjectRecords($sfObjectName)
	{

		$daysPrevious = setting('force.import.recentRecordsDaysPrevious');
		

		$dateTime = date('Y-m-d',time()-(60*60*24*$daysPrevious)).'T00:00:00Z';

		$builder->dateCondition($this->conditionField,
					$this->conditionValue,
					SoqlQueryBuilder::QUERY_OP_GREATER_THAN);		
		
		// Get settings from the application.
		// Should be an application-level call.
		$pfx = 'force.import.object.'.strtolower($oName);


		// Set the target table
		// We'll import Salesforce data here
		$mysqlTable = \setting($pfx.'.mysqlTableName');
		
		
		// Prepare to send SOQL query.
		$soql = new SoqlQueryBuilder();
		$soql->table($oName);
		$soql->cols(\setting($pfx.'.fields'));
		$soql->setBreakColumn(\setting($pfx.'.breakField'));
		$soql->addOption('LIMIT',$batchSize);
		$soql->addOption('ORDER BY',\setting($pfx.'.breakField'));
		// $soql->setConditionField($conditionField);
		// $soql->setConditionValue($conditionValue);
		$soql->setKey(\setting($pfx.'.key'));
	
	
		
		$backup = new ForceBackup();
		
		$batch = new Batch($backup, 1000);
		


		// return $manager->getComments();
		$this->addTemplateLocation(
			'sites/default/modules/directory/templates'
		);
		return $this->render('forceImportToMysql', array(
			'error' 	=> $error,
			'result' 	=> 'Imported '.$records->count() .' records: ',
			'queries' => $records->getComment("queries")
		));
	}




	public function importSalesforceObjectRecordsByField($sfObjectName,$field,$value)
	{
		// 
	}





	public function addComment($key,$data)
	{
		$this->comments[$key] = $data;
	}
	
	
	
	public function getComments()
	{
		return '<p style="width:600px;overflow:scroll;">'.implode('<br />',$this->comments).'</p>';
	}



	public function getPicklistValues($objectName, $fieldApiName)
	{
		$this->addTemplateLocation(
			'sites/default/modules/directory/templates'
		);

		$sobject = $this->doApiSchemaRequest($objectName);
		
		// $sobject = new SObject($json);
		$field = $sobject->getField($fieldApiName);
		
		// print $sobject;exit;
		// $results = $this->fieldPicklist($objectName,$fieldApiName);	
		// * objectInfo
	 // * doApiSchemaRequest
	 print $field->getPicklistAsHtmlSelect();
	 
		print "<pre>" . print_r($field->getPicklistValuesAll())."</pre>";
		exit;
		return array(
			'#attached' => array(
				'css' => array(
					'/sites/default/modules/directory/css/directory.css'
				)
			),
			'#markup' => $this->render('group-'.$fieldApiName, array(
				'query' 		=> $soql,
				'link'			=> $link,
				'error'			=> $error,
				'results'		=> $results))
		);
	}


	

	/**
	 * API function Get picklist values for the given field
	 */	
	public function fieldPicklist($forceObjectName,$fieldApiName)
	{
		$json = $this->objectInfo($forceObjectName);
		
		$field = $json->getField($fieldApiName);
		return $field->getPicklistValues();
		
		print "<pre>";
		var_dump($field->getPicklistValues());
		print "</pre>";
		exit;
	}
	
	
	
	public function objectInfo($forceObjectName)
	{
		$json = $this->doApiSchemaRequest($forceObjectName);

		if(!count($json))
		{
			throw new \Exception('Error: returned JSON was empty');
		}
		return $json;
	}
	
	
	
	public function renderObjectInfo($forceObjectName)
	{	
	
		// This is a Clickpdx\Salesforce\SObject object
		$sobject = $this->objectInfo($forceObjectName);
		print get_class($sobject);
		
		// print "<pre>" . print_r($sobject->getFields(),true)."</pre>";
		// print $sobject;

		/**
		 *
		 * We also have prependPath() and exists()
		 * functions.
		 */
		$this->addTemplateLocation(
			'sites/default/modules/directory/templates'
		);
		return $this->render('forceObject', array(
			// 'query' 	=> $schemaService->getSoqlQuery(),
			'link' 		=> $instanceUrl,
			'fields' 	=> $sobject->getFields()
		));
	}
	
}