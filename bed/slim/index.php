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
include 'getConfig.php';

$configfile = getConfigFile();

// Use Middleware
$app->add(new WvRequest(null, $configfile));

// $app->get('/', function() use ($app) {
//   $app->render('login.php');
// });

// Include Routes
include 'routes/authn.php';
include 'routes/donors.php';
include 'routes/children.php';
include 'routes/media.php';

$app->run();