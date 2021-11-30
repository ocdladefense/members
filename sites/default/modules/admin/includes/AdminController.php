<?php

use Clickpdx\Core\Controller\ControllerBase;
use Ocdla\Member;
use Ocdla\PasswordResetAction;
use Clickpdx\Core\Output\MenuPage;




class AdminController extends ControllerBase
{
	public function adminAreasPageOutput()
	{
		$foo = new MenuPage(array('foo','bar','baz','pow'));
		return $foo->render();
		return "Let's use the <code>MenuPage</code> class to generate these links, instead.";
	}
	
	public function testEmail()
	{
		return $this->mail($this->getUser()->getEmail(),'Test Email','This is a test message from the OCDLA members website.')
			?
		"A test email was sent to <code>{$this->getUser()->getEmail()}</code>."
			:
		"Could not send mail to <code>{$this->getUser()->getEmail()}</code>.";
	}
	
	private function getLinks()
	{
		return array(
			'single-sign-on' => array(
				'url' => 'https://auth.ocdla.org/saml/www/index.php',
				'abs' => true,
				'title' => 'SAML Info',
				'desc' => 'Provides diagnostic information on the installed SAML server.',
				'target' => '_new',
			),
			'simpel-saml-documentation' => array(
				'url' => 'https://simplesamlphp.org/docs/stable/simplesamlphp-install',
				'abs' => true,
				'title' => 'SimpleSAML Documentation',
				'desc' => 'Provides documentation on the SimpleSAML, especially its use as a Service Provider for OCDLA.  See the following topics:<ul><li>https://simplesamlphp.org/docs/stable/saml:sp</li><li>https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote</li><li><a href="https://simplesamlphp.org/docs/stable/simplesamlphp-sp">SimpleSAMLphp Service Provider QuickStart</a></li></ul>',
				'target' => '_new',
			),
			
			'password-reset' => array(
				'url' => 'password-reset',
				'title' => 'Password Reset',
				'desc' => 'Members can reset their OCDLA password.'
			),
			'recent-downloads' => array(
				'url' => 'recent-downloads',
				'title' => 'Recent Downloads',
				'desc' => 'View recently purchased downloads, including PDFs and Zip files.'
			),
			'test-email' => array(
				'url' => 'test-email',
				'title' => 'Send Test Email',
				'desc' => 'Send a test email to <code>'.$this->getUser()->getEmail().'</code> (your email address.) This ensures the system can properly send email.'
			),
			'error-notification' => array(
				'url' => 'test-email-notification',
				'title' => 'Email notifications',
				'desc' => 'Send a test message to these administrators who should be notified of errors on the website: <br />'.implode('<br />',explode(',',NOTIFICATION_EMAIL))
			),
			'exception-handler' => array(
				'url' => 'test-exception',
				'title' => 'Exception Test',
				'desc' => 'Test the custom exception handler for this website.'
			),
			'documentation' => array(
				'url' => 'docs/index.html',
				'title' => 'Documentation',
				'desc' => 'View documentation for the OCDLA website code or read more about <a href="http://phpdoc.org/docs/latest/getting-started/your-first-set-of-documentation.html" target="_new">PHPDoc</a>.'
			),
			'sample-login' => array(
				'url' => 'https://auth.ocdla.org/sampleLogin.php',
				'abs' => true,
				'title' => 'Single Sign-On',
				'desc' => 'Sign in using single sign-on.',
				'target' => '_new',
			),
			'salesforce-ad' => array(
				'url' => 'https://www.ocdla.org/salesforce.shtml',
				'abs' => true,
				'title' => 'Salesforce login banner ad',
				'desc' => 'View the ad that SSO users will see.'
			),
			'directory-links' => array(
				'url' => 'directory-menu',
				'title' => 'Directory Links',
				'desc' => 'A menu of directory links'
			),
			'new-template' => array(
				'url' => 'new-template',
				'title' => 'New Template',
				'desc' => 'A file output page for OCDLA.'
			)
		);
	}

	private function linksToHtml()
	{
		$map = array_map(function($link){
			$path = $link['abs']?$link['url']:(\base_path().$link['url']);
			$target = $link['target']?"target={$link['target']}":'';
			return "<div class='admin-link'>
				<a href='{$path}' $target>{$link['title']}</a>
				<p class='admin-description'>{$link['desc']}</p>
			</div>";
		},$this->getLinks());
		return implode("\n",$map);
	}
	
	public function adminAreas()
	{
		return $this->linksToHtml();
	}
	
	public function testException()
	{
		throw new \Exception('This is an example of a test error message.');
	
	}
	
	public function testError()
	{
		trigger_error('*** This is a TEST error message. You\'re receiving this email because you are listed as a site administrator. ***',E_USER_WARNING);
		return "A test error notification has been sent to: <br />".implode('<br />',explode(',',NOTIFICATION_EMAIL));
	}

}