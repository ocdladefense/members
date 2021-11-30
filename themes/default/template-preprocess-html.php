<?php
use Clickpdx\Core\Script;

function ocdla_default_preprocess_html()
{
	global $request;
		/** new format **/
		$jquery = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => '/includes/jquery.js' ) );

		$ajax_globals = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => '/sites/all/themes/ocdla/js/ajax_globals.js' ));
		
		$ocdla = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => '/sites/all/themes/ocdla/js/ocdla.js' ) );
		
		$jquery = new Script( array( 'type' => SCRIPT_EXTERNAL_FILE, 'path' => '/sites/all/libraries/jquery-1.8.3/jquery-1.8.3.js' ) );
		
		$js_menus = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => '/sites/all/libraries/jquery-ui-1.9.2/jquery-ui-1.9.2.js' ) );

		$inline_editing = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => clickpdx_get_path().'/scripts/inline-editing.js' ) );
		
		$ckeditor = new Script( array( 'type' => SCRIPT_EXTERNAL_FILE, 'path' => '/sites/all/modules/ckeditor/ckeditor.js' ) );

		
		if( drupal_get_path_alias() == 'download/zip' ) {
			$AjaxZipRequestUrl = "/sites/ocdla/modules/zip_download/js/ajax.php?productid=".$request->getRequestValue('productid');

			$ZipDownloadRequest = new Script( array( 'type' => SCRIPT_LOCAL_FILE, 'path' => $AjaxZipRequestUrl ) );

				
			$SetLinkTarget = new Script(
				array(
					'type' => SCRIPT_INLINE,
					'data' => 'var atags = document.getElementsByTagName("a"); for (i=0; i < atags.length; i++){ if (atags[i].getAttribute("href") && atags[i].getAttribute("rel") == "external") atags[i].target = "_blank"; }'
				)
			);
			
			drupal_add_js( $ZipDownloadRequest, THEME_SCRIPT_REGION_FOOTER );
			drupal_add_js( $SetLinkTarget, THEME_SCRIPT_REGION_FOOTER );
		}

		drupal_add_js( $jquery, THEME_SCRIPT_REGION_HEADER );
		drupal_add_js( $js_menus, THEME_SCRIPT_REGION_HEADER );
		drupal_add_js( $ajax_globals, THEME_SCRIPT_REGION_FOOTER );
		drupal_add_js( $ocdla, THEME_SCRIPT_REGION_FOOTER );		

		if( strpos( drupal_get_path_alias(),'edit')!==FALSE)
		{
			drupal_add_js( $ckeditor, THEME_SCRIPT_REGION_HEADER );
			drupal_add_js( $inline_editing, THEME_SCRIPT_REGION_HEADER );
		}

}