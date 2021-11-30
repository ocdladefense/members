<?php

?>
	<div id="page-wrapper">
		<div id="stage">
		</div>
		<header>
			<nav>
				<h1 class="banner-item vtrim">José Bernal</h1>
				<h2 class="banner-item vtrim" style="clear:left;">Resumé</h2>
				<span class="updated">
					Last updated: Sept 10, 2015
				</span>
			</nav>
		</header>

		<section id="about">
			<h3>About my work</h3>
			<p>My competencies are in systems and data integration.  I create programs that make data available between different servers and applications. Part of the challenge is that these applications are often incompatible.
			</p>
			<p>The organizations I've done work for rely on their data to grow sales and members. These clients continue to use the websites I originally built for them.</p>
		</section>

		<section id="positions">
			<h3 class="title">Positions</h3>
			<?php print theme(APP_ROOT.'/resume-detail.tpl.php',$resumeItems('ocdla')); ?>
			<ul>
				<?php
				foreach($positions as $project=>$item)
				{
					$vars=$item;
					$vars['project']=$project;
					print theme(APP_ROOT.'/resume-item.tpl.php',$vars);
				}
				?>
			</ul>
		</section>



		<section id="programming-languages">
			<h3 class="title">Programming Languages & Proficiencies</h3>
				<ul class="language-list">
					<li>C#</li>
					<li>PHP</li>
					<li>JavaScript</li>
					<li>Java</li>
					<li>Bash (shell scripting)</li>
				</ul>
				<ul class="language-list">
					<li>Apache2</li>
					<li>MySQL</li>
					<li>Amazon EC2</li>
					<li>HTML5</li>
					<li>XML</li>

				</ul>
				<ul class="language-list">
					<li>JSON</li>
					<li>CSS</li>
					<li>jQuery</li>
					<li>Backbone.js</li>
					<li>Underscore.js</li>
				</ul>
				<ul class="language-list">
					<li>Google Maps API</li>
					<li>Git and post-deploy workflows</li>
				</ul>
		</section>

		<section id="frameworks">
			<h3 class="title">Frameworks</h3>
			<ul class="framework-list">
				<li>Drupal 6, 7, 8</li>
				<li>Symfony2</li>
				<li>Magento</li>
				<li>WordPress</li>
			</ul>
		</section>
		
		
		<section id="education">
			<h3 class="title">Education</h3>
			<ul class="education-list">
				<li>Computer Science<br />
				2 years of CS coursework at Lane Community College (Eugene, OR) and the University of Oregon:<br />
				Java Programming, conceptual study of abstraction, encapsulation and systems.
				</li>
				<li>Academic interests:<br />
				Semiotics, execution contents (I need to further explain these...)
				</li>
			</ul>
		</section>

		
		<section id="references">
			<h3 class="title">References</h3>
			<ul class="reference-list">
				<li>
					John Potter, Executive Director<br />
					Oregon Criminal Defense Lawyers Association<br />
					Phone: <a href="tel:541-686-8716">541.686.8716</a><br />
					Email: <a href="mailto:jrpotter@ocdla.org">jrpotter@ocdla.org</a>
				</li>
				<li>
					Zeph Van Allen, President<br />
					Down To Earth Distributors, Inc.<br />
					Phone: <a href="tel:541-485-5932">541.485.5932</a><br />
					Email: <a href="mailto:zeph@downtoearthdistributors.com">zeph@downtoearthdistributors.com</a>
				</li>
				<li>
					Dan Ohlsen, Web Developer<br />
					Sockeye<br />
					Phone: <a href="tel:503-933-3202">503.933.3202</a><br />
					Email: <a href="mailto:dan@danohlsen.com">dan@danohlsen.com</a>
				</li>
			</ul>
		</section>

		<aside>
			<!--<img width="600" src="images/project-mngmt.png" />-->
		</aside>

	</div>