<?php
?>
<li class="project" data-id="<?php print $project; ?>" id="<?php print $project; ?>">
	<div class="project-info-wrapper">
		<!--<span class='label'>Position:</span>-->
		<span class="project-title">
			<?php print $position; ?>
		</span>
		<input data-action="stage" data-project-id="<?php print $project; ?>" id="button-<?php print $project; ?>" type="button" value="view" />
		<div class="position-body">
			<span class='org'>
				<!--<span class="label">Organization:</span>-->
				<?php print $org; ?>
			</span>
			<br />
			<span class='label'>Dates:</span> <?php print $dates; ?>
			<br />
			<span class="website">
				<span class="label">Website:</span>
				<a class="jump external" href="<?php print $url; ?>">
					<?php print $url; ?>
					<img alt="Open in new window." src="/sites/default/files/images/icons/open-new-win.png" />
				</a>
			</span>
		</div>
	</div>
	<div class="stage closed not-loaded" id='<?php print $project; ?>-stage'>
		<img alt="Loading..." class="loading" src="images/loading.gif" />
		<div class="stage-content" id="<?php print $project; ?>-stage-content"><p>&nbsp;</p></div>
	</div>
</li>