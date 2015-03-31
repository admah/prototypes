<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Donor Routes

// Donor Detail Call
$app->get('/donor/:id', function($id) use ($app) {
	// Get the SMSESSION header
	$smsession = $app->request->headers->get('SMSESSION');

	$req = makeClientRequest('donor_detail', array("parameters" => array("party_identifier" => $id), "headers" => array("SMSESSION" => $smsession)));
  $client = new Client();

  try {
    $res = $client->send($req);
    // Show Normal Response
    echo json_encode($res->json());
  } catch(RequestException $e) {
  	// Show Error
  	echo json_encode($e->getResponse()->json());
  }
});

// Donor Detail with Children Call
$app->get('/donor/:id/children', function($id) use ($app) {
	// Get the SMSESSION header
	$smsession = $app->request->headers->get('SMSESSION');

	$req = makeClientRequest('donor_detail', array("parameters" => array("party_identifier" => $id), "headers" => array("SMSESSION" => $smsession), "children" => TRUE));
  $client = new Client();

  try {
    $res = $client->send($req);
    // Show Normal Response
    echo json_encode($res->json());
  } catch(RequestException $e) {
  	// Show Error
  	echo json_encode($e->getResponse()->json());
  }
});