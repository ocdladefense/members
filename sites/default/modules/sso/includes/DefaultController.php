<?php


use Ocdla\Session as Session;
use Ocdla\Http\LodCookie as LodCookie;



class DefaultController extends \SalesforceController
{

	
	
	protected function getUserRequestedAction()
	{
		$request = $this->getRequest();
		return $request->get('action');
	}
	
	protected function getLoginRedirect()
	{
		$request = $this->getRequest();
		$redirect = $this->getLocation(BASE_URL,'/login');
		$redirect .= "?ref={$request->get('ref')}";
		$redirect .= "&server={$request->get('server')}";
		return $redirect;
	}
	
	protected function getLocation($server=null,$url=null)
	{
		$retURL = $this->getRequest()->get('retURL');
		if(!empty($retURL))
		{
			return 'https://'.BASE_URL.'/login1.php?retURL='.urlencode($this->getRequest()->get('retURL'));
		}
		$url = !empty($url) ? $url : $this->getRedirectUrl();
		$server = !empty($server) ? $server : $this->getRedirectServer();
		$protocol = $this->getRedirectProtocol();
		if(empty($server))
		{
			$server = REDIRECT_DEFAULT_SERVER;
		}
		return ($protocol.'://'.$server . $url);
	}
	
	protected function getRedirectServer()
	{
		$server = $this->getRequest()->get('server');
		if (!empty($server))
			$ret = $server;
		else
				$ret = REDIRECT_DEFAULT_SERVER;
		return $ret;
	}
	
	protected function getRedirectProtocol()
	{
		$server = $this->getRequest()->get('protocol');
		if (!empty($server))
			$ret = $server;
		else
				$ret = REDIRECT_DEFAULT_PROTOCOL;
		return $ret;
	}
	
	protected function getRedirectUrl()
	{
		$ref = $this->getRequest()->get('ref');
		if (!empty($ref))
			$ret = $ref;
		else 
			$ret = '/';
		return $ret;
	}
	/**
	 * Login Form
	 *
	 * Display the login form.  After loggin in we want the user
	 * to be redirected to their intended destination.
	 *
	 * We pass the $server and $ref values in the querystring
	 * and save them in the form to send the user along.
	 *
	 */
	public function indexAction()
	{
		// Set up a session
		$session 		= new Session($this);
		$_SESSION['auth'] = AUTH_SERVER_NAME;
		$request 		= $this->getRequest();
		$server 		= $this->getRedirectServer();
		$ref 				= $this->getRedirectUrl();
		$goto 			= $this->getLocation();
		$errors 		= '';

		/**
		 * Incomplete sessions.
		 *
		 * Display the login form again if this user has
		 * an incomplete session.  This is the case if the user
		 * successfully logged into the Ocdla website but for some
		 * reason could not login to the Library of Defense website.
		 *
		 * For incomplete session we give the user the login form so they can 
		 * re-enter their credentials and gain access to the LOD.
		 */
		if(!$session->hasIncompleteSession()&&
			$session->hasAuthenticatedSession())
		{
			return $this->redirect($goto);
		}
		
		// http://symfony.com/doc/current/book/templating.html
		$content = $this->render('OcdlaLoginBundle:Default:login.html.twig',array(
			'name' 		=> null,
			'errors' 	=> $errors,
			'ref'			=> $ref,
			'server'	=> $server)
		);
		return $content;
	}
	

	// Authenticate the user.
	public function processLoginAction()
	{
		$loginErrors 	= '';
		$request 			= $this->getRequest();
		$action 			= $request->get('submit');		
		$name 				= $request->get('UserName');
		$pass 				= $request->get('password');
		$server 			= $request->get('server');
		$ref 					= $request->get('ref');
		
		/**
		 * Instantiate session.
		 *
		 * Start a new session based on this controller's
		 * database backend.
		 */
		$session = new Session($this);
		
		
		
		// Prepare a redirect.
		// Upon successful login the user gets sent this way.
		$redirect = $this->getLocation();
		
		
		if($action=='No Thanks') return $this->redirect($redirect);
		

		// Also test whether this user has an LOD session.
		if($session->hasAuthenticatedSession())
		{
			return $this->redirect($redirect);
		}


		if($server == 'lodtest.ocdla.org')
		{
			$redirect .= '?lod=true';
		}

		try
		{

			/**
			 * Authenticate against an IdP.
			 *
			 * This is the primary authentication.
			 * First we try to authenticate against a master IdP.
			 * If we can then we try any secondary authentications to other services.
			 * Otherwise if primary authentication fails,
			 * we won't bother authenticating against any other
			 * services.
			 */
			if(true === sso_lod_login_submit($request, $session))
			{
				if($session->authenticate($name, $pass))
				{
					$session->setAppStatus('ocdla',true);
					return $this->redirect($redirect);
				}
			}
			$errors = "Your Library of Defense login failed.";
		}
		catch(\Exception $e)
		{
			$errors = $e->getMessage();
		}
		
		/**
		 * Display login errors.
		 *
		 * Show login errors or other login failures/messages
		 * so that the user knows if everything went well.
		 */
		return $this->render('OcdlaLoginBundle:Default:login.html.twig',array('name' => $name, 'errors'=>$errors, 'server' => $server,'ref' => $ref));
	} 
	
	
	/**
	 * Logout functions might be found in:
	 * /var/www/auth/core/vendor/ocdla/http/cookie
	 *
	 */
	public function logoutAmsAction()
	{
		$session = new Session($this);

		try
		{
			\LodLogout($session->getUserID());
		}
		catch (Exception $e)
		{
			mail('jbernal.web.dev@gmail.com','info@ocdla.org','SSO Error',$e->getMessage());
		}

		removeCookies(
			array(
				'UserID',
				'UserName',
				'Token',
				'session',
				'_session'
			),
			array('prefix'=>array(
				LOD_COOKIE_PREFIX,
				LODTEST_COOKIE_PREFIX
			))
		);
		
		removeCookies(
			array(
				'SimpleSaml',
				'SimpleSAMLAuthToken',
				'OCDLA_SessionId'
			)
		);
		
		\setcookie('OCDLA_SessionId', '', time()-3600, "/", ".ocdla.org");	
	
		\Ocdla\session_destroy();
		$redirect = $this->getLocation();
		return $this->redirect(SAML_URL);
	}

	function LodLogout($UserID)
	{
		$cookie = new \Ocdla\Http\LodCookie($UserID);
		$cookiefile = $cookie->getFilePath();
		$request_body = \formatRequestBody( array( 'action' => 'logout') );
		$lod_logout = \cinit( SSO_WIKI_API, $request_body, $cookiefile );

		// $lod_logout_response = \parseResponse( $lod_logout['response_body'] );
		// tail( 'sso logout response:'.print_r($lod_logout, TRUE) );

	}

	function removeCookies($cookieNames,$options=null)
	{
		if(is_array($options['prefix']))
		{
			foreach($options['prefix'] as $prefix)
			{
				removeCookie($cookieNames,$prefix);
			}
		}
		else
		{
			removeCookie($cookieNames);
		}
	}


	function removeCookie($cookieNames,$prefix=null)
	{
		if(is_array($cookieNames))
		{
			foreach($cookieNames as $cName)
			{
				$fullName = isset($prefix) ? $prefix.$cName : $cName;
				\setcookie($fullName, '', time()-3600, "/", ".ocdla.org");		
			}
		}
		else
		{
			$fullName = isset($prefix) ? $prefix.$cookieNames : $cookieNames;
			\setcookie($fullName, '', time()-3600, "/", ".ocdla.org");	
		}
	}

	
}