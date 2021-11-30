<?php
// @author- Jose Bernal @date - 12/23/2012
// $content - the content of this form including its rendered elements
global $request;
$action = $_SERVER['PHP_SELF'] ."?q=" . $request->getRequestUri();
?>
<form id="<?php print $form_id ?>" method="post" action="<?php print $action  ?>">
	

	<?php print $content ?>

<?php// tail( 'form.tpl.php' . print_r( $form, TRUE ));
?>


	<!-- How to build a spam-free contact form without captchas || http://nfriedly.com/techblog/2009/11/how-to-build-a-spam-free-contact-forms-without-captchas/ -->


	<input type="submit" value="Submit" />
</form>