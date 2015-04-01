<?php
require 'vendor/autoload.php';
require 'WvRequest.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Slim\Middleware\WvRequest;

$app = new \Slim\Slim();

$client = new Client();

//Include Request Config and Auth

include 'request_config.php';
include 'xml2array.php';

// Use Middleware
$app->add(new WvRequest());

// Include Routes
include 'routes/authn.php';
include 'routes/donors.php';
include 'routes/children.php';
include 'routes/media.php';

$app->run();