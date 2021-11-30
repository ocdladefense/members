<?php

call_user_func(function()
{
	global $user;
	if(isset($_POST["ocdla_id"]))
	{
		$classDir = DRUPAL_ROOT .'/sites/default/modules/profile/classes';
		$form_class = "Form_" . $_POST["ocdla_id"];
		require("$classDir/FormProcessor.php");
		require("$classDir/{$form_class}.php");

		// Should I throw an Exception if ocdla_id isn't present?
		try
		{
			$form = new $form_class( array("user_id"=>$user->getMemberId()) );
			$form->exec();
			$status = 'Your profile was successfully updated.';
		}
		catch(Exception $e)
		{
			$status = $e->getMessage();
		}
	}
});