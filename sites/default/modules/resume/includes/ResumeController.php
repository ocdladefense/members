<?php

use Clickpdx\Core\Controller\ControllerBase;

class ResumeController extends ControllerBase
{
	
	public function resume_resume($arg0,$version)
	{
		/**
		 * Example: send mail.
		 *
		 * See how easy it is to send mail now?
		 */
		// $this->mail('jbernal.web.dev@gmail.com','hello','hello world!');
		
		$out = resume_version($version);
		// $out->add_html_comment ... @todo, make this OOP.
		return $out .= add_html_comment("Resume version {$version}.");
	}
	
}