<?php

require(DRUPAL_ROOT.'/sites/all/themes/ocdla/template-preprocess-html.php');

define('THIS_THEME',DRUPAL_ROOT .'/sites/all/themes/ocdla');

use Clickpdx\Core\Asset\Script;

/**
 * Theme overrides.
 */
function ocdla_preprocess_page(&$vars)
{
	
	// $vars['top_include'] = file_get_contents(THIS_THEME.'/templates/blocks/top-include.htm');
	$vars['top_include'] = theme('blocks/top-include');
	// <!--#include virtual="/includes/menu1-include.htm" -->
	$vars['menu'] = theme('blocks/menu1-include');
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
		$vars['submenu'] = menu_submenu('profile').'<p class="error" style="margin-top:8px;">Profile updates are temporarily disabled.  Member profile updates will resume in a few days.  If you have urgent updates that need to be applied to your profile, please <a href="mailto:info@ocdla.org?subject=OCDLA%20Profile%20Update">email OCDLA directly at info@ocdla.org</a>.  Thank you for your patience!</p>';
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

	clickpdx_add_css( array('path' => '/sites/all/libraries/jquery-ui-1.9.2/themes/base/jquery-ui.css?v=0.1','media'=>'all') );
	clickpdx_add_css( array('path' => '/sites/all/libraries/p7pmm/p7PMMv08.css?v=0.1', 'media' => 'all' ));
	
	clickpdx_add_css( array('path' => '/sites/all/themes/ocdla/css/layout.css?v=0.1','media'=>'all') );
	
	if( strpos(drupal_get_path_alias(), 'profile')!== false )
	{
		clickpdx_add_css( array('path' => '/sites/all/themes/ocdla/css/layout_2cols.css?v=0.1','media'=>'all') );
	}
	
	clickpdx_add_css( array('path' => '/sites/all/themes/ocdla/css/style.css?v=0.1', 'media' => 'all' ));

	if( strpos(drupal_get_path_alias(), 'edit')!== false )
	{
		//$vars['theme_hook_suggestion'] = 'html--5';
	}

	if( strpos(drupal_get_path_alias(), 'login') ===0 ) {
		clickpdx_add_css( array('path' => clickpdx_get_path().'/css/mobile.css?v=0.1','media'=>'all') );
	}

		
	$vars['styles'] = theme_stylesheets($css);
	$vars['classes'] = '';
		

	if( !in_array(drupal_get_path_alias(), array('logout','ocdla/cart/add')))
	{
		ocdla_default_preprocess_html();		
	}
	
	if(path_starts_with('profile'))
	{
		profile_preprocess_html();
	}
	$vars['scripts_footer'] = theme_javascripts( array_reverse($scripts[THEME_SCRIPT_REGION_FOOTER]) );
	$vars['scripts'] = theme_javascripts( array_reverse($scripts[THEME_SCRIPT_REGION_HEADER]) );
}