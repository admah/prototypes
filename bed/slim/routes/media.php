<?php
// Media Call
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$app->group('/media', function() use ($app) {

  // Media Child
  $app->get('/child/:id', function($id) use ($app) {
    // Child Media Call  
    $data = $app->wvReq->getChildMedia($id)->send();

    if ( $data[0]['error'] == false ) {
      $xml = $data[0]['response']->xml();
      header('Content-Type: application/json');
      echo json_encode($xml);
    } else {
      $error = $data[0]['exception'];
      header('Content-Type: application/json');
      echo json_encode(array("error"));
    }    
  });

  // Media Community
  $app->get('/project/:id', function($id) use ($app) {
    // Project Media Call
    $data = $app->wvReq->getProjectMedia($id)->send();

    if ( $data[0]['error'] == false ) {
      $xml = $data[0]['response']->xml();
      header('Content-Type: application/json');
      echo json_encode($xml);
    } else {
      $error = $data[0]['exception'];
      header('Content-Type: application/json');
      echo json_encode(array("error"));
    }

  });

});