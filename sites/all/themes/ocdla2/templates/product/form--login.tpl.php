<?php
// @author- Jose Bernal @date - 12/23/2012
// $content - the content of this form including its rendered elements
?>
<form id="ocdla_login_form" method="post" action="/index.php?q=login">
	

	<?php print $content ?>
	<div>
		<input type="submit" value="Submit" />
	</div>

	<!--
	<div>
		<input type="hidden" placeholder="URL" id="url" value="" name="url" />
	</div>
	-->

<?php
//	tail( 'form.tpl.php' . print_r( $form, TRUE ));
?>


	<!-- How to build a spam-free contact form without captchas || http://nfriedly.com/techblog/2009/11/how-to-build-a-spam-free-contact-forms-without-captchas/ -->
</form>