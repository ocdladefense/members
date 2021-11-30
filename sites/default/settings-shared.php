<?php


$settings = array(

	'theme.ismobile' => false,

	'directory.showExpertWitnessLink' => true,


	'directory.queries.member' => "SELECT Id, FirstName, LastName, MiddleName,
	Ocdla_Is_Expert_Witness__c,
	Ocdla_Organization__c,
	MailingStreet, MailingCity, MailingState, MailingPostalCode,
	Ocdla_Bar_Number__c,
	OrderApi__Work_Phone__c,
	MobilePhone,
	Fax,
	OrderApi__Work_Email__c,
	Ocdla_Publish_Home_Address__c,
	Ocdla_Publish_Mailing_Address__c,
	Ocdla_Publish_Work_Email__c,
	Ocdla_Publish_Work_Phone__c,
	Ocdla_Website__c
	FROM Contact WHERE Id='%s'",


	'directory.queries.expertWitness' => "SELECT Id, FirstName, LastName, MiddleName,
	Ocdla_Organization__c,
	MailingStreet, MailingCity, MailingStateCode, MailingPostalCode, Ocdla_Publish_Mailing_Address__c,
	Ocdla_Bar_Number__c,
	OrderApi__Work_Phone__c,
	MobilePhone,
	Fax,
	OrderApi__Work_Email__c,
	Ocdla_Publish_Work_Email__c,
	Ocdla_Website__c,
	Ocdla_Expert_Witness_Primary__c,
	Ocdla_Expert_Witness_Other_Areas__c,
	Ocdla_Expert_Comments__c,
	Ocdla_Expert_Travel_Availability__c,
	Ocdla_Expert_Hourly_Rate__c,
	Ocdla_Expert_Minimum_Hours__c,
	Ocdla_Expert_Unavailability_Start_Date__c,
	Ocdla_Expert_Unavailability_End_Date__c
	FROM Contact WHERE Id='%s'",

	'directory.queries.searchLastName' => "SELECT Id, FirstName, LastName FROM Contact WHERE LastName LIKE '%%%s%%'",





/**
 * ORDER OBJECT
 */

	'force.import.object.order.fields' => array('LastModifiedDate','Id','EffectiveDate','BillToContactId','Status'),

	'force.import.object.order.doImportMysql' => true,

	'force.import.object.order.breakField' => 'OrderNumber',
	
	'force.import.object.order.mysqlTableName' => 'force_order',
	
	'force.import.object.order.key' => 'Id',
	
	
	
/**
 * PRODUCT2 OBJECT
 */

	'force.import.object.product2.fields' => array('LastModifiedDate','Id','Name','IsActive','ClickpdxCatalog__HtmlDescription__c','ClickpdxCatalog__IsDownloadable__c', 'ClickpdxCatalog__IsMembersOnly__c','ClickpdxCatalog__IsOption__c','ClickpdxCatalog__IsParent__c','Event__c'),

	'force.import.object.product2.doImportMysql' => true,

	'force.import.object.product2.breakField' => 'Id',
	
	'force.import.object.product2.mysqlTableName' => 'force_product2',
	
	'force.import.object.product2.key' => 'Id',
	

	
	/**
	 * ORDER ITEM OBJECT
	 */
	'force.import.object.orderitem.fields' => array('IsDeleted','LastModifiedDate','Id','OrderId','OcdlaProduct2Id__c','OcdlaEventId__c','PricebookEntryId','Contact__c','FirstName__c','LastName__c','Quantity','UnitPrice','TotalPrice','OcdlaProductName__c','Description','OrderItemNumber','Note_1__c','Note_2__c','Note_3__c','Data__c'),

	'force.import.object.orderitem.doImportMysql' => true,

	'force.import.object.orderitem.breakField' => 'OcdlaAutoNumberInt__c',
	
	'force.import.object.orderitem.mysqlTableName' => 'force_orderitem',
	
	'force.import.object.orderitem.key' => 'Id',






	'force.import.object.contact.fields' => array('LastModifiedDate','Ocdla_Auto_Number_Int__c','Id','AccountId','Title','FirstName','LastName','MiddleName','Ocdla_Address_Line_1__c','Ocdla_Address_Line_2__c','MailingStreet','MailingCity','MailingState','MailingStateCode','MailingPostalCode',
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
		'Fax','OrderApi__Work_Phone__c','OrderApi__Work_Email__c','Ocdla_Cell_Phone__c'),


	'force.import.object.contact.doImportMysql' => false,

	'force.import.object.contact.breakField' => 'Ocdla_Auto_Number_Int__c',
	
	'force.import.object.contact.mysqlTableName' => 'force_contact',
	
	'force.import.object.contact.key' => 'Id',

	'force.import.recentRecordsDaysPrevious' => 10,


	/* Settings for deleted contacts */
	'force.import.object.contactDeleted.key' => 'Id',
	
	'force.import.object.contactDeleted.fields' => array('Id','Name'),
	
	'force.import.object.contactDeleted.mysqlTableName' => 'force__contact_deleted',
	
	
	

	
	'directory.queries.baseSearch' => "SELECT Id, Ocdla_Occupation_Field_Type__c, 	Ocdla_Is_Expert_Witness__c, Ocdla_Current_Member_Flag__c, Ocdla_Contact_ID__c, FirstName, LastName, Ocdla_Organization__c, MailingStreet, MailingCity, MailingStateCode, MailingPostalCode, Ocdla_Publish_Work_Phone__c, Ocdla_Publish_Work_Email__c, Ocdla_Publish_Mailing_Address__c, OrderApi__Work_Phone__c, OrderApi__Work_Email__c, Ocdla_Website__c FROM Contact WHERE ",
	
	
	'directory.queries.category.MailingCity' => "SELECT MailingCity FROM Contact WHERE Ocdla_Current_Member_Flag__c=True AND MailingCity != '' GROUP BY MailingCity ORDER BY MailingCity",
	
	'directory.queries.category.Ocdla_County__c' => "SELECT Ocdla_County__c FROM Ocdla_Address_Info__c WHERE Ocdla_State__c='OR' AND Ocdla_County__c != '' GROUP BY Ocdla_County__c ORDER BY Ocdla_County__c",
	
	// 'directory.queries.category.aoi' => "SELECT MailingCity FROM Contact GROUP BY MailingCity ORDER BY MailingCity",
	
	'directory.queries.category.Ocdla_Occupation_Field_Type__c' => "SELECT Ocdla_Occupation_Field_Type__c FROM Contact WHERE Ocdla_Current_Member_Flag__c=True AND Ocdla_Occupation_Field_Type__c != '' GROUP BY Ocdla_Occupation_Field_Type__c ORDER BY Ocdla_Occupation_Field_Type__c",


	

	
	'force.import.object.event__c.fields' => array('LastModifiedDate','Id','Name','Start_Date__c'),

	'force.import.object.event__c.breakField' => 'Id',
	
	'force.import.object.event__c.mysqlTableName' => 'force_event__c',
	
	'force.import.object.event__c.key' => 'Id',

	
	

	
	
/**
 * SPEAKER OBJECT
 */

	'force.import.object.speaker__c.fields' => array('LastModifiedDate','Id','Chapter__c','Contact__c','Event__c','Type__c'),

	'force.import.object.speaker__c.doImportMysql' => true,

	'force.import.object.speaker__c.breakField' => 'Id',
	
	'force.import.object.speaker__c.mysqlTableName' => 'force_speaker__c',
	
	'force.import.object.speaker__c.key' => 'Id',
	
	
	
	
	/**
	 * The log formats use the same syntax as
	 * sprintf() and is passed:
	 * $code, $message, $errFile, $errLine
	 */
	'error.logFormat' => 'MEMBER TEST - %1$s | %2$s in %3$s (Line %4$d)',

	// define( 'NOTIFICATION_EMAIL', 'jbernal.web.dev@gmail.com, info@ocdla.org' );
	'system.notificationEmail' => 'jbernal.web.dev@gmail.com, info@ocdla.org',


	// define( 'CART_DEFAULT_REDIRECT_SERVER','www.ocdla.org');
	'system.defaultCartServer' => 'www.ocdla.org',


	'system.loginUrl' => "auth.ocdla.org/login",


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
	'system.filesDir' => DRUPAL_ROOT.'/sites/ocdla/files',

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
	
	/**
	 * Email log.
	 *
	 * Whether to always email the log.
	 * If false, then the log is only emailed if there are
	 * errors.  If true, then the log is always emailed, even if there are
	 * no errors.
	 */
	

	'resources' => array(
		'default' => array(
			'type' => 'db',
			'class' => 'Clickpdx\Core\Database\DB_Mysql',
			'driver' => 'mysql',
			'database' => defined('DB_NAME') ? DB_NAME : null,
			'username' => defined('DB_USER') ? DB_USER : null,
			'password' => defined('DB_PASS') ? DB_USER : null,
			'hostname' => defined('DB_HOST') ? DB_HOST : null,
			'prefixes' => array(
				'lodusers' => 'lodwiki.user',
			)
		),

		'sfOauth' => array(
			'type' => 'oauthService',
			'class' => 'OathHttpAuthorizationService',
			'namespace' => 'Ocdla',
			'params' => array(
				'consumerId' => '3MVG9ahGHqp.k2_yZ2aRg3CkVnwJbwxEi.TBQdZu6zzLBJxCNZxxxOTUfHViJT_2pIw.ocrS0LTfRvB8Txx5p',
				'clientSecret' => '3692704820829258171',
				'redirectUri' => 'https://members.ocdla.org/directory/callback',
				'loginUri' => 'https://test.salesforce.com',
				'authEndpoint' => '/services/oauth2/authorize',
				'accessTokenEndpoint' => '/services/oauth2/token',
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
				'consumerId' => '3MVG9ahGHqp.k2_yZ2aRg3CkVnwJbwxEi.TBQdZu6zzLBJxCNZxxxOTUfHViJT_2pIw.ocrS0LTfRvB8Txx5p',
				'clientSecret' => '3692704820829258171',
				'soqlEndpoint' => '/services/data/v29.0/queryAll',
				'serviceEndpoint' => '/services/data/v29.0',
				'endpoints'=> array(
					'sobjects'					=>'/services/data/v29.0/sobjects',
					'sobject' 					=> '/services/data/v29.0/sobjects/{object}/describe',
					'account-info'			=>'/Account/{id}',
					'all-accounts' 			=> '/SOQL/q={query}',
				),
			),
			'comment' => 'Connector for the Salesforce membership directory.'
		)
	)
);