<?php

function xmlUserInfo($u)
{
	$data=$u->getFields();
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root = $doc->createElement('users');// Root XML element.
	$doc->appendChild($root);

	$user = $doc->createElement('user');

	$status = $doc->createElement('loggedin');
	if($u->hasAuthenticatedSession())
	{
		$status->appendChild($doc->createTextNode('true'));
	}
	else
	{
		$status->appendChild($doc->createTextNode('false'));
	}

	$username = $doc->createElement('username');
	$username->appendChild($doc->createTextNode($data["username"]));
	
	$autoid = $doc->createElement('autoId');
	$autoid->appendChild($doc->createTextNode($data["autoId"]));
	
	$id = $doc->createElement('id');
	$id->appendChild($doc->createTextNode($data["id"]));

	$firstname = $doc->createElement('firstname');
	$firstname->appendChild($doc->createTextNode($data["name_first"]));
	
	$roles = $doc->createElement('roles');
	$admin = $doc->createElement('admin');
	$admin->appendChild($doc->createTextNode($data["is_admin"]));
	$member = $doc->createElement('member');
	$member->appendChild($doc->createTextNode($data["is_member"]));
	$tester = $doc->createElement('tester');
	$tester->appendChild($doc->createTextNode($data["is_tester"]));
	$roles->appendChild($admin);
	$roles->appendChild($member);
	$roles->appendChild($tester);  
	
	$option1 = $doc->createElement('cartItems');
	$option1->appendChild($doc->createTextNode('5'));

	$option2 = $doc->createElement('option2');
	$option2->appendChild($doc->createTextNode(''));
	
	$user->appendChild($status);
	$user->appendChild($username);
	$user->appendChild($autoid);
	$user->appendChild($id);
	$user->appendChild($firstname);
	$user->appendChild($option1);
	$user->appendChild($option2);
	$user->appendChild($roles);
	$root->appendChild($user);

	return $doc->saveXML();
}