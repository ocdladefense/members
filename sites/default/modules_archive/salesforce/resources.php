<?php

function oauthServiceLoader($rInfo,$debug=false)
{
	$svc = new Clickpdx\OAuth\OAuthHttpAuthorizationService();
	$svc->setOAuthParams($rInfo['params']);
	$svc->registerWriteHandler('POST',function($ch){
		$ch->h = \curl_init($ch->getUri());
		curl_setopt($ch->h, CURLOPT_HEADER, false);
		curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch->h, CURLOPT_POST, true);
		curl_setopt($ch->h, CURLOPT_POSTFIELDS, $ch->formatPostFields());
		return curl_exec($ch->h);
	});
	
	return $svc;
}

function sfRestApiServiceLoader($rInfo,$debug=false)
{
	$svc = new Clickpdx\SalesforceRestApiService();
	$svc->setDebug($debug);
	$svc->setParams($rInfo['params']);
	$svc->registerWriteHandler('POST',function(/*HttpMessage*/$ch){
		$ch->h = \curl_init($ch->getUri());
		curl_setopt($ch->h, CURLOPT_HEADER, false);
		curl_setopt($ch->h, CURLOPT_RETURNTRANSFER, true);
		$ch->addHeaders();
		return curl_exec($ch->h);
	});
	
	return $svc;
}