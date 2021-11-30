<?php
$classes = $index==0?'caption caption-active':'caption';
?>
<div class="<?php print $classes; ?>">
	<h4 class="caption-subtitle">
		<a title="Jump to this slide." href="javascript:" data-action="getSlide" data-index="<?php print $index; ?>">
			<?php print $caption; ?>
		</a>
	</h4>
	<div class="caption-text" data-action="getSlide" data-index="<?php print $index; ?>">
		<?php print $caption_text; ?>
	</div>
</div>
