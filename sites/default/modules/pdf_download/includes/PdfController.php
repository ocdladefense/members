<?php

use Clickpdx\Core\Controller\ControllerBase;
use Clickpdx\Core\Exception\FileNotFoundException;
use Clickpdx\Core\Exception\AnonymousUserDownloadException;
use Ocdla\UserDownload;

/**
 * Downloads folder
 *
 * Set the downloads folder.
 */
# define('DOWNLOADS_FOLDER','sites/default/files/downloads');



/**
 * Uploads folder
 *
 * The uploads folder for this installation.
 * The uploads folder is used to store original PDFs.  These can
 * be considered the source PDFs from which the target PDFs are then
 * altered and saved into the DOWNLOADS_FOLDER.
 */
# define('UPLOADS_FOLDER','sites/default/files/uploads');

/**
 * Email log.
 *
 * Whether to always email the log.
 * If false, then the log is only emailed if there are
 * errors.  If true, then the log is always emailed, even if there are
 * no errors.
 */
# define('PDF_ALWAYS_EMAIL_LOG',true);


class PdfController extends ControllerBase
{
	private static $daysBack = 10;
	
	private $updateFileCreationTimes = true;
	
	private function getSearchRangeFrom($previousDays=3)
	{
		return time()-($previousDays*60*60*24);
	}
	
	public function __construct($settings)
	{
		$this->settings = $settings;
	}
	
	public function initSettings(array $settings)
	{
		$lastRun = new DateTime();
		$lastRunString = $lastRun->format('Y-m-d H:i:s');
		tail('Program started at: ' . $lastRunString );
		$updateConfigLastRun = array( 'lastProgramRunDateTime' => $lastRunString );
		$connectionParams = xml_settings_load( './config.xml', $updateConfigLastRun);
	}

	public function memberDownloads()
	{
		global $user;
		$pdfs = $this->getMemberDownloads($user->getMemberId());
		$old = $this->getInactiveMemberDownloads($user->getMemberId());
		
		$out = "<h4>Recently purchased</h4>".$this->getPdfCollectionInfo($pdfs);
		
		$out .= "<h4>Previously purchased</h4><p>Please contact OCDLA for access to any of these files.</p>".$this->getPdfCollectionInfo($old,'inactive');
		return $out;
	}

	public function listDownloads()
	{
		$out = '';
		$past = time()-self::$daysBack*60*60*24;
		$pastDateTime = date('Y-m-d', $past);
		$title = "<h4>Recent downloads from ".$pastDateTime . "</h4>";

		$pdfs = $this->getDownloads($past);
		return $title . $this->getPdfCollectionInfo($pdfs);
	}

	
	public function listPdfDownloads()
	{
		$out = '';
		$past = time()-self::$daysBack*60*60*24;
		$pastDateTime = date('Y-m-d', $past);
		$this->log("Searching for downloads from ".$pastDateTime);

		$pdfs = $this->getPdfDownloads($past);
		
		$description = "<p>This is a list of recent PDFs purchased by OCDLA members:</p>";
		return $description . $this->getPdfCollectionInfo($pdfs);
	}

	
	private function getPdfCollectionInfo($pdfs,$status=null)
	{
		$out = '';
		if (count($pdfs) < 1)
		{
			return "<h2>No recent files were found.</h2>";
		}
	
		foreach($pdfs as $entry)
		{
			try
			{
				$download = new UserDownload($entry['downloadId']);
				$out .= $status==='inactive'?$download->getMemberHtmlInactive():$download->getMemberHtml();
			}
			catch(\Exception $e)
			{
				$this->log($e->getMessage());
			}
		}	
		return $out;
	}
	
	public function recreatePdfs($daysPrevious)
	{
		$this->updateFileCreationTimes = false;
		// return entity_toString(func_get_args());
		$from = $this->getSearchRangeFrom($daysPrevious);
		$this->log("Searching for downloads from ".date('Y-m-d',$from));

		$pdfs = array_column($this->queryPdfDownloads($from),'downloadId');

		if (count($pdfs)<1)
		{
			$this->log("No records found, won't continue program.");
		}
		else
		{
			$this->doPdfCreation($pdfs);
		}

		return $this->getLog();
	}
	
	public function createPdfs()
	{

		$from = $this->getSearchRangeFrom();
		$this->log("Searching for downloads from ".date('Y-m-d',$from));

		$pdfs = array_column($this->getUncreatedDownloads($from),'downloadId');

		// 

		if (count($pdfs)<1)
		{
			$this->log("No records found, won't continue program.");
		}
		else
		{
			$this->doPdfCreation($pdfs);
		}

		return $this->getLog();
	}
	
	private function doPdfCreation($downloadIds)
	{
		$downloadIds = is_array($downloadIds)?$downloadIds:array($downloadIds);
		$errors = false;
		/**
		 * cycle through the downloads and create the necessary user files
		 */
		foreach($downloadIds as $downloadId)
		{
			try
			{
				$this->createPdf($downloadId);
			}
			catch(\Exception $e)
			{
				$errors = true;
				$this->log($e->getMessage());
			}
		}
		if(PDF_ALWAYS_EMAIL_LOG||$errors)
		{
			$this->mail('jbernal.web.dev@gmail.com','PDF Generation Log',$this->getLog());
		}
	}

	public function createPdf($downloadId)
	{
		$args = func_get_args();
		$downloadId = array_pop($args);
	
		# This function may produce output for the user-agent.
		$out = '';
		
			
		# This method can be called directly.
		# If this is the case then we set $path here so 
		# we can return something intelligent to the user-agent.
		$path = array_pop($args);
		
		$download = new UserDownload($downloadId);
		// Sanity checks
		if(empty($download->getUserId()))
		{
			throw new \Exception("There is no valid member affiliated with this download (Download id: {$downloadId}; member.id: {$download->getUserId()})");
		}
		if($download->type == "pdf")
		{
			$out = $download->createUserFile();
			if($this->updateFileCreationTimes===true)
			$download->setFileCreationTime(time());  
			$this->log("{$download->getDownloadId()}: Attempting to create a PDF file for ".$download);
		}
		else $this->log("{$download->getDownloadId()}: UserDownload was not of pdf type.");
		$out .= $this->getLog();
		if(isset($path)&&$path=='create-pdf')
		{
			return $out;
		}
	}

	private function getDownloads($past='20110101', $type="pdf")
	{
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE entry_time >= :past
			AND memberid != 0 ORDER BY entry_time DESC",array('past'=>$past),'pdo')->fetchAll();
	}
	
	private function queryPdfDownloads($past)
	{
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE entry_time >= :past
			AND memberid != 0 ORDER BY entry_time DESC",array('past'=>$past),'pdo')->fetchAll();
	}
	
	private function getUncreatedDownloads($past='20110101', $type="pdf")
	{
		$past = $this->getSearchRangeFrom(14);
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE entry_time >= :past
			AND memberid != 0 ORDER BY entry_time DESC",array('past'=>$past),'pdo')->fetchAll();
	}
	
	private function getPdfDownloads($past=null,$type='pdf')
	{
		return db_query("SELECT d.i AS downloadId FROM {downloads} d JOIN {catalog} c ON(c.i=d.productid) WHERE SoftwareType=:type AND entry_time >= :past ORDER BY entry_time DESC",array('past'=>$past,'type'=>'pdf'),'pdo')->fetchAll();
	}
	
	private function getMemberDownloads($memberid,$type='pdf')
	{
		$time = $this->getSearchRangeFrom(14);//go 2 weeks back to display downloads
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE memberid = :memberid AND (file_creation_time > :time OR entry_time > :time) ORDER BY entry_time DESC",
			array(
				'memberid'=>$memberid,
				'time' => $time
			),'pdo')->fetchAll();
	}
	
	private function getInactiveMemberDownloads($memberid,$type='pdf')
	{
		$time = $this->getSearchRangeFrom(14);//go 2 weeks back to display downloads
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE memberid = :memberid AND file_creation_time < :time ORDER BY entry_time DESC",
			array(
				'memberid'=>$memberid,
				'time' => $time
			),'pdo')->fetchAll();
	}
}