<?php
use Clickpdx\Core\Asset\Script;

function ocdla2_default_preprocess_html()
{
	global $request;
	
	
	global $scripts;

		
	clickpdx_add_js(
	 '/sites/all/libraries/jquery-1.8.3/jquery-1.8.3.js',
	 // '/sites/all/libraries/jquery-ui-1.9.2/jquery-ui-1.9.2.js',
	 '/sites/all/libraries/jquery-ui-1.12.1/jquery-ui.js',
	 '/sites/all/themes/ocdla2/js/responsive-nav.js'
	 // clickpdx_get_path().'/scripts/inline-editing.js'
	 // '/sites/all/modules/ckeditor/ckeditor.js'
	);
	

	//	print "<pre>".print_r($scripts,true)."</pre>";exit;
		
	$alwaysUseMobile = setting('theme.ismobile');
		

	
	if($alwaysUseMobile||isMobileRequest())
	{
		$script = 'var is_mobile=true;var nav = responsiveNav("#menu",{label:""});';
	}
	else
	{
		$script = 'var is_mobile=false;';	
	}
	
		$appSettings = new Script(
			array(
				'type' => SCRIPT_INLINE,
				'data' => ";var appSettings = { isDev: true };",
			)
		);
	clickpdx_add_js( $appSettings, THEME_SCRIPT_REGION_HEADER );
	
	$menu = new Script(
		array(
			'type' => SCRIPT_INLINE,
			'data' => $script
		)
	);
	clickpdx_add_js( $menu, THEME_SCRIPT_REGION_FOOTER );

	clickpdx_add_js(
	 '/sites/all/themes/ocdla2/js/ajax_globals.js',
	 '/sites/all/themes/ocdla2/js/ocdla.js',
	 THEME_SCRIPT_REGION_FOOTER
	);
	
	if (drupal_get_path_alias() == 'download/zip')
	{
		$AjaxZipRequestUrl = "/sites/ocdla/modules/zip_download/js/ajax.php?productid=".$request->getRequestValue('productid');

		$ZipDownloadRequest = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => $AjaxZipRequestUrl ) );
			
		$SetLinkTarget = new Script(
			array(
				'type' => SCRIPT_INLINE,
				'data' => 'var atags = document.getElementsByTagName("a"); for (i=0; i < atags.length; i++){ if (atags[i].getAttribute("href") && atags[i].getAttribute("rel") == "external") atags[i].target = "_blank"; }'
			)
		);
		
		clickpdx_add_js( $ZipDownloadRequest, THEME_SCRIPT_REGION_FOOTER );
		clickpdx_add_js( $SetLinkTarget, THEME_SCRIPT_REGION_FOOTER );
	}

}