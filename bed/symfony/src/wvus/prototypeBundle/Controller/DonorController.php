<?php

namespace wvus\prototypeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use wvus\prototypeBundle\Form\Type\DonorType;

class DonorController extends Controller
{
	  //Display a list of all donors
    public function indexAction()
    {   
		$buzz = $this->container->get('buzz');
		$response = $buzz->get('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/');
		$donors = json_decode($response->getContent());

        $form = $this->createForm(new DonorType());

		// renders app/Resources/views/Donors/index.html.twig
		return $this->render('views/Donors/index.html.twig', array('donors' => $donors, 'form' => $form->createView()));
    }

    //Edit a single donor
    
    public function editAction(Request $request)
    {
        $id         = 8;
        $first_name = 'Bruce';
        $last_name  = 'Wayne';
        $email      = 'bruce@wayneent.com';
        $phone      = '123-456-7890';
        $address_1  = 'Wayne Manor';
        $address_2  = '';
        $city       = 'Gotham City';
        $state      = 'NY';
        $zip_code   = '00001';

        $jsonPayload = json_encode(
            array(
                'title'      => $first_name . ' ' . $last_name,
                'type'       => 'donor',
                'field_first_name' => array('und' => array(array('value' => $first_name))),
                'field_last_name' => array('und' => array(array('value' => $last_name))),
                'field_email' => array('und' => array(array('value' => $email))),
                'field_phone_number' => array('und' => array(array('value' => $phone))),
                'field_address_1' => array('und' => array(array('value' => $address_1))),
                'field_address_2' => array('und' => array(array('value' => $address_2))),
                'field_city' => array('und' => array(array('value' => $city))),
                'field_state' => array('und' => array(array('value' => $state))),
                'field_zip_code' => array('und' => array(array('value' => $zip_code))),
            )
        );

        $headers = array(
            'Content-Type' => 'application/json',
        );

        $buzz = $this->container->get('buzz');
        $response = $buzz->put('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/' . $id, $headers, $jsonPayload);
        $content = json_decode($response->getContent());

        $success = 'Donor successfully updated!';
     
        //header('Content-Type: application/json');
        //echo json_encode($content);

        new Response($content);
    }

    //Delete a single donor
    public function deleteAction(Request $request)
    {
        $id = 9;
        $headers = array(
            'Content-Type' => 'application/json',
        );

    	$buzz = $this->container->get('buzz');
        $response = $buzz->delete('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/'. $id, $headers);
        $content = json_decode($response->getContent());

        $success = 'Donor successfully deleted!';
     
        //header('Content-Type: application/json');
        //echo json_encode($content);

        new Response($content);
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm(new DonorType());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
    
            $data = $form->getData();

            $first_name = $data['first_name'];
            $last_name  = $data['last_name'];
            $email      = $data['email'];
            $phone      = $data['phone'];
            $address_1  = $data['address_1'];
            $address_2  = $data['address_2'];
            $city       = $data['city'];
            $state      = $data['state'];
            $zip_code   = $data['zip_code'];

            $jsonPayload = json_encode(
                array(
                    'title'      => $first_name . ' ' . $last_name,
                    'type'       => 'donor',
                    'field_first_name' => array('und' => array(array('value' => $first_name))),
                    'field_last_name' => array('und' => array(array('value' => $last_name))),
                    'field_email' => array('und' => array(array('value' => $email))),
                    'field_phone_number' => array('und' => array(array('value' => $phone))),
                    'field_address_1' => array('und' => array(array('value' => $address_1))),
                    'field_address_2' => array('und' => array(array('value' => $address_2))),
                    'field_city' => array('und' => array(array('value' => $city))),
                    'field_state' => array('und' => array(array('value' => $state))),
                    'field_zip_code' => array('und' => array(array('value' => $zip_code))),
                )
            );

            $headers = array(
                'Content-Type' => 'application/json',
            );

            $buzz = $this->container->get('buzz');
            $create = $buzz->post('http://dev-prototype-testing.d2.worldvision.org/wv_services/donors/', $headers, $jsonPayload);
            $content = json_decode($create->getContent());

            $success = 'Donor successfully updated!';
         
            //header('Content-Type: application/json');
            //echo json_encode($content);

            return $this->redirect($this->generateUrl('wvusprototype_all'));
        }

        return $this->redirect('donors');
    }
}