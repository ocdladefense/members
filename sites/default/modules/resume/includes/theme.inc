<?php

function resume_theme($template,$variables){
	ob_start();
	extract($variables);
	require($template);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}