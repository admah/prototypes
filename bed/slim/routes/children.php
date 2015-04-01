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

  $data = $app->wvReq->getChildDetail($id)->getChildMedia($id)->send();

  $childDetail = $data[0];
  $childMedia = $data[1];

  if ($childDetail['error']) {
    $childDetailData = array('error');
  } else {
    $childDetailData = $childDetail['response']->json();
  }

  if ($childMedia['error']) {
    $childMediaData = array('error');
  } else {
    $childMediaData = json_decode(json_encode($childMedia['response']->xml(), TRUE), TRUE);
  }


  $payload = array(
  	'childDetail' => $childDetailData,
  	'childMedia' => $childMediaData,
  );

  header('Content-Type: application/json');
  echo json_encode($payload);

});