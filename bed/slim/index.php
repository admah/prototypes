<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$app = new \Slim\Slim();

$client = new Client();

//Include Request Config and Auth
include 'request_config.php';

// Include Routes
include 'routes/authn.php';
include 'routes/donors.php';
include 'routes/children.php';
include 'routes/media.php';

$app->run();