<?php
define('APP_AUTOLOADER_EXTENSION','php');

function doctrine_autoloader($class){
	$searchDirs = classSearchDirs(array('common/lib','dbal/lib'),array('prefix'=>DOCUMENT_ROOT.'/vendor/doctrine'));
	$classFile = findClassFile($searchDirs,$class,true);
	if(false!==$classFile)
	{
		loadClassFile($classFile);
	}
}