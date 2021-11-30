<?php

function resumeItems($item)
{
	$projects = array(
		
		'ocdla' => array(
			'project' => 'ocdla',
			'site_url' => 'https://ocdla.org',
			'title' => 'Accomplishments',
			'description' => 'Projects that I\'ve completed with OCDLA.',
			'projects' => array(
				array(
					'title' => 'Salesforce integration',
					'desc' => 'Integrate OCDLA\'s Salesforce data into existing web applications.  Create a custom API based on the OAuth RFC to securely use Salesforce member data in the OCDLA membership directory.',
				),
				array(
					'title' => 'MediaWiki & ColdFusion web development',
					'desc' => 'Maintain legacy ColdFusion e-commerce website and OCDLA\'s Library of Defense (LOD) websites.  Create custom skin, authentication and Varnish caching MediaWiki extensions.',
				),
				array(
					'title' => 'Single sign-on',
					'desc' => 'Implement SAML-based single sign-on throughout multiple OCDLA web properties. Use Just-in-time account provisioning to grant default preferences and accounts to new users of the Library of Defense and OCDLA Store websites.',
				),
			),
			'duties' => array(
				array(
					'title' => 'Manage data-integration',
					'duty' => 'Develop PHP/JavaScript applications to share data between the organization\'s CRM and websites, including data on OCDLA products and members, shared through the web store and membership directory.'
				),
				array(
					'title' => 'Maintain & upgrade servers',
					'duty' => 'Maintain OS X and Linux web servers and applications and ensure that security updates are installed. Configure Apache and related load-balancing applications.  Use Bash/linux command-line tools to install security updates and shell scripts.'
				),
				array(
					'title' => 'Plan website upgrades and timelines',
					'duty' => 'Assess website technologies and performance and suggest alternatives to plan for and further the organization\'s goals. Plan realistic timelines for web development, testing and launch and coordinate administrative aspects with OCDLA staff, including the organization\'s Web Governance Committee.'
				),
				array(
					'title' => 'Maintain database servers',
					'duty' => 'Maintain MySQL and FileMaker database servers.'
				),
			),
		),
	
		'dte' => array(
			'project' => 'dte',
			'site_url' => 'https://downtoearthdistributors.com',
			'title' => 'Accomplishments',
			'description' => 'Projects that I\'ve completed with DTE.',
			'duties' => array(
				array(
					'title' => 'Implement Photoshop designs',
					'duty' => 'Meet regularly with the company\'s in-house designer to implement new theme templates and project management.'
				),
				array(
					'title' => 'Project management',
					'duty' => 'Use standard project mangement techniques to plan application development, create agendas, and create reasonable timelines for project completion.'
				),
				array(
					'title' => 'Develop testing routines',
					'duty' => 'Work with project point-person to develop standard testing routines to facilitate the project.'
				),
			),
			'projects' => array(
				array(
					'title' => 'Backbone.js Single-Page Application development',
					'desc' => 'Convert legacy order form to a Single-Page Application (SPA).  Customers can easily enter large orders by item code or UPC and order data is persisted to the database server as it changes.',
				),
				array(
					'title' => '.NET/MySQL data integration',
					'desc' => 'Create long-running Windows Services to sync A/R and inventory from the company\'s Sage MAS/90 accounting system.  Both datasources are polled every 60 seconds before customer history and product updates are transferred to the DTE E-commerce website.',
					'tech' => array('C#.NET','ProvideX ODBC','MySQL Connector/.NET')
				),
				array(
					'title' => 'AWS systems development',
					'desc' => 'Configure load-balancing, caching, application and database servers as Amazon EC2 instances.  Manage SSH resources and basic SSL security.',
				),
				array(
					'title' => 'Drupal 7 module development',
					'desc' => 'Create and install dozens of custom Drupal 7 modules using standard Drupal API calls.',
				),
				
			),
		),

		
		
		'pc' => array(
			'project' => 'pc',
			'site_url' => 'http://www.petercorvallis.com',
			'title' => 'Accomplishments',
			'description' => 'Project highlights',
			'duties' => array(
				array(
					'title' => 'Implement web designer\'s comps',
					'duty' => 'Work with web designer to implement Photoshop comps for mobile and desktop themes in accordance with Magento theming.'
				),
				array(
					'title' => 'Project management',
					'duty' => 'Provide timeline feedback and status updates on features leading up to on-time launch.'
				),
				array(
					'title' => 'Refactor PHP implementation',
					'duty' => 'Assess deprecated PHP code, make code fixes and resurrect native software features that were spuriously removed.'
				)
			),
			'projects' => array(
				array(
					'title' => 'Custom PHP build',
					'desc' => 'Build and compile Apache and PHP versions compatible with legacy version of Magento.',
				),
				array(
					'title' => 'Magento theme implementation',
					'desc' => 'Implement the designer\'s desktop and mobile comps using Magento\'s XML-driven theme engine. Standardize the use of these template files throughout the company\'s online catalog and optimize the use of JavaScript and CSS.',
				),
				/*array(
					'title' => 'CSS Media Query API',
					'desc' => 'Extend Magento APIs to incorporate CSS media queries, especially for mobile phone devices.',
				),
				*/
			),
		),
		
	/*		
			'hsolc' => array(
				'project' => 'hsolc',
				'site_url' => 'http://www.petercorvallis.com',
				'title' => 'Accomplishments',
				'description' => 'Project highlights',
				'items' => array(
					array(
						'title' => 'Magento theme implementation',
						'desc' => 'I worked with Peter Corvallis to implement their desktop and mobile comps using Magento\'s XML-driven theme engine.  I standardized the use of these templates throughout the company\'s online catalog and optimized the use of JavaScript and CSS.',
					),
					array(
						'title' => 'CSS Media Query API',
						'desc' => 'XML templates include APIs for including device-based CSS. I extended the APIs to incorporate CSS media queries to optimize flow for mobile phone devices.',
					),
				),
			),
	*/		
		'sockeye' => array(
			'project' => 'sockeye',
			'site_url' => 'http://www.petercorvallis.com',
			'title' => 'Accomplishments',
			'description' => 'Project highlights',
			'projects' => array(
				array(
					'title' => 'XML-based CMS',
					'desc' => 'Create a custom XML-based CMS. The CMS combines titles and descriptions from an asset XML file with the firm\'s portfolio of artwork. Single projects and groups of assets are queried from the XML file using XPath methods, then organized onto the View layer by invoking page, project and asset template files.',
				)
			),
			'duties' => array(
				array(
					'title' => 'foobar',
					'duty' => 'Some duty...',
				)
			)
		),
		
		
	);
	return isset($projects[$item])?$projects[$item]:array();
};