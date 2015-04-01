<?php
require 'vendor/autoload.php';
require 'WvRequest.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Slim\Middleware\WvRequest;
use Slim\View;

$app = new \Slim\Slim();

$client = new Client();

//Include Request Config and Auth

include 'request_config.php';

// Use Middleware
$app->add(new WvRequest());

// $app->get('/', function() use ($app) {
//   $app->render('login.php');
// });

// Include Routes
include 'routes/authn.php';
include 'routes/donors.php';
include 'routes/children.php';
include 'routes/media.php';

$app->run();