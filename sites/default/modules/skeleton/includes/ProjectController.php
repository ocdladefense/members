<?php

use Clickpdx\Core\Controller\ControllerBase;

class ProjectController extends ControllerBase
{

	/**
	 * Show an easy to read list of projects.
	 *
	 * A list of projects that are currently being worked on.
	 */
	public function show_project_update()
	{	
		$this->addTemplateLocation(
			'sites/default/modules/projects/templates'
		);

		return $this->render('projects');
	}
	
}