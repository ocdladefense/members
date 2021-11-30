<?php

require(DRUPAL_ROOT.'/sites/all/themes/ocdla/template-preprocess-html.php');

define('THIS_THEME',DRUPAL_ROOT .'/sites/all/themes/ocdla');

use Clickpdx\Core\Script;

/**
 * Theme overrides.
 */
function ocdla_preprocess_page(&$vars)
{
	
	$vars['top_include'] = file_get_contents(THIS_THEME.'/templates/blocks/top-include.htm');
	// <!--#include virtual="/includes/menu1-include.htm" -->
	$vars['menu'] = file_get_contents(THIS_THEME.'/templates/blocks/menu1-include.htm');
	// $vars['footer_include'] = file_get_contents(INCLUDE_DIR.'/footer-include.htm');
	$vars['footer_include'] = <<<EOF
<div id="footer">
<div class="content">OCDLA, 101 East 14th, Eugene, OR, 97401
	  - <a href="tel:541.686.8716">541.686.8716</a> - <a style="color:#fff; font-weight:bold;" href="mailto:info@ocdla.org">info@ocdla.org</a>
	</div>
</div>
EOF;
	$vars['messages'] = '';

	if($vars['statuses'])
	{
		foreach($vars['statuses'] AS $msg)
		{
			$classes = implode(' ',$msg['classes']);
			$messages = implode('<br />',$msg['msg']);
			$vars['messages'] .= "<div class=\"{$classes}\">{$messages}</div>";
		}
	}
	
	
	if( function_exists('clickpdx_set_message') )
	{
		if( $message = clickpdx_set_message() )
		{
			$vars['messages'] = theme( 'status-messages', $message );
			// tail( $vars['messages'] );
		}	
	}

	if( strpos(drupal_get_path_alias(),'profile') !== false )
	{
		$vars['submenu'] = menu_submenu('profile');
	}

	if( strpos(drupaL_get_path_alias(), 'edit') )
	{
		$vars['theme_hook_suggestion'] = 'page--edit';
	}

}


function ocdla_preprocess_form( &$vars )
{
	$vars['theme_hook_suggestion'] = 'form';
	if( $vars['form_id'] == 'ocdla_login_sso_form' )
	{
		$vars['theme_hook_suggestion'] = 'form--login';	
	}
	if(in_array($vars['form_id'],array('global_contact_form' )))
	{
		$vars['theme_hook_suggestion'] = 'form--contact';
	}
}




function ocdla_preprocess_html(&$vars)
{
	global $css, $scripts, $request, $user;
	
	// $vars['head_title'] = "OCDLA: Oregon Criminal Defense Lawyers Association";
	
	// clear the arrays from any previous
	// pre-process functions that way
	// we can start with a clean slate
	$css = array();

	drupal_add_css( array('path' => '/sites/all/libraries/jquery-ui-1.9.2/themes/base/jquery-ui.css?v=0.1','media'=>'all') );
	drupal_add_css( array('path' => '/sites/all/libraries/p7pmm/p7PMMv08.css?v=0.1', 'media' => 'all' ));
	
	drupal_add_css( array('path' => '/sites/all/themes/ocdla/css/layout.css?v=0.1','media'=>'all') );
	
	if( strpos(drupal_get_path_alias(), 'profile')!== false )
	{
		drupal_add_css( array('path' => '/sites/all/themes/ocdla/css/layout_2cols.css?v=0.1','media'=>'all') );
	}
	
	drupal_add_css( array('path' => '/sites/all/themes/ocdla/css/style.css?v=0.1', 'media' => 'all' ));

	if( strpos(drupal_get_path_alias(), 'edit')!== false )
	{
		//$vars['theme_hook_suggestion'] = 'html--5';
	}

	if( strpos(drupal_get_path_alias(), 'login') ===0 ) {
		drupal_add_css( array('path' => clickpdx_get_path().'/css/mobile.css?v=0.1','media'=>'all') );
	}


	if( strpos(drupal_get_path_alias(), 'ocdla/login') ===0 )
	{
		$scripts['file'] = array();

		drupal_add_js( array('path'=>'/sites/all/libraries/jquery-ui-1.9.2/jquery-ui-1.9.2.js') );
		drupal_add_js( array('path'=>'/sites/all/themes/ocdla/js/ocdla.js') );
		drupal_add_js( array('path'=>'/sites/all/themes/ocdla/js/ajax_globals.js') );
		drupal_add_js( array('path'=>'/sites/all/libraries/jquery-1.8.3/jquery-1.8.3.js') );
		
		// Create an array of javascipts.
		$vars['scripts'] = "";
		foreach( $scripts['file'] AS $script )
		{
			$path = strpos($script['path'],'http')!==FALSE ? $script['path'] : $script['path'];
			$vars['scripts'] .= "\n<script src='{$path}' type='text/javascript'></script>";
		}		
	}

		
	$vars['styles'] = "";
	
	foreach($css as $style)
	{
		$path = $style['path'];
		if( $style['type']=='inline' ) { $vars['styles'] .= $style['data']; continue; }
		$vars['styles'] .= "\n<link rel=\"stylesheet\" href=\"{$path}\" media=\"{$style['media']}\" type=\"text/css\" />";
	}

	$vars['classes'] = '';
		

	if( in_array(drupal_get_path_alias(), array('logout','ocdla/cart/add'))) {
	
	} else {
		ocdla_default_preprocess_html();		
	}
	if(path_starts_with('profile')){
		profile_preprocess_html();
	}
	$vars['scripts_footer'] = theme_javascripts( array_reverse($scripts[THEME_SCRIPT_REGION_FOOTER]) );
	$vars['scripts'] = theme_javascripts( array_reverse($scripts[THEME_SCRIPT_REGION_HEADER]) );
}