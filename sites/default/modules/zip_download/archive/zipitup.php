<?php
//exit;
	$cmd = "\"\"\\Inetpub\\ocdla\\html\\send-pdfs\\zip\" -rv9 \"dev\" \"\\inetpub\\ocdla\" -x *\\ocdla\\stats* *.zip* *.shtml* *.pdf* *.jpg* *.png* *.gif*\"";
	
	$cmd = "zipitup.bat";

	$dir = "\\inetpub\\ocdla\\uploads";

	//chdir( $dir );
	
	echo "<p>$cmd</p>";
	//echo $dir;
	//echo "<h2>Current working directory:</h2><p>".getcwd()."</p>";	
	$output = shell_exec( $cmd );
	
echo $output;