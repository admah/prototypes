<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function makeClientRequest($key, $options) {
	$request_config = array(
	  'authn' => array(
	    'group' => 'ist',
	    'url' =>  'https://serviceonedev.worldvision.org/i3/authn.json',
	    'method' => 'POST',
	    'parameters' => array(
	      'message_topic_application' => 'testMyWorldVision'
	    ),
	    'auth' => array(
	      'user' => '',
	      'pass' => '',
	    ),
	  ),
	  'donor_detail' => array(
	    'group' => 'ist',
	    'url' =>  'https://serviceonedev.worldvision.org/i3/parties.json',
	    'method' => 'GET',
	    'parameters' => array(
	      'message_topic_application' => 'testMyWorldVision',
	      'party_identifier' => '',
	    ),
	    'auth' => array(
	      'user' => '',
	      'pass' => '',
	    ),
	  ),
	  'donor_info' => array(
	    'group' => 'istore',
	    'url' =>  'https://serviceonedev.worldvision.org/ws/account/partyInfo',
	    'method' => 'GET',
	    'parameters' => array(
	      'secToken' => '',
	      'username' => '',
	    ),
	    'auth' => array(
	      'user' => '',
	      'pass' => '',
	    ),
	  ),    
	  'accomplishments' => array(
	    'group' => 'cn',
	    'url' =>  'https://cn.worldvision.org/accomplishment-data/content-data/country/2013/all',
	    'method' => 'GET',
	    'parameters' => array(),
	    'auth' => array(),
	  ),
	  'child_media' => array(
	    'group' => 'rmt',
	    'url' =>  'https://serviceonemediastg.wvi.org:8443/media/child',
	    'method' => 'GET',
	    'parameters' => array(
	      'child_code' => ''
	    ),
	    'auth' => array(
	      'user' => '',
	      'pass' => '',
	    ),
	  ),
	  'community_media' => array(
	    'group' => 'rmt',
	    'url' =>  'https://serviceonemediastg.wvi.org:8443/media/project',
	    'method' => 'GET',
	    'parameters' => array(
	      'project_code' => ''
	    ),
	    'auth' => array(
	      'user' => '',
	      'pass' => '',
	    ),
	  ),
	);

  switch ($key) {
  	case 'authn':
  	   $config = $request_config[$key];
  	  return authnRequest($config, $options);
  	default:
  	  return;
  }
}

function authnRequest($config, $options) {
  $client = new Client();

  // Get Auth
  $auth = isset($options['auth']) ? $options['auth'] : 
  	(isset($config['auth']) ? $config['auth'] : array('user' => '', 'pass' => ''));
  $auth_opt = array($options['auth']['user'], $options['auth']['pass']);
  //var_dump($options['auth']);
  //var_dump($auth);

  // Set Method
  $method = $config['method'];

  // Get Parameters
  if (in_array($method, array('POST'))) {
  	$bodyParameters = $config['parameters'];
  	$queryParameters = isset($config['query']) ? $config['query'] : array();
  } else {
  	$queryParameters = isset($config['query']) ? $config['query'] : $config['parameters'];
  }

  // Set URL
  $url = $config['url'];

  $opts = array();

  // Set Body Parameters
  if (!empty($bodyParameters)) {
  	$opts['body'] = $bodyParameters;
  }

  // Set Auth
  if (!empty($auth_opt)) {
    $opts['auth'] = $auth_opt;
  }

  // Set Client Object
  $req = $client->createRequest($method, $url, $opts);

  // Set Query
  if (!empty($queryParameters)) {
  	$req->setQuery($queryParameters);
  }

  // Send Request
  return $req;
}

function getAuthCreds() {
  $user = '';
  $pass = '';

  if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
    if(preg_match("/Basic\s+(.*)$/i", $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $matches)) {
      list($user, $pass) = explode(":", base64_decode($matches[1]));
    }
  } else {
    $user = $environment["PHP_AUTH_USER"];
    $pass = $environment["PHP_AUTH_PW"];
  }

  return array('user' => $user, 'pass' => $pass);
}
;?>