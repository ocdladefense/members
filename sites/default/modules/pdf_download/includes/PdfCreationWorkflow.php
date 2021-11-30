<?php

use Clickpdx\Core\Controller\ControllerBase;
use Clickpdx\Core\Exception\FileNotFoundException;
use Clickpdx\Core\Exception\AnonymousUserDownloadException;
use Ocdla\UserDownload;


class PdfCreationWorkflow// extends ControllerBase
{
	
	private $funcs = array()
	
	private static function getDefaultWorkflowNarrative()
	{
		return array(
			'queryDownloads' => array(
				'callback' => array($this,'queryPdfDownloads'),
				'args' => array('entry_time' => $past)
			),
			'createPdfs' => array(
				
			)
		);
	}
	
	private function getSearchRangeFrom($previousDays=3)
	{
		return time()-($previousDays*60*60*24);
	}
	
	public function __construct($narrative)
	{
		$func = 0;
		foreach($narrative as $title => $chapter)
		{
			$outputs[$func++] = call_user_func_array($chapter['callback'],$chapter['args']);
		}
		
		// Chapter 1: query for the downloads we need
		$pdfs = 
		
	}
	
	public function initSettings(array $settings)
	{
		$lastRun = new DateTime();
		$lastRunString = $lastRun->format('Y-m-d H:i:s');
		tail('Program started at: ' . $lastRunString );
		$updateConfigLastRun = array( 'lastProgramRunDateTime' => $lastRunString );
		$connectionParams = xml_settings_load( './config.xml', $updateConfigLastRun);
	}


}