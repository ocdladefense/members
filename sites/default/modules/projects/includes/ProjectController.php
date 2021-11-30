<?php

use Clickpdx\Core\Controller\ControllerBase;

class ProjectController extends ControllerBase
{



	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function show_directory_screenshots()
	{	
		require(setting('system.filesDir').'/data/directory-screenshots.php');
		
		// trigger_error('foobar',E_USER_WARNING);
		$this->addTemplateLocation(
			'sites/default/modules/projects/templates'
		);

		return array(
			'#attached' => array(
				'css' => array(
					'/sites/default/modules/projects/css/webgov.css'
				)
			),
			'#markup' => $this->render('screenshots',getWebGovData()),
		);
	}



	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function show_project_update()
	{	
		// trigger_error('foobar',E_USER_WARNING);
		$this->addTemplateLocation(
			'sites/default/modules/projects/templates'
		);

		return array(
			'#attached' => array(
				'css' => array(
					'sites/default/modules/projects/css/projects.css'
				)
			),
			'#markup' => $this->render('projects',array(
				'notices' => array(
					// 'Wed July 27, 10 AM: Our <a href="https://docs.google.com/document/d/1ppbO3IeU6YxHhgBrmSX23zJZXDQvvA6Nv3_Fa65WFT0/edit?usp=sharing">AMS Post-launch meeting</a> has been tentatively scheduled for Thursday, Aug 4 at 9:00 am.',
					'Tue Oct 25, 12:30 PM: A new MemberNation release is available.  The features are documented <a target="_new" href="https://www.ocdla.org/fonteva-release-notes.html">here</a>.',
					'Mon Oct 3, 10 AM: Sandbox Update: <a href="https://cs10.salesforce.com" target="_new">Sandbox backend</a> is now available.  A refreshed Sandbox eStore will be available tomorrow, Oct 4; the previous Sandbox eStore is no longer available.',
					'Mon Sept 19, 9 AM: Sandbox Update: The refreshed <a href="https://ocdpartial-ocdla.cs22.force.com" target="_new">Sandbox eStore</a> is available.',
					'Thu Sept 15, 10:30 AM: A new Sandbox refresh is in process.  Return to this page Tuesday for the most recent Sandbox links.',
					// 'Wed Mar 2, 8 AM: New Documentation <a href="https://docs.google.com/drawings/d/1flIXCgB1b5RQhpBKuxG08Wy5kbk1LZFEecchaaxnMEs/edit" target="_new">"Event Registration Workflow"</a> was created.',
					// 'Wed Feb 24, 9 AM: Mailing addresses and Work Phone numbers for Contacts have been uploaded.',
					// 'Tue Feb 23, 10 AM: Sales Orders entered since Feb 1 have been re-imported into Salesforce.',
				),
				'lastUpdated' => 'Sept 19, 2016',
				'projects' => $this->getProjects()
			)),
		);
	}
	
	
	
	
	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function show_webgov_update()
	{	
		require(setting('system.filesDir').'/data/webgov.php');
		$webgov = getWebGovData();
		$notices = $webgov['notices'];
		$links = $webgov['links'];
		$projects = $webgov['projects'];
		$lastUpdated = $webgov['lastUpdated'];
		
		// trigger_error('foobar',E_USER_WARNING);
		$this->addTemplateLocation(
			'sites/default/modules/projects/templates'
		);

		return array(
			'#attached' => array(
				'css' => array(
					'sites/default/modules/projects/css/webgov.css'
				)
			),
			'#markup' => $this->render('webgov',array(
				'notices' => array(
					// 'Wed July 27, 10 AM: Our <a href="https://docs.google.com/document/d/1ppbO3IeU6YxHhgBrmSX23zJZXDQvvA6Nv3_Fa65WFT0/edit?usp=sharing">AMS Post-launch meeting</a> has been tentatively scheduled for Thursday, Aug 4 at 9:00 am.',
					'Tue May 16, 12:30 PM: Next Web Governance Committee meeting is ___________.',
				),
				'notices' => $notices,
				'lastUpdated' => $lastUpdated,
				'projects' => $projects,
				'links' => $links
			)),
		);
	}
	
	
	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function jsTesting()
	{	
		// trigger_error('foobar',E_USER_WARNING);
		$this->addTemplateLocation(
			'sites/default/modules/projects/templates'
		);

		return array(
			'#attached' => array(
				'js' => array(
					'/sites/all/libraries/clickpdx/scriptloader/script-loader.js',
					'/sites/default/modules/projects/js/inheritance.js'
				)
			),
			'#markup' => $this->render('projects',array(
				'notices' => array(
					'Wed Mar 2, 8 AM: New Documentation <a href="https://docs.google.com/drawings/d/1flIXCgB1b5RQhpBKuxG08Wy5kbk1LZFEecchaaxnMEs/edit" target="_new">"Event Registration Workflow"</a> was created.',
					'Wed Feb 24, 9 AM: Mailing addresses and Work Phone numbers for Contacts have been uploaded.',
					'Tue Feb 23, 10 AM: Sales Orders entered since Feb 1 have been re-imported into Salesforce.',
				),
				'lastUpdated' => 'Feb 22, 2016',
				'projects' => $this->getProjects()
			)),
		);
	}
	
	
	private function getProjects()
	{
		return array(
			array(
				'title' => 'AMS Sandbox Refresh Complete',
				'summary' => 'OCDLA\'s Sandbox site has been refreshed.',
				'date_completed' => 'Oct 3, 12:00 PM',
				'description' => '<!--<em>NOTE:</em> The Sandbox refresh is in process and these links may or may not work while the site is refreshed.<p />-->The OCDLA <a href="https://cs10.salesforce.com">Sandbox site</a> has been refreshed (please update any bookmarks accordingly, as the link may change on each refresh.)  The Sandbox site now contains recent data from the Production AMS as well as relevant changes to the <a href="https://ocdpartial-ocdla.cs10.force.com/">eStore</a>.  Your Sandbox username will be your regular Salesforce username @ "sandbox.ocdla.org."  Your password will be the same as your (current) Salesforce password.  Please note that some links in the Sandbox eStore will still (incorrectly) point to corresponding links in the Production eStore - for now please adjust those links manually in your web-browser\'s address bar.',
				'thumbnail' => 'dashboard.png'
			),
			array(
				'title' => 'FileMaker Interactions',
				'summary' => 'Interaction headers have been uplaoded to the AMS.',
				'date_completed' => 'Feb 22, 9:00 AM',
				'description' => 'Approximately 50,000 historical Interaction headers have been exported from FileMaker Pro and uploaded to the AMS as Sales Orders.  View <a href="https://na16.salesforce.com/a18?fcf=00Bj00000012RKK" target="_new">all AMS Sales Orders</a> or view only those for <a href="https://na16.salesforce.com/a18?fcf=00Bj00000012RKK" target="_new">FY 2015</a>.',
				'thumbnail' => 'accounting.png'
			),
			array(
				'title' => 'Salesforce Dashboards',
				'summary' => 'Dashboards are now available in the AMS.',
				'date_completed' => 'Feb 19, 3:30 PM',
				'description' => 'Dashboard permissions have been fixed and users can now update their <a href="https://na16.salesforce.com/home/home.jsp" target="_new">AMS Home Screens</a> with any available dashboard.',
				'thumbnail' => 'dashboard.png'
			)
		);
	}
}