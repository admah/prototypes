<?php
// Children Routes
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Child Detail Call
$app->get('/child/:id', function($id) use ($app) {

  $data = $app->wvReq->getChildDetail($id)->send();

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

// Child Detail With Media
$app->get('/child/:id/media', function($id) use ($app) {

  $data = $app->wvReq->getChildDetail($id)->send();

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

// Child Detail With Media
$app->post('/post/authn', function() use ($app) {

  var_dump($app->wvReq->postAuthn()->send());

});