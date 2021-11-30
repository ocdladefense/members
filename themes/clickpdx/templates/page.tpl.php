	<div id="page-wrapper">
		<div id="stage">
		</div>
		<header>
			<nav>
				<h1 class="banner-item vtrim">José Bernal</h1>
				<h2 class="banner-item vtrim" style="clear:left;">Application Developer</h2>
				<span class="updated">
					Last updated: <?php print $lastUpdated ?>
				</span>
			</nav>
		</header>

		<div class="content-wrapper">
		
			<?php if ($breadcrumb) print $breadcrumb; ?>
			<?php if ($messages): ?>
				<div class='msg'>
					<?php print $messages; ?>				
				</div>			
			<?php endif; ?>
		
			<section id="title">
				<h2>José Bernal</h2>
				<h3>Resumé</h3>
				<div class="contact-info-header">
					1040 NW 10 AVE 219<br />
					Portland, OR 97209<br />
					<a href="mailto:jbernal.web.dev@gmail.com">jbernal.web.dev@gmail.com</a>
				</div>
				<div id="alternate-version">
					This document is available online at <a href="<?php print $resumeLink ?>">http://clickpdx.com</a>.
				</div>
			</section>
			
			<section id="about">
				<h3>About my work</h3>
				<p>My competencies are in systems and data integration.  I create applications that bridge the gap between different servers and programs. Making data available between otherwise incompatible applications enables organizations to put that data to good use.
				</p>
			</section>

			<section id="positions">
				<h3 class="title">Professional Experience</h3>
				<ul>
					<?php
						// if ($content) print $content;
						if ($page['content']) print $page['content'];
					?>
				</ul>
			</section>


			<div class="page-break">&nbsp;</div>
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
						<li>Facebook Graph API</li>
						<li>Twitter REST API</li>
						<li>Git</li>
					</ul>
			</section>

			<section id="frameworks">
				<h3 class="title">Frameworks</h3>
				<ul class="framework-list">
					<li>Drupal 6, 7, 8</li>
					<li>Symfony2</li>
					<li>Magento</li>
					<li>Salesforce</li>
				</ul>
			</section>
		
		
			<section id="education">
				<h3 class="title">Education</h3>
					<p><span class="education-label">Computer Science:</span><br />
					1 year of CIS coursework at Lane Community College (Eugene, OR) and the University of Oregon.</p>
					<p><span class="education-label">Relevant Subjects:</span><br />
						Java programming, conceptual study of abstraction, encapsulation and systems.</p>
				<h3 class="title">Academic Interests</h3>
					<ul>
						<li>Languages: Italian & Latin.</li>
						<li>Philosophy: Existentialism & Semiotics.</li>
					</ul>
			</section>

			<div class="page-break">&nbsp;</div>
			
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



		</div><!-- end .content-wrapper -->