<?php

require(DRUPAL_ROOT.'/sites/all/themes/ocdla2/template-preprocess-html.php');

define('THIS_THEME',DRUPAL_ROOT .'/sites/all/themes/ocdla2');

use Clickpdx\Core\Asset\Script;
use Clickpdx\Core\Asset\Css;


function ocdla2_preprocess_html(&$vars)
{
	global $css, $scripts, $request, $user;

/*
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></
  */

	clickpdx_add_css(
		// '/sites/all/libraries/jquery-ui-1.9.2/themes/base/jquery-ui.css?v=0.1',
		
		'/sites/all/libraries/jquery-ui-themes-1.12.1/themes/base/jquery-ui.css',
		
		'/sites/all/libraries/p7pmm/p7PMMv08.css?v=0.2',
	
		'/sites/all/themes/ocdla2/css/layout.css?v=0.2',
	
		'/sites/all/themes/ocdla2/css/style.css?v=0.2',
		
		'/sites/all/themes/ocdla2/css/menu.css',
		
		'/sites/all/themes/ocdla2/css/messages.css',
		
		'/sites/all/themes/ocdla2/css/cart.css',
		
		'/sites/all/themes/ocdla2/css/jobs.css',
		
		'/sites/all/themes/ocdla2/css/responsive-nav.css'
	);
	

	
	/*
	if( strpos(drupal_get_path_alias(), 'profile')!== false )
	{
		drupal_add_css( array('path' => '/sites/all/themes/ocdla2/css/layout_2cols.css?v=0.1','media'=>'all') );
	}
	*/

	if(setting('theme.ismobile')||isMobileRequest() ) {
		clickpdx_add_css(array(
			'path' => '/sites/all/themes/ocdla2/css/mobile.css?v=0.3',
			'media'=>'all'
		));
	}
	
	if(isset($_GET['debug']))
	{
		clickpdx_add_css(array(
			'path' => '/sites/all/themes/ocdla2/css/drawer.css?v=0.3',
			'media'=>'all'
		));
	}

	$vars['styles'] = theme_stylesheets($css);
	$vars['classes'] = '';
	
	if(!in_array(drupal_get_path_alias(), array('logout','ocdla/cart/add')))
	{
		ocdla2_default_preprocess_html();			
	}


	$vars['scripts_footer'] = theme_javascripts(array_reverse($scripts[THEME_SCRIPT_REGION_FOOTER]));
	
	$vars['scripts'] = theme_javascripts(array_reverse($scripts[THEME_SCRIPT_REGION_HEADER]));
}

/**
 * Theme overrides.
 */
function ocdla2_preprocess_page(&$vars)
{

	
		if(strpos(drupal_get_path_alias(),'directory')===0){
			$vars['breadcrumbs'] = array(
				'Home'										=> 'https://www.ocdla.org',
				'Membership Directory Browse/Search'		=> '/directory'
			);
			}
		if(strpos(drupal_get_path_alias(),'directory/expert-witness')===0){
			$vars['breadcrumbs'] = array(
				'Home'										=> 'https://www.ocdla.org',
				'Expert Witness Search'		=> '/directory/expert-witness/search'
			);
		}
	

	
	if(setting('theme.ismobile')||isMobileRequest())
	{

		$vars['theme_hook_suggestion'] = 'page-mobile';
	}
	
	if(isset($_GET['debug']))
	{
	
		$vars['theme_hook_suggestion'] = 'page-drawer';

	}
	
	$vars['top_include'] = file_get_contents(DRUPAL_ROOT.'/sites/all/themes/ocdla2/templates/blocks/top-include.htm');

	$vars['menu'] = $foo = file_get_contents(DRUPAL_ROOT.'/sites/all/themes/ocdla2/templates/blocks/menu.htm');
	
	$vars['menu_left'] = $foo = file_get_contents(DRUPAL_ROOT.'/sites/all/themes/ocdla2/templates/blocks/menu_left.htm');
	
	$vars['twitter'] = file_get_contents(DRUPAL_ROOT.'/sites/all/themes/ocdla2/templates/blocks/twitter.htm');

	$vars['footer_include'] = <<<EOF
<div id="footer">
	<div class="content">
		<span class="footer-ocdla">OCDLA</span>
		<br />
		<span class="footer-address">
		101 East 14th<br />Eugene, OR 97401
		</span>
		<br />
	  <span class="footer-phone">541.686.8716</span>
	  <br />
	  <span class="footer-email">
	  	<a href="mailto:info@ocdla.org">info@ocdla.org</a>
	  </span>
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
		// $vars['theme_hook_suggestion'] = 'page--edit';
	}
}


function ocdla2_preprocess_form( &$vars )
{
	$vars['theme_hook_suggestion'] = 'form';
	if( $vars['form_id'] == 'ocdla2_login_sso_form' )
	{
		$vars['theme_hook_suggestion'] = 'form--login';	
	}
	if(in_array($vars['form_id'],array('global_contact_form' )))
	{
		$vars['theme_hook_suggestion'] = 'form--contact';
	}
}



function isMobileRequest()
{

$useragent=$_SERVER['HTTP_USER_AGENT'];
return isset($_GET['ismobile'])||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
}