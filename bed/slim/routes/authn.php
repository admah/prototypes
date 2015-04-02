<?php
// Authn Routes

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Authn Request POST
$app->post('/authn', function() use ($app) {

  if($app->request()->isPost()) {
    $creds = array(
      'user' => $app->request()->post('user'),
      'pass' => $app->request()->post('pass'),
    );
  }

  $data = $app->wvReq->postAuthn($creds)->send();

  if ( $data[0]['error'] == false ) {
    $json = $data[0]['response']->json();
    /*header('Content-Type: application/json');
    echo json_encode($json);*/

    //Set SMSESSION cookie
    $smsession = $json['Auth_Party_Resp']['SMSESSION'];
    $expires = time() + 3600;
    $app->setCookie('smsession', $smsession, $expires);

    //Render Donor info template
    $app->view();
    $app->render('donor_auth.php', array('data' => $json));
  } else {
    $error = $data[0]['exception'];
    header('Content-Type: application/json');
    echo json_encode(array("error"));
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
