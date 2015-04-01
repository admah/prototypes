<?php

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

// Donor Routes

// Donor Detail Call
$app->get('/donor/:id', function($id) use ($app) {
	// // Get the SMSESSION header
	// $smsession = $app->request->headers->get('SMSESSION');

	// $req = makeClientRequest('donor_detail', array("parameters" => array("party_identifier" => $id), "headers" => array("SMSESSION" => $smsession)));
 //  $client = new Client();

 //  try {
 //    $res = $client->send($req);
 //    // Show Normal Response
 //    echo json_encode($res->json());
 //  } catch(RequestException $e) {
 //  	// Show Error
 //  	echo json_encode($e->getResponse()->json());
 //  }
  $data = $app->wvReq->getDonorDetail($id)->send();

  if ( $data[0]['error'] == false ) {
    $json = $data[0]['response']->json();
    header('Content-Type: application/json');
    echo json_encode($json);
  } else {
    $error = $data[0]['exception'];
    header('Content-Type: application/json');
    echo json_encode(array("error"));
  }
});

// Donor Detail with Children Call
$app->get('/donor/:id/children', function($id) use ($app) {
	// Get the SMSESSION header
	$smsession = $app->request->headers->get('SMSESSION');

	$req = makeClientRequest('donor_detail', array("parameters" => array("party_identifier" => $id), "headers" => array("SMSESSION" => $smsession), "children" => TRUE));
  //$client = new Client();

  /*try {
    $res = $client->send($req);
    // Show Normal Response
    echo json_encode($res->json());
  } catch(RequestException $e) {
  	// Show Error
  	echo json_encode($e->getResponse()->json());
  }*/var_dump($req);
});