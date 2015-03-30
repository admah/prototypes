<?php
// Donor Routes

// Donor Detail Call
$app->get('/donor/:id', function($id) use ($app) {
	// Get the SMSESSION header
	$smsession = $app->request->headers->get('SMSESSION');

	$req = makeClientRequest('donor_detail', array("SMSESSION" => $smession, "id" => $id));
  $client = new Client();

  echo "Donor Detail Call<br>";
  echo $smsession;
});

// Donor Detail with Children Call
$app->get('/donor/:id/children', function($id) use ($app) {
  echo "Donor Detail with Children Call<br>";
  echo "Donor Id: $id";
});