<?php
namespace Protofisch\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Http\Client;


class ProtofischController extends AbstractActionController
{
  public function indexAction()
  {
    $http_client = new Client('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/');
    $res = $http_client->send();
    $json = json_decode($res->getBody());

    $layout = $this->layout();
    $layout->setTemplate('layout/protofisch');

    $viewDonors = new ViewModel(array('donors' => $json));
    return $viewDonors;
  }

  public function readAction()
  {
    $http_client = new Client('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/');
    $res = $http_client->send();
    $json = json_decode($res->getBody());

    $layout = $this->layout();
    $layout->setTemplate('layout/protofisch');

    $viewDonors = new JsonModel(array('donors' => $json));
    return $viewDonors;
  }

  public function addAction()
  {
    $data = $_POST;

    if (empty($data)) {
      // Incorrect Method Request
      return new JsonModel(array('error_msg' => 'Error: expecting a POST Method request.'));
    }

    $post_fields = array(
      'type' => 'donor',
      'title' => $data['first_name'] . ' ' . $data['last_name'],
    );

    // Field Post Format
    $field_format = array('und' => array(array('value' => '',)));

    // Field Map
    $data_map = array(
      'first_name' => 'field_first_name',
      'last_name' => 'field_last_name',
      'email' => 'field_email',
      'phone_numer' => 'field_phone_number',
      'address_1' => 'field_address_1',
      'address_2' => 'field_address_2',
      'city' => 'field_city',
      'state' => 'field_state',
      'zip_code' => 'field_zip_code',
    );

    // Map Data For Service Post
    foreach ( $data_map as $field_name => $field_map_key ) {
      $field = $field_format;
      if ( isset($data[$field_name]) ) {
        $field['und'][0]['value'] = $data[$field_name];
      }
      $post_fields[$field_map_key] = $field;
    }

    $post_body = json_encode($post_fields);

    // HTTP Client Call
    $http_client = new Client('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/');
    $http_client->setMethod('POST');
    $http_client->setEncType('application/json');    
    $http_client->setRawBody($post_body);
    $res = $http_client->send();
    $json = (array) json_decode($res->getBody());

    // Response With JSON
    $json_res = new JsonModel($json);

    // Return To View
    return $json_res;
  }

  public function editAction()
  {
    $data = $_POST;

    if (empty($data)) {
      // Incorrect Method Request
      return new JsonModel(array('error_msg' => 'Error: expecting a POST Method request.'));
    }

    $post_fields = array(
      'type' => 'donor',
    );

    $post_fields['nid'] = !empty($data['donor_id']) ? $data['donor_id'] : (!empty($data['nid']) ? $data['nid'] : null);

    if ( !$post_fields['nid'] ) {
      return new JsonModel(array('error_msg' => 'Error: Required donor_id parameter is missing.'));
    }

    if ( isset($data['first_name']) || isset($data['last_name']) ) {
      $post_fields['title'] = implode(' ', array($data['first_name'], $data['last_name']));
    }

    // Field Post Format
    $field_format = array('und' => array(array('value' => '',)));

    // Field Map
    $data_map = array(
      'first_name' => 'field_first_name',
      'last_name' => 'field_last_name',
      'email' => 'field_email',
      'phone_numer' => 'field_phone_number',
      'address_1' => 'field_address_1',
      'address_2' => 'field_address_2',
      'city' => 'field_city',
      'state' => 'field_state',
      'zip_code' => 'field_zip_code',
    );

    // Map Data For Service Post
    foreach ( $data_map as $field_name => $field_map_key ) {
      $field = $field_format;

      if ( isset($data[$field_name]) ) {
        $field['und'][0]['value'] = $data[$field_name];
        $post_fields[$field_map_key] = $field;
      }
    }

    $donor_id = $post_fields['nid'];
    $post_body = json_encode($post_fields);
    $edit_url = 'http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/' . $donor_id;

    // HTTP Client Call
    $http_client = new Client($edit_url);
    $http_client->setMethod('PUT');
    $http_client->setEncType('application/json');    
    $http_client->setRawBody($post_body);
    $res = $http_client->send();
    $json = (array) json_decode($res->getBody());

    // Response With JSON
    $json_res = new JsonModel($json);

    // Return To View
    return $json_res;
  }

  public function deleteAction()
  {
    $data = $_POST;

    if (empty($data)) {
      // Incorrect Method Request
      return new JsonModel(array('error_msg' => 'Error: expecting a POST Method request.'));
    }

    if (!isset($data['donor_id'])) {
      // Missing Parameter
      return new JsonModel(array('error_msg' => 'Error: Required donor_id parameter is missing.'));
    }

    $donor_id = $data['donor_id'];

    // HTTP Client Call
    $delete_url = 'http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/' . $donor_id;
    $http_client = new Client($delete_url);
    $http_client->setMethod('DELETE');
    $http_client->setEncType('application/json');
    $res = $http_client->send();
    $json = $res->getBody();

    // Response With JSON
    $json_res = new JsonModel(json_decode($json));

    // Return To View
    return $json_res;
  }
}