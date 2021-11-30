<?php


$settings = array(

	'theme.ismobile' => true,

	'ccAuthorize.useSandbox' => false,

	'ccAuthorize.sandboxMerchantId' => 'some-sandbox-MerchantId',
	
	'ccAuthorize.sandboxMerchantTransactionKey' => 'some-sandboxMerchantTransactionKey',

	'ccAuthorize.merchantId' => 'some-prod-merchantId',
	
	'ccAuthorize.merchantTransactionKey' => 'some-prod-merchantTransactionKey',

	// 'ccAuthorize.sandboxEndpoint' => \net\authorize\api\constants\ANetEnvironment::SANDBOX,

	// 'ccAuthorize.endpoint' => \net\authorize\api\constants\ANetEnvironment::PRODUCTION,

	'directory.showExpertWitnessLink' => true,

	'renewals.queries.unrenewedIndividualSingle' => 'SELECT Id, Ocdla_Occupation_Field_Type__c, Ocdla_Contact_ID__c, FirstName, LastName, Ocdla_Organization__c, MailingCity, MailingStateCode, MailingStreet, MailingPostalCode, Ocdla_Publish_Work_Phone__c, Ocdla_Publish_Work_Email__c, Ocdla_Publish_Mailing_Address__c, OrderApi__Work_Phone__c, Ocdla_Home_Street__c, Ocdla_Home_City__c, Ocdla_Home_State__c, Ocdla_Home_Zip__c, OrderApi__Work_Email__c, Ocdla_Website__c, Ocdla_Areas_of_Interest_1__c, Ocdla_Areas_of_Interest_2__c, Ocdla_Areas_of_Interest_3__c, Ocdla_Areas_of_Interest_4__c, Ocdla_Areas_of_Interest_5__c, Ocdla_Expert_Witness_Last_Updated__c, Ocdla_Expert_Witness_Primary__c FROM Contact WHERE Id=\'%s\'',

	// not paid office members
	'renewals.queries.unrenewedIndividual' => 'SELECT Id, Ocdla_Occupation_Field_Type__c, Ocdla_Contact_ID__c, FirstName, LastName, Ocdla_Organization__c, MailingCity, MailingStreet, MailingPostalCode, MailingStateCode, Ocdla_Publish_Work_Phone__c, Ocdla_Publish_Work_Email__c, Ocdla_Publish_Mailing_Address__c, OrderApi__Work_Phone__c, Ocdla_Home_Street__c, Ocdla_Home_City__c, Ocdla_Home_State__c, Ocdla_Home_Zip__c, OrderApi__Work_Email__c, Ocdla_Website__c, Ocdla_Address_Line_1__c, Ocdla_Address_Line_2__c, Ocdla_Areas_of_Interest_1__c, Fax, Ocdla_Areas_of_Interest_2__c, Ocdla_Areas_of_Interest_3__c, Ocdla_Areas_of_Interest_4__c, Ocdla_Areas_of_Interest_5__c, Ocdla_Expert_Witness_Last_Updated__c, Ocdla_Expert_Witness_Primary__c FROM Contact WHERE Ocdla_Is_Unrenewed__c = True AND Ocdla_Is_Paid_Office_Member__c = False ORDER BY MailingPostalCode ASC, LastName ASC, FirstName ASC LIMIT %d OFFSET %d',

	'subscription.queries.hasOnlineSubscriptionQuery' => "SELECT Id, OrderApi__Line_Description__c FROM OrderApi__Sales_Order_Line__c WHERE OrderApi__Item__c = 'a0wj0000003930v' AND OrderApi__Contact__c='%s'",

	'directory.queries.member' => "SELECT Id, FirstName, LastName, MiddleName,
	Ocdla_Organization__c,
	Ocdla_Current_Member_Flag__c,
	MailingStreet, MailingCity, MailingState, MailingPostalCode,
	Ocdla_Bar_Number__c,
	Ocdla_Investigator_License_Number__c,
	Ocdla_Areas_of_Interest_1__c, Ocdla_Areas_of_Interest_2__c, Ocdla_Areas_of_Interest_3__c, Ocdla_Areas_of_Interest_4__c, Ocdla_Areas_of_Interest_5__c,
	OrderApi__Work_Phone__c,
	Ocdla_Cell_Phone__c,
	Fax,
	OrderApi__Work_Email__c,
	Ocdla_Publish_Home_Address__c,
	Ocdla_Publish_Mailing_Address__c,
	Ocdla_Publish_Work_Email__c,
	Ocdla_Publish_Work_Phone__c,
	Ocdla_Website__c
	FROM Contact WHERE Id='%s'",

	'directory.queries.forceProductionMemberInfo' => "SELECT Id, Ocdla_Username__c, FirstName, LastName, MiddleName,
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
	FROM Contact WHERE Id='%s'",

	'directory.queries.searchLastName' => "SELECT Id, Ocdla_Contact_ID__c, FirstName, LastName, MiddleName, Ocdla_Organization__c FROM Contact WHERE LastName LIKE '%%%s%%' ORDER BY LastName ASC",

	'directory.queries.searchLastNameIn' => "SELECT Id, Ocdla_Contact_ID__c, FirstName, LastName, MiddleName, Ocdla_Organization__c FROM Contact WHERE LastName IN(%s) AND FirstName IN(%s) ORDER BY LastName ASC, FirstName ASC",

	'directory.queries.category.Ocdla_County__c' => "SELECT Ocdla_County__c FROM Ocdla_Address_Info__c WHERE Ocdla_State__c='OR' AND Ocdla_County__c != '' GROUP BY Ocdla_County__c ORDER BY Ocdla_County__c",


	// 'force.import.maxInsertRecords' => 2,

	'force.import.doImportMysql' => true,
	
	'force.import.maxBatches' => 20,
	
	'force.import.maxBatchSize' => 2000,

	'force.import.object.contact.fields' => array(
		'Id',
		'LastModifiedDate',
		'IsDeleted',
		'Ocdla_Auto_Number_Int__c',
		'AccountId',
		'Title',
		'FirstName',
		'LastName',
		'MiddleName',
		'Ocdla_Name_Badge__c',
		'Ocdla_Address_Line_1__c',
		'Ocdla_Address_Line_2__c',
		'MailingStreet',
		'MailingCity',
		'MailingState',
		'MailingStateCode',
		'MailingPostalCode',
		'OrderApi__Work_Phone__c',
		'OrderApi__Work_Email__c',
		'Ocdla_Cell_Phone__c',
		'Fax',
		'Ocdla_Home_Address_Publish__c',
		'Ocdla_Home_Street__c',
		'Ocdla_Home_City__c',
		'Ocdla_Home_State__c',
		'Ocdla_Home_Zip__c',
		'Ocdla_Organization__c',
		'Ocdla_Username__c',
		'Ocdla_Website__c',
		'Ocdla_Bar_Number__c',
		'Ocdla_Investigator_License_Number__c',
		'Ocdla_Occupation_Field_Type__c',
		'Ocdla_Areas_of_Interest_1__c',
		'Ocdla_Areas_of_Interest_2__c',
		'Ocdla_Areas_of_Interest_3__c',
		'Ocdla_Areas_of_Interest_4__c',
		'Ocdla_Areas_of_Interest_5__c',
		'Ocdla_Contact_Notes__c',
		'Ocdla_Noflag__c',
		'Ocdla_Is_Board_Member__c',
		'Ocdla_Is_Board_Member_Past__c',
		'Ocdla_Is_Board_Past_President__c',
		'Ocdla_Current_Member_Flag__c',
		'Ocdla_Member_Status__c',
		'Ocdla_Membership_Expiration_Date__c'
	),
		


/**
 * ORDER OBJECT
 */

	'force.import.object.order.fields' => array('LastModifiedDate','Id','OrderNumber','EffectiveDate','BillToContactId','Status'),

	'force.import.object.order.doImportMysql' => true,

	'force.import.object.order.breakField' => 'OrderNumber',
	
	'force.import.object.order.mysqlTableName' => 'force_order',
	
	'force.import.object.order.key' => 'Id',


	/**
	 * ORDER ITEM OBJECT
	 */
	'force.import.object.orderitem.fields' => array('IsDeleted','OcdlaAutoNumberInt__c','LastModifiedDate','Id','OrderId','OcdlaProduct2Id__c','OcdlaEventId__c','PricebookEntryId','Contact__c','FirstName__c','LastName__c','Quantity','UnitPrice','TotalPrice','OcdlaProductName__c','Description','OrderItemNumber','Note_1__c','Note_2__c','Note_3__c','Data__c'),

	'force.import.object.orderitem.doImportMysql' => true,

	'force.import.object.orderitem.breakField' => 'OcdlaAutoNumberInt__c',
	
	'force.import.object.orderitem.mysqlTableName' => 'force_orderitem',
	
	'force.import.object.orderitem.key' => 'Id',


	/**
	 * The log formats use the same syntax as
	 * sprintf() and is passed:
	 * $code, $message, $errFile, $errLine
	 */
	'error.logFormat' => 'MEMBERS PROD - %1$s | %2$s in %3$s (Line %4$d)',

	// define( 'NOTIFICATION_EMAIL', 'jbernal.web.dev@gmail.com, info@ocdla.org' );
	'system.notificationEmail' => 'jbernal.web.dev@gmail.com, info@ocdla.org',


	// define( 'CART_DEFAULT_REDIRECT_SERVER','www.ocdla.org');
	'system.defaultCartServer' => 'www.ocdla.org',

	'system.amsUrl'		=> 'https://ocdla.force.com',

	'system.loginUrl' => "auth.ocdla.org/login",

	'system.logoutUrl' => 'https://auth.ocdla.org/logout',

	'system.storeUrl' => 'https://www.ocdla.org/cart/index_newocdla.cfm',

	'system.checkoutUrl' => 'https://www.ocdla.org/cart/viewcart_newocdla.cfm',

	'system.externalLinks.lod' => 'https://lod.ocdla.org',
	
	'system.profileUrl' => 'https://ocdla.force.com/CPBase__profile',
	
	/**
	 * setting EMAIL_FROM
	 *
	 * The recipient email should be sent as coming from.
	 * This corresponds to the <From:> header for email.
	 */
	// define( 'EMAIL_FROM', 'Site Admin <admin@members.ocdla.org>' );
	'system.adminEmail' => 'Site Admin <admin@members.ocdla.org>',

	// define( 'EMAIL_RETURN_PATH', 'admin@members.ocdla.org' );
	'system.emailReturnPath' => 'admin@members.ocdla.org',

	// define( 'NOTIFICATION_EMAIL', 'jbernal.web.dev@gmail.com, info@ocdla.org' );
	'system.notificationEmail' => 'jbernal.web.dev@gmail.com, info@ocdla.org',

	// define( 'EMAIL_ERRORS',true);
	'system.emailErrors' => true,

	// set_error_handler("_errorHandler",E_ALL & ~8192 & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
	'system.errorHandler' => '_errorHandler',
	
	'system.errorHandlerParameters' => E_ALL & ~8192 & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED,

	// set_exception_handler(MyExceptionHandler::getHandler());
	'system.exceptionHandler' => \Clickpdx\Core\Exception\MyExceptionHandler::getHandler(),

	//  define( 'SITE_HOME', "www.ocdla.org" );

	'system.baseUrl' => 'https://members.ocdla.org',
	// $base_url = 'https://members.ocdla.org';

	
	// define( 'MESSAGES_DISPLAY_ERRORS', TRUE );


	// define( 'MODULE_DIR',DRUPAL_ROOT.'/sites/ocdla/modules' );
	'system.moduleDir' => DRUPAL_ROOT.'/sites/ocdla/modules',

	// define( 'FILES_DIR', DRUPAL_ROOT.'/sites/ocdla/files' );
	'system.filesDir' => DRUPAL_ROOT.'/sites/default/files',

	// define( 'CACHE_DIR', FILES_DIR . '/cache' );
	'system.cacheDir' => DRUPAL_ROOT.'/sites/ocdla/files/cache',

	// define( 'DOWNLOAD_PATH',DRUPAL_ROOT.'/downloads' );
	'system.downloadPath' => DRUPAL_ROOT.'/downloads',

	// define( 'SESSION_URL','auth.ocdla.org/session' );
	'system.sessionUrl' => 'auth.ocdla.org/session', 

	// define( 'DEBUG',FALSE);
	'system.debug' => false,

	// $protocol = !empty($_SERVER["HTTPS"])? "https://" : "http://";
	'http.protocol' => !empty($_SERVER["HTTPS"])? "https://" : "http://",

	//function settings
	// date_default_timezone_set ( "America/Los_Angeles" );
	'php.timezone' => "America/Los_Angeles",
	
	/**
	 * Downloads folder
	 *
	 * Set the downloads folder.
	 */
	// define('DOWNLOADS_FOLDER','sites/default/files/downloads');



	/**
	 * Uploads folder
	 *
	 * The uploads folder for this installation.
	 * The uploads folder is used to store original PDFs.  These can
	 * be considered the source PDFs from which the target PDFs are then
	 * altered and saved into the DOWNLOADS_FOLDER.
	 */
	// define('UPLOADS_FOLDER','sites/default/files/uploads');
	'system.uploadsFolder' => 'sites/default/files/uploads',
	
	'resources' => array(
	
		'default' => array(
			'type' => 'db',
			'class' => 'Clickpdx\Core\Database\DB_Mysql',
			'driver' => 'mysql',
			'database' => 'ocdla',
			'username' => 'wwwocdlaweb',
			'password' => 'buc7Uzad',
			'hostname' => '127.0.0.1',
			'prefixes' => array(
				'lodusers' => 'lodwiki.user',
			)
		),
	
		'lod' => array(
			'type' => 'db',
			'class' => 'Clickpdx\Core\Database\DB_Mysql',
			'driver' => 'mysql',
			'database' => 'lodwiki',
			'username' => 'mediawiki',
			'password' => '8a9F313a57',
			'hostname' => '127.0.0.1',
			'prefixes' => array()
		),

		'sfOauth' => array(
			'type' => 'oauthService',
			'class' => 'OathHttpAuthorizationService',
			'namespace' => 'Ocdla',
			'params' => array(
				'consumerId' => '3MVG9fMtCkV6eLhf1Go62CS4_dExU_dgwDzdzwIZRXQWwlzqKJjpPwWnN8PB2rpx83zeGVqjscz51qc7QtQWT',
				'clientSecret' => '467059192749570051',
				'redirectUri' => 'https://members.ocdla.org/salesforce/oauth',
				'loginUri' => 'https://login.salesforce.com',
				'authEndpoint' => '/services/oauth2/authorize',
				'accessTokenEndpoint' => '/services/oauth2/token',
				'username' => 'membernation@ocdla.com',
				'password' => 'asdi49ir4'
			),
			'endpoints' => array(
		
			),
			'comment' => 'Service to grant OAuth access to the Salesforce membership directory.'
		),
		
		
		'sfMemdir' => array(
			'type' => 'sfRestApi',
			'class' => 'SalesforceRestService',
			'driver' => 'curl',
			'params' => array(
				'consumerId' => '3MVG9fMtCkV6eLhf1Go62CS4_dExU_dgwDzdzwIZRXQWwlzqKJjpPwWnN8PB2rpx83zeGVqjscz51qc7QtQWT',
				'clientSecret' => '467059192749570051',
				'soqlEndpoint' => '/services/data/v37.0/queryAll',
				'serviceEndpoint' => '/services/data/v37.0',
				'endpoints' => array(
					'RECORD_UPDATE'			=> "/services/data/v37.0/sobjects/{sObject}/{Id}",
					'sobjects'					=> '/services/data/v37.0/sobjects',
					'sobject' 					=> '/services/data/v37.0/sobjects/{object}/describe',
					'queryAll'					=> '/services/data/v37.0/queryAll/',
					'account-info'			=> '/Account/{id}',
					'all-accounts' 			=> '/SOQL/q={query}',
				)
			),
			'comment' => 'Connector for the Salesforce membership directory.'
		)
	)
);