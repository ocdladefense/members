<?php
/**
 * page-breaks - 
 * 	classes that should be appended to classes so as to add page breaks for 
 * this list item
 */
?>
<?php if($project=="dte"): ?>
			<div class="page-break">&nbsp;</div>
<?php endif; ?>

<div class="project auto-page-break" data-id="<?php print $project; ?>" id="<?php print $project; ?>">
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

		<div style="clear:both;">&nbsp;</div>
		<?php if (isset($duties) && count($duties)): ?>
			<span id="toggle-duties-<?php print $project ?>" data-toggle="duties-<?php print $project ?>" class="toggle toggle-active">Responsibilities</span>
		<?php endif; ?>
		<?php if (isset($projects) && count($projects)): ?>
			<span id="toggle-projects-<?php print $project ?>" data-toggle="projects-<?php print $project ?>" class="toggle">Major Projects</span>
		<?php endif; ?>
		
		<div class="project-content">
			<div class="content-container">
				<ul id="duties-<?php print $project ?>" class="content-box content-box-default content-box-visible">
				<?php foreach($duties as $duty): ?>
					<li class="resume-detail">
						<div class="project-item-heading">
							<?php print $duty['title']; ?>					
						</div>
						<?php print $duty['duty']; ?>
					</li>
				<?php endforeach; ?>
				</ul>
				<ul id="projects-<?php print $project ?>" class="content-box content-box-inserted content-box-invisible">
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
		</div>
		
	</div>
</div>