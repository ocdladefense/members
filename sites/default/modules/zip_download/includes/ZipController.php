<?php

use Clickpdx\Core\Controller\ControllerBase;
use Clickpdx\Core\Exception\FileNotFoundException;
use Clickpdx\Core\Exception\AnonymousUserDownloadException;
use Clickpdx\Core\Script;
use Clickpdx\Core\Routing\RouteException;
use Ocdla\UserDownload;


class ZipController extends ControllerBase
{
	const EXCEPTION_EXIT_CODE = "0";
	
	public function genError()
	{
		$this->error('foobar');
	}
	public function getZipLink($id)
	{
		set_time_limit(600);
		$args = func_get_args();
		$downloadId = array_pop($args);
		// Where can an error happen?  It can happen here.
		
//		return array('url'=>'some/hrl');
		// throw new RouteException('foobar');
		try
		{
			$download = $this->createZip($downloadId);
			
			if($this->hasErrorExitCode($download->getExitCode()))
			{
				return array('url'=>"Script exited with a status code of {$code}.");
				throw new RouteException("Script exited with a status code of {$code}.");
			}
			if(!$download->userFileExists())
			{
				return array('url' => "The Zip file was not created.");
				throw new RouteException("The Zip file was not created.");
			}
		}
		catch(\Exception $e)
		{
			throw new RouteException($e->getMessage());
		}
		
		return array('url'=>$download->getUrl());
	}
	
	private function hasErrorExitCode($code)
	{
		return self::EXCEPTION_EXIT_CODE!=$code;
	}
	
	public function createZip($downloadId)
	{		
		$download = new UserDownload($downloadId);
		$exitCode = $download->createUserFile();
		return $download;
	}

	private function getDownloads($past='20110101', $type="pdf")
	{
		return db_query("SELECT i AS downloadId FROM {downloads} WHERE file_creation_time IS NULL AND entry_time >= :past
			AND memberid != 0",array('past'=>$past),'pdo')->fetchAll();
	}
}