<?php
// Authn Routes

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Authn Request POST
$app->post('/authn', function() use ($app) {
  $auth_creds = getAuthCreds();

  $req = makeClientRequest('authn', array("auth" => $auth_creds));
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


// Authn Request GET Test
$app->get('/authn', function(){
  $auth_creds = getAuthCreds();

  $req = makeClientRequest('authn', array("auth" => $auth_creds));
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
