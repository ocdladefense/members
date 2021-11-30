<?php
// @description - display system status messages to the user
// @TODO - implement a site-wide js mechanism for "closeable" elements
// $message - the message to be displayed to the user
// $status - in 'status', 'warning', 'error' ( or other defined types )
// $classes - could be used to override default classes for this template
?>
<div class="alert-box <?php print $class ?>">
	<?php print $message ?>
	<?php if( $class == 'success' ): ?><!--<a href="#" class="close">&times;</a>--><?php endif; ?>
</div>