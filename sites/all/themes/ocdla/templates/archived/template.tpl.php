<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
 xmlns:fb="http://ogp.me/ns/fb#"><!-- InstanceBegin template="/Templates/main-template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>OCDLA: Oregon Criminal Defense Lawyers Association</title>
<!-- InstanceBeginEditable name="Metatags" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="oregon criminal law,oregon criminal defense lawyer,oregon criminal defense attorney,oregon criminal defense,criminal defense lawyer,criminal defense attorney,attorney,lawyer,law directory,continuing legal education,library of defense" />
<meta name="Description" content="The Oregon Criminal Defense Lawyers Association serves the defense community through continuing legal education, public education, networking and legislative action." />
<?php print $headtag ?>
</head>

<body class="<?php print $classes; ?>" id="p7bod">
	
	

	
	
	<div id="wrapper">



	<?php print $top_include ?>

	
	<div id="column_wrapper"><!-- tag ends in this file -->
    
    
	
		<div id="left">
	


<?php print $menu ?>


			<p>	
	
						<!--[if lte IE 7]>
						<style>.p7PMMv08, .p7PMMv08 a, .p7PMMv08 ul {height:1%;}.p7PMMv08 li{float:left;clear:both;width:100%;}</style>
						<![endif]-->
						
						<!--[if IE 5.500]>
						<style>.p7PMMv08 {position: relative; z-index: 9999999;}</style>
						<![endif]-->
						
						<!--[if IE 5]>
						<style>.p7PMMv08 a, .p7PMMv08 ul {height: 1%; overflow: visible !important;}</style>
						<![endif]-->
	
			</p>


			<div class="content"><!-- InstanceBeginEditable name="SidebarLeft" -->
			<h3>&nbsp;</h3>
			<h3>&nbsp;</h3>
			<h3>&nbsp;</h3>

			<!-- InstanceEndEditable -->
			
			</div><!-- end content -->




		</div><!-- end left wrapper -->
	
		<div id="center">
			  <div class="content"><!-- InstanceBeginEditable name="MainContent" --> 
 



						<!--<div id="lasso_dynamic_content">-->
						<?php
						
						if( $submenu ) { print $submenu; }
						echo "<h3>$crumbtrail</h3>";//<p>&nbsp;</p>";
						echo $thismenu;
						if( $status ) { print $status; }
						echo "<div id=\"errormsg\" class=\"errormsg\" ></div>";
						print $content;
						?>
						<!--</div>-->

      <!-- InstanceEndEditable --></div><!-- end content -->
    </div><!-- end center -->
    

    
    
  
  </div><!-- end column-wrapper -->
  



<?php print $footer_include ?>

</div><!-- end body wrapper -->
</body>




<?php if( $scripts_footer ) print $scripts_footer ?>


<!-- InstanceEnd --></html>