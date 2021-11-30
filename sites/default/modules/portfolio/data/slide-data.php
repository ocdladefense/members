<?php

	$projects = array(
		'sockeye' => array(
			'site_url' => 'http://sockeye.tv',
			'title' => 'Sockeye',
			'description' => 'Sockeye is one of Portland\'s most established creative firms.',
			'frames' => array(
				array(
					'image' => "sockeye.png",
					'caption' => 'XML-based CMS',
					'caption_text' => 'I worked with the Web Developer to create a custom XML-based MVC CMS. The CMS combines titles and descriptions from XML with the firm\'s creative assets. Single projects and groups of assets are queried from the XML file using XPath methods, then organized onto the View layer by invoking page, project and asset template files.',
				),
			),
		),
		'dte' => array(
			'site_url' => 'https://downtoearthdistributors.com',
			'title' => 'Down To Earth Distributors, Inc.',
			'description' => 'Down To Earth is a wholesale company based in Eugene, Oregon with national distribution of all-natural garden and housewares products.',
			'frames' => array(
				array(
					'image' => "dte-catalog.png",
					'caption' => 'ProvideX to MySQL Integration',
					'caption_text' => 'DTE uses the popular MAS90 accounting software from Sage Systems. Data transfer out of MAS is driven by the ProvideX ODCB driver.  Product updates are queried every 60 seconds from the Sage MAS 90 server and handshaked to the database server using MySQL\'s native C# driver.  Administrators can opt-in for update notifications, which are emailed after each update iteration.',					
				),
				array(
					'image' => "dte-spa.png",
					'caption' => 'Shopping Cart: Single Page App',
					'caption_text' => 'Customers can quickly type in an order, select quantities and view updated totals without having to navigate through multiple page refreshes.  The cart is auto-saved with each operation.  Discount volume pricing is calculated on-the-fly using the JSON-product payload on the client.',					
				),
				array(
					'image' => "dte-sphinx.png",
					'caption' => 'Drupal Search via Sphinx',
					'caption_text' => 'Swapping out the default Drupal search with the Sphinx full-text engine gives customers more useful search facilities.  The English lemmatizer coupled with custom Wordforms ensures that industry-specific terms will return expected results.  I utilized custom ranking algorithms to make sure that matches within titles, descriptions, UPCs and models are weighted according to the company\'s sales priorities.',					
				),
				array(
					'image' => "dte-3.png",
					'caption' => 'Amazon EC2',
					'caption_text' => 'Clustering the application, caching, data and indexing services minimizes downtime for maintenance and increases stability and performance.  Each instance runs on Amazon EC2 medium VMs.  I implemented the Pound load balancer to ensure future scalability.',					
				),
			),
		),
		'hsolc' => array(
			'site_url' => 'https://www.hsolc.org',
			'title' => 'Head Start of Lane County',
			'description' => 'HSOLC serves families and children by providing educational, nutritional and social services.',
			'frames' => array(
				array(
					'image' => "hsolc-1.png",
					'caption' => 'Design Integration',
					'caption_text' => 'Asset and templates were delivered as PSD files.  I constructed a Drupal 6 theme using the PHPTemplate engine, global and granular template files, and added custom WYSIWYG and workflow modules to automate content creation between staff members.'
				),
				array(
					'image' => "hsolc-1.png",
					'caption' => 'Data Migration',
					'caption_text' => 'I migrated content from HSOLC\'s legacy static website using a PHP HTML parser and Regular Expressions. The program parsed and cleaned up faulty markup so that content wouldn\'t have to be re-created.  New pages and URL aliases were programmatically imported into the Drupal CMS using a PHP CLI program I wrote.',
				),
				array(
					'image' => "hsolc-2.png",
					'caption' => 'Staff Portal',
					'caption_text' => 'All HSOLC staff access relevant services through the website portal.  This ensures that they have timely access to website documents, announcements, photo galleries and policies and procedures stored in the CMS.',
				),
			),
		),
		'ocdla' => array(
			'site_url' => 'https://www.ocdla.org',
			'title' => 'OCDLA',
			'description' => 'OCDLA provides services and legal education to most of Oregon\'s public defenders and curates the Library of Defense, an extensive online collection of scholarly articles and commentaries on Oregon statutes and law. Their 1,300-member strong registry is managed using a custom FileMaker solution.',
			'frames' => array(
				array(
					'image' => "ocdla-1.png",
					'caption' => 'Website-to-intranet integration',
					'caption_text' => 'OCDLA uses a variety of technologies incuding ColdFusion, FileMaker Server 11, PHP, MediaWiki and Symfony2 technologies. ',
				),
				array(
					'image' => "ocdla-profile.png",
					'caption' => 'Online Profiles',
					'caption_text' => 'OCDLA members\' contact information is synced with their online membership directory via an ODBC driver. This enables members to manage their own directory information and better locate other members with complementary legal interests.',
				),
				array(
					'image' => "lod-2.png",
					'caption' => 'Single Sign-On',
					'caption_text' => 'Members who login to the OCDLA website are automatically granted access to their Library of Defense account.  Authentication is automated by issuing a cURL request against the <a class="external" href="http://www.mediawiki.org/wiki/API:Main_page">MediaWiki API</a>.  I implemented a batch SQL job to sync usernames, passwords and membership access between the various SQL data stores.'
				),
			),
		),
		'pc' => array(
			'site_url' => 'http://www.petercorvallis.com',
			'title' => 'Peter Corvallis Productions',
			'description' => 'Peter Corvallis is one of the Northwest\'s top event rental and audio-visual companies.  Their website showcases the company\'s work and some of the thousands of themed items for rent.',
			'frames' => array(
				array(
					'image' => "pc-2.png",
					'caption' => 'Magento Development & Design Integration',
					'caption_text' => 'I worked with Peter Corvallis to implement their desktop and mobile comps using Magento\'s XML-driven theme engine.  I standardized the use of these templates throughout the company\'s online catalog and optimized the use of JavaScript and CSS.',
					'attributes'=>array('classes_array'=>array('with-border')),
				),
				array(
					'image' => "pc-mobile.png",
					'caption' => 'Mobile-friendly',
					'caption_text' => 'XML templates include APIs for including device-based CSS. I extended the APIs to incorporate CSS media queries to optimize flow for mobile phone devices.',
					'attributes'=>array('classes_array'=>array('with-border')),
				),
			),
		),
		'jacobs' => array(
			'title' => 'Jacobs Agency',
			'site_url' => 'http://jacobsagency.com',
			'description' => 'Jacobs Agency is an established Chicago-based design agency.',
			'frames' => array(
				array(
					'image' => "jacobs-1.png",
					'caption' => 'Unique Content',
					'caption_text' => 'Jacobs Agency chose Drupal as their platform to deliver an interactive portolio of their work.',
				),
				array(
					'image' => "jacobs-2.png",
					'caption' => 'Widget/CMS Integration',
					'caption_text' => '.',
				),
				array(
					'image' => "jacobs-3.png",
					'caption' => 'More',
					'caption_text' => 'Jacobs Agency continues to use the CMS portal to advertise recent news and company announcements.',
				),
			),
		),
	);