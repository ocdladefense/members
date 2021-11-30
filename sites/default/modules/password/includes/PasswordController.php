<?php

use Clickpdx\Core\Controller\ControllerBase;
use Ocdla\Member;
use Ocdla\PasswordResetAction;

class PasswordController extends ControllerBase
{
	const PASSWORD_PASSES_VALIDATION = true;
	
	private static $resetUrl = 'password-reset';
	
	private $member;
	
	private $secureToken;
	
	private function getReminderMailMessage($token)
	{
		return implode("\n",array(
			"You recently requested a password reset for ocdla.org.",
			"",
			"If you didn't request a password reset you can safely ignore this message.",
			"",
			"Otherwise, to complete your password reset, click the link below or copy it directly into your browser's address bar:",
			"",
			$this->getPasswordResetLink($token)
		));
	}
	
	private function getPasswordResetLink($token,$type='text')
	{
		return $type==='text'?
			$this->createUrl(self::$resetUrl .'/'.$token):
			"<a href='{self::$resetUrl}/{$this->secureToken}'>here</a>";
	}
	
	private function getReminderMailSubject()
	{
		return "Password reminder for ocdla.org";
	}
	
	private function sendResetEmail($token)
	{
		return $this->mail($this->member->getUserEmail(), $this->getReminderMailSubject($token),
			$this->getReminderMailMessage($token));
	}
	
	private function getResetToken($username)
	{
		$resetRequest = new PasswordResetAction();
		$resetRequest->setUsername($username);
		$resetRequest->invalidateAll();
		return $resetRequest->createResetEntry();
	}
	
	private function processPasswordResetEmail($username,$token)
	{
		$this->member = Member::newFromUsername($username);
		if($this->sendResetEmail($token))
		{
			return $this->sentSuccess();
		}
		else return $this->sentFailed();
	}
	/**
	 * Show a success message
	 *
	 * We show the success message once the password has been reset.
	 */
	public function passwordResetSuccess()
	{
		return "Your password was successfully reset.  Please <a href='https://auth.ocdla.org/login'>login</a>";
	}
	
	
	/**
	 * Send password reset email.
	 *
	 * Begin the password reset process by sending a password reset email to
	 * this user.  Once initiated, the password reset link should redirect the user
	 * to another URL where they can enter a new password.
	 * 
	 * @return string 		A string of text/html showing either the form for initiating
	 * the email or a success or error message related to whether the reset email
	 * could be sent.
	 */
	public function requestReset()
	{
		header('Location: '.setting('system.amsUrl'));
		try
		{
			if($this->request->isPost())
			{
				if(empty($username = $this->request->getRequestValue('username')))
				{
					throw new \Exception("The username cannot be empty.");
				}
				$token = $this->getResetToken($username);
				return $this->processPasswordResetEmail($username,$token);
			}
		}
		catch(\Exception $e)
		{
			$errors = $e->getMessage();
		}
		// $this->member = new Member($this->user->getMemberId());
		return (!empty($errors)?'<p class="error">'.$errors.'</p>':'') . $this->resetInitForm();
	}
	
	public function resetPassword($token)
	{
		$args = func_get_args();
		$token = array_pop($args);
		/**
		 * For either POST or GET request we need to validate the token.
		 * If the token isn't valid, then we should bail out
		 * and return a generic error message.
		 */
		$this->resetAction = PasswordResetAction::newFromToken($token);
		if(!$this->resetAction->hasValidToken())
		{
			return '<p class="error">This token is expired.</p>';
		}
		try
		{
			if($this->request->isPost())
			{
				$this->validatePassword(
					$this->request->getRequestValue('password'),
					$this->request->getRequestValue('password-again')
				);
				$this->resetAction
					->resetPasswordAllDomains($this->request->getRequestValue('password'));
					
				// Invalidate this reset token:
				$this->resetAction->invalidate();
				
				// Redirect to the happy page
				$this->redirect('password-is-reset');
			}
		}
		catch(\Exception $e)
		{
			$errors = $e->getMessage();
		}
		return (!empty($errors)?'<p class="error">'.$errors.'</p>':'') . $this->resetPasswordForm();
	}
	

	
	private function validatePassword($pass1,$pass2)
	{
		if(!$this->doPasswordsMatch($pass1,$pass2))
			throw new \Exception("Your password didn't validate.");
		if($this->isPasswordEmpty($pass1))
			throw new \Exception("Your password cannot be empty.");
		return self::PASSWORD_PASSES_VALIDATION;
	}
	
	private function doPasswordsMatch($pass1,$pass2)
	{
		return $pass1===$pass2;
	}
	
	private function isPasswordEmpty($pass1)
	{
		return empty($pass1);
	}
	
	private function resetInitForm()
	{
		$page = "<p>Enter your OCDLA username. When you submit this form a password reset link will be sent to the email address you have on file with OCDLA.</p>";
		return $page."<form method='post'><div><input size='40' style='font-size:12pt; margin-bottom:6px; font-size:12pt; padding:4px;' id='username' name='username' type='input' placeholder='Enter your OCDLA username.' value='' /></div><div><input style='font-size:12pt; border:1px solid #ccc;' type='submit' value='Send reminder' /></div></form>";
	}
	
	private function resetPasswordForm()
	{
		$page = "<p>Enter your new password.</p>";
		return $page."<form method='post'>
			<div>
				<label for='password'>Enter a password</label>
				<input size='40' style='font-size:12pt; margin-bottom:6px; font-size:12pt; padding:4px;' id='password' name='password' type='password' placeholder='Enter your new password.' value='' />
			</div>
			<div>
				<label for='password-again'>Enter a password</label>
				<input size='40' style='font-size:12pt; margin-bottom:6px; font-size:12pt; padding:4px;' id='password-again' name='password-again' type='password' placeholder='Re-enter the password' value='' />
			</div>
			<div>
				<input style='font-size:12pt; border:1px solid #ccc;' type='submit' value='Submit' />
			</div>
		</form>";
	}

	private function sentFailed()
	{
		return "<h3>There was an error.</h3><p>We were unable to send a reminder to your email address.  Please <a href='mailto: info@ocdla.org'>contact OCDLA</a> for more information.</p>";
	}
	
	private function sentSuccess()
	{
		return "<h4>Your reset link was sent!</h4><p>A password reset link was sent to the email address you have on file.  If you don't see the email within 10 minutes, please check your spam box.</p>";
	}
}