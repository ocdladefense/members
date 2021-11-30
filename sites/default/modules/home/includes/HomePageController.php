<?php

use Clickpdx\Core\Controller\ControllerBase;

class HomePageController extends ControllerBase
{
	
	public function showHomepage()
	{
	

		/**
		 *
		 * We also have prependPath() and exists()
		 * functions.
		 */
		$this->addTemplateLocation(
			'sites/default/modules/home/templates'
		);
		return $this->render('home', array());
	}	
	
	public function showLoginReminder()
	{

		/**
		 *
		 * We also have prependPath() and exists()
		 * functions.
		 */
		$this->addTemplateLocation(
			'sites/default/modules/home/templates'
		);
		return $this->render('password-reset', array());
	}	
}