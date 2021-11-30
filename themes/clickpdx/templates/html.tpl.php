<?php
	$version = isset($_GET['q'])?$_GET['q']:'';
	$resumeLink = l($version);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>My Resumé | José Bernal</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!--<meta
			name="description"
			content="web design, web development, ecommerce, programming in Portland, OR"	
		/>
		<meta
			name="keywords"
			content="web, design, programming, ecommerce, programming, Drupal, Magento, business, consulting, HTML, HTML5, CSS, Javascript"
		/>
		-->
		 <meta
			 name="viewport"
			 content="width=device-width;
							 initial-scale=1;
							 maximum-scale=1;
							 minimum-scale=1; 
							 user-scalable=no;"
			/>
		<!--[if lt IE 9]>
		<script type="text/javascript">
		(function(){
		var html5elmeents = "address|article|aside|audio|canvas|command|datalist|details|dialog|figure|figcaption|footer|header|hgroup|keygen|mark|meter|menu|nav|progress|ruby|section|time|video".split('|');
		for(var i = 0; i < html5elmeents.length; i++){
		document.createElement(html5elmeents[i]);
		}}
		)();
		</script>
		<![endif]-->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,500' rel='stylesheet' type='text/css' />
		<?php print $styles; ?>
	<?php if(isset($_GET['test'])): ?>
		<link rel="stylesheet" href="/sites/all/themes/clickpdx/css/style.css?pv" type="text/css" />
		<link rel="stylesheet" href="/sites/all/themes/clickpdx/css/duties-projects-toggle.css?pv" type="text/css" />
	<?php else: ?>
		<link rel="stylesheet" href="/sites/all/themes/clickpdx/css/style.min.css" type="text/css" />
	<?php endif; ?>
		<script src="/sites/all/libraries/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
		<?php print $scripts; ?>
	</head>
	<body class="">


		<?php /*print $page_top;*/ ?>
	
	
		<?php print $page; ?>
	
	
		<?php /*print $page_bottom;*/ ?>
	


		<footer>
			<div class="container">
				<p>
						<a href="http://jigsaw.w3.org/css-validator/check/referer">
							<img style="border:0;width:88px;height:31px"
								src="/sites/default/files/images/icons/vcss.gif"
								alt="Valid CSS!" />
						</a>
				</p>
				&copy; José Bernal<br />
				1040 NW 10 AVE<br />
				Portland, OR  97209<br />
				<a href="tel:541-228-8481">541.228.8481</a><br />
				<a href="mailto:jbernal.web.dev@gmail.com&amp;subject=Contact%20José%20Bernal">
					jbernal dot web dot dev at gmail dot com
				</a>
				<br />
			</div>
		</footer>
	
		<?php if ($scripts_footer) print $scripts_footer ?>
	
	</body>
</html>