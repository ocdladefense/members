<?php

?>
<?php if($project=="dte"): ?>
			<div class="page-break">&nbsp;</div>
<?php endif; ?>

<li class="project auto-page-break" data-id="<?php print $project; ?>" id="<?php print $project; ?>">
	<div class="project-info-wrapper">
	
		<span class="project-title">
			<?php print $position; ?>
			<span class='dates'>
				<!--<span class='label'>Dates:</span> --><?php print $dates; ?>
			</span>
		</span>
		
		<div class="position-body">
			<span class='org'>
				<!--<span class="label">Organization:</span>-->
				<?php print $org; ?>
			</span>
			<span class="website">
				<!--<span class="label">Website:</span>-->
				<a class="jump external" href="<?php print $url; ?>">
					<?php print $url; ?>
					<img alt="Open in new window." src="/sites/default/files/images/icons/open-new-win.png" />
				</a>
			</span>
			<br />		
		</div>

		<?php if(isset($duties) && count($duties)): ?>
			<h3 class="project-heading">Responsibilities</h3>
			<ul>
			<?php foreach($duties as $duty): ?>
				<li class="resume-detail">
					<?php print $duty['duty']; ?>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		
		<h3 class="project-heading">Major Projects</h3>
		<ul>
		<?php
			if(isset($projects) && count($projects))
			{
				foreach($projects as $p): ?>
					<li class="resume-detail">
						<span class="project-item-heading no-page-break-after">
							<?php print $p['title']; ?>
						</span>
						<br />
						<?php print $p['desc']; ?>
					</li>
				<?php endforeach;
			}
		?>
		</ul>
		
	</div>
</li>