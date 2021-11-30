<?php

/**
 * Example of adding JavaScript to a Drupal form.
 */

// Add a library.
$form['#attached']['library'][] = array('router', 'router');	

// Add a single JavaScript file.
$form['#attached']['js'] = array(
	array(
		'data' => drupal_get_path('module', 'orders') . '/js/orders.event.js',
		'options' => array(
			'group' => JS_THEME,
			'preprocess' => true,
			'every_page' => false, 
		),
	),
);
 