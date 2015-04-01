<?php
/*
 * WvRequest
 */

namespace Slim\Middleware;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Event;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

class WvRequest extends \Slim\Middleware
{
    public $options;
    public $data = array();
    public $configs;
    public $client;
    public $req_configs;
    public $requests;
    private $authCreds;
    private $smsession;
    private $authConfigCreds = array();

    public function __construct($config = null, $authConfig = null)
    {


        $this->setConfigs($config);

        if ($authConfig) {
            $authConfig = json_decode($authConfig, TRUE);
            $this->authConfigCreds = $authConfig;
        }

        $this->client = new Client();
    }

    public function call()
    {
        $this->getAuthCreds();
        $this->app->wvReq = $this;
        $this->next->call();
    }

    public function getReq($key, $opts)
    {
        $config = $this->configs[$key];
        $req_opts = array();

        // Method
        $method = $config['method'];

        // URL
        $url = $config['url'];

        // Auth
        if (!empty($opts['auth']['user'])) {
            $req_opts['auth'] = array($opts['auth']['user'], $opts['auth']['pass']);
        }

        // Query
        $query = array();

        if (!empty($opts['query']) && !empty($config['query'])) {
            $query = array_merge($config['query'], $opts['query']);
        } elseif (!empty($opts['query'])) {
            $query = $opts['query'];
        } elseif (!empty($config['query'])) {
            $query = $config['query'];
        }

        // Parameters
        $params = null;

        if (!empty($opts['parameters']) && !empty($config['parameters'])) {
            $params = array_merge($config['parameters'], $opts['parameters']);
        } elseif (!empty($opts['parameters'])) {
            $params = $opts['parameters'];
        } elseif (!empty($config['parameters'])) {
            $params = $config['parameters'];
        }      

        if (in_array($method, array('POST','PUT')) && !empty($params)) {
            $bodyParameters = $params;
        } elseif (!empty($params)) {
            $query = array_merge($params, $query);
        }

        // Finalize Params
        if (!empty($query)) {
            $req_opts['query'] = $query;
        }

        // Body
        if (!empty($bodyParameters)) {
            $req_opts['body'] = $bodyParameters;
        } elseif ( !empty($config['body']) || !empty($opts['body']) ) {
            $req_opts['body'] = isset($opts['body']) ? $opts['body'] : $config['body'];
        }

        // Headers
        if (!empty($opts['headers']) || !empty($config['headers'])) {
            $req_opts['headers'] = isset($opts['headers']) ? $opts['body'] : $config['headers'];
        } elseif (!empty($opts['smsession'])) {
            $req_opts['headers']['SMSESSION'] = $opts['smsession'];
        }

        // Save Request Config
        $this->req_configs[$key] = array(
            'method' => $method, 
            'url' => $url, 
            'opts' => $req_opts,
        );

        $req = $this->client->createRequest($method, $url, $req_opts);

        $this->requests[$key] = $req;

        return $this;
    }

    public function send()
    {
        $client = $this->client;
        $requests = array();

        foreach( $this->requests as $req ) {
            $requests[] = $req;
        }

        if (empty($requests)) {
            return null;
        } 

        $data = $this->data;
        $opts = array(
            'complete' => function(CompleteEvent $event) use (&$data) {
                $data[] = array(
                    'event' => $event,
                    'error' => false,
                    'response' => $event->getResponse(),
                    'request' => $event->getRequest(),
                );
            },
            'error' =>function(ErrorEvent $event) use (&$data) {
                $data[] = array(
                    'event' => $event,
                    'error' => true,
                    'exception' => $event->getException(),
                    'response' => (($event->getResponse()) ? $event->getResponse() : null),
                    'request' => $event->getRequest(),
                );
            }
        );

        Pool::send($client, $requests, $opts);

        $this->data = $data;

        // Reset Requests
        $this->requests = array();

        return $data;
    }


    public function setConfigs($configs = null)
    {
       if ($configs == null) {
           $this->configs = array(
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
                'headers' => array(
                    'SMSESSION' => '',
                ),
                'children' => '',
                'donor_info_url' => 'https://serviceonedev.worldvision.org/ws/account/partyInfo',
                'children_url' => 'https://serviceonedev.worldvision.org/i3/parties/x/children.json',
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
              'child_detail' => array(
                'group' => 'ist',
                'url' =>  'https://serviceonedev.worldvision.org/ServiceOne/child/detail.json',
                'method' => 'GET',
                'parameters' => array(
                  'message_topic_application' => 'testSlimFramework',
                  'item_num_type' => 'CHILD_ID',
                  'item_number' => '',
                ),
                'auth' => array(
                  'user' => '',
                  'pass' => '',
                ),
              ),              
            );
        } else {
            $this->configs = $configs;
        }
    }

    public function addConfig($key, $config)
    {
        $this->config[$key] = $config;
    }

    public function getConfig($key)
    {

    }

    private function getAuthCreds()
    {
        $user = '';
        $pass = '';
        $headers = $this->app->request->headers;

        $authPostLogin = $this->app->request->post();

        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            if(preg_match("/Basic\s+(.*)$/i", $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $matches)) {
              list($user, $pass) = explode(":", base64_decode($matches[1]));
            }
        } else {
            $user = $environment["PHP_AUTH_USER"];
            $pass = $environment["PHP_AUTH_PW"];
        }

        if (!empty($user)) {
            $this->authCreds = array('user' => $user, 'pass' => $pass);
        } else {
            $this->authCreds = null;
        }

        if (isset($headers['SMSESSION'])) {
            $this->smsession = $headers['SMSESSION'];
        }
    }

    public function getData($key = null)
    {
        if ($key == null) {
            return $this->data;          
        } elseif ($this->data[$key]) {
            return $this->data[$key];
        }
    }

    public function postAuthn($creds = NULL)
    {   
        if(!empty($creds)) {
          $auth = $creds;
        } else {
          $auth = $this->authCreds;
        }
        
        $opts = array(
            'auth' => $auth,
        );

        $this->getReq('authn', $opts);

        return $this;
    }

    public function getDonorDetail($id)
    {
        $auth = $this->authCreds;
        $query = array('party_identifier' => $id);

        $opts = array(
            'query' => $query,
            'auth' => $auth
        );

        $this->getReq('donor_detail', $opts);

        return $this;
    }

    public function getDonorInfo($id)
    {
        return $this;
    }

    public function getChildDetail($id)
    {
        $auth = $this->authCreds;
        $query = array('item_number' => $id);

        $opts = array(
            'query' => $query,
            'auth' => $auth
        );

        $this->getReq('child_detail', $opts);

        return $this;
    }    

    public function getChildMedia($id)
    {
        //$auth = $this->authCreds;
        $auth = $this->authConfigCreds['rmt'];
        $query = array('child_code' => $id);

        $opts = array(
            'query' => $query,
            'auth' => $auth
        );

        $this->getReq('child_media', $opts);

        return $this;
    }

    public function getProjectMedia($id)
    {
        //$auth = $this->authCreds;
        $auth = $this->authConfigCreds['rmt'];
        $query = array('project_code' => $id);

        $opts = array(
            'query' => $query,
            'auth' => $auth
        );

        $this->getReq('community_media', $opts);

        return $this;
    }    

}
