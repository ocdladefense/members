<?php

require(DRUPAL_ROOT.'/sites/all/themes/clickpdx/template-preprocess-html.php');

define('THIS_THEME',DRUPAL_ROOT .'/sites/all/themes/clickpdx');

use Clickpdx\Core\Script;

/**
 * Theme overrides.
 */
function clickpdx_preprocess_page(&$vars)
{
	$vars['messages'] = '';

	if($vars['statuses'])
	{
		foreach($vars['statuses'] AS $msg)
		{
			$classes = implode(' ',$msg['classes']);
			$messages = implode('<br />',$msg['msg']);
			$vars['messages'] .= "<div class='{$classes}'>{$messages}</div>";
		}
	}
	
	
	if(function_exists('clickpdx_set_message'))
	{
		if($message = clickpdx_set_message())
		{
			$vars['messages'] = theme('status-messages', $message);
		}	
	}

	if (strpos(drupal_get_path_alias(),'profile') !== false)
	{
		$vars['submenu'] = menu_submenu('profile');
	}

	if (strpos(drupaL_get_path_alias(), 'edit'))
	{
		$vars['theme_hook_suggestion'] = 'page--edit';
	}
	/**
	 * Page template.
	 *
	 * Set the page template file.  This is an alternate
	 * template file from page.tpl.php and will be used
	 * to render the that is to be used for rendering
	 */
	$vars['theme_hook_suggestion'] = 'page--resume';
	
	/**
	 * Printer-friendly template.
	 *
	 * Set the page template file for print-friendly versions
	 * of this page.  This template should provide additional
	 * formatting information and remove any unecessary elements
	 * from the page.
	 */
	if(is_printer_friendly())
	{
		$vars['theme_hook_suggestion'] = 'page--resume-print';
	}
	$vars['printUrl'] = base_path() .'/'.drupal_get_path_alias().'/print';
}


function is_printer_friendly()
{
	return strpos(drupal_get_path_alias(),'print')!==false;
}


function clickpdx_preprocess_html(&$vars)
{
	global $css, $scripts, $request, $user;
	
	clickpdx_default_preprocess_html();
	// $vars['head_title'] = "OCDLA: Oregon Criminal Defense Lawyers Association";
	
	// clear the arrays from any previous
	// pre-process functions that way
	// we can start with a clean slate
	// $css = array();

	$classes = array();
	
	drupal_add_css(array(
		'path'		=> "/sites/all/themes/clickpdx/css/style.css?pv",
		'media'		=> 'all',
		'weight'	=> 999,
	));


	if (is_printer_friendly())
	{
		$classes[] = 'print';
		$classes[] = 'default-printer';
		$classes[] = 'print-format-letter';
		$classes[] = 'print-format-letter-portrait';
		$file = base_path() . '/'.clickpdx_get_path().'/css/print.css?v=0.1';
		drupal_add_css(array(
			'path'		=> $file,
			'media'		=> 'all',
			'weight'	=> 999,
		));
	}
	
	if (!is_printer_friendly())
	{
		drupal_add_css(array(
			'path'		=> "/sites/all/themes/clickpdx/css/duties-projects-toggle.css?pv",
			'media'		=> 'all',
			'weight'	=> 999,
		));
	}

	if (strpos(drupal_get_path_alias(),'login')===0)
	{
		drupal_add_css(array(
			'path'		=> clickpdx_get_path().'/css/mobile.css?v=0.1',
			'media'		=> 'all'
		));
	}

	$vars['styles'] = clickpdx_get_css();
	$vars['classes'] = implode(' ',$classes);
	$vars['scripts_footer'] = 
		theme_javascripts(array_reverse($scripts[THEME_SCRIPT_REGION_FOOTER]));
	$vars['scripts'] = theme_javascripts(array_reverse($scripts[THEME_SCRIPT_REGION_HEADER]));
}