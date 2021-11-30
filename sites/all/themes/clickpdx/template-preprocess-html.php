<?php
use Clickpdx\Core\Script;

function clickpdx_default_preprocess_html()
{
	global $request;
	$jquery = new Script(array('type'=>SCRIPT_LOCAL_FILE,'path'=>base_path().'/sites/all/libraries/jquery/jquery-1.11.1.min.js'));

	/*
		$ajax_globals=newScript(array('type'=>SCRIPT_LOCAL_FILE,
			'path'=>base_path().'/sites/all/themes/ocdla/js/ajax_globals.js'));
		
		$ocdla=newScript(array('type'=>SCRIPT_LOCAL_FILE,
			'path'=>base_path().'/sites/all/themes/ocdla/js/ocdla.js'));
		
		$jquery=newScript(array('type'=>SCRIPT_EXTERNAL_FILE,
			'path'=>base_path().'/sites/all/libraries/jquery-1.8.3/jquery-1.8.3.js'));
	*/
				
		$SetLinkTarget = new Script(
			array(
				'type' => SCRIPT_INLINE,
				'data' => 'var atags = document.getElementsByTagName("a"); for (i=0; i < atags.length; i++){ if (atags[i].getAttribute("href") && atags[i].getAttribute("rel") == "external") atags[i].target = "_blank"; }'
			)
		);
		
		
		drupal_add_js($SetLinkTarget, THEME_SCRIPT_REGION_FOOTER);
		drupal_add_js($jquery, THEME_SCRIPT_REGION_HEADER);
		// drupal_add_js( $js_menus, THEME_SCRIPT_REGION_HEADER );
		// drupal_add_js( $ajax_globals, THEME_SCRIPT_REGION_FOOTER );
		// drupal_add_js( $ocdla, THEME_SCRIPT_REGION_FOOTER );		
}