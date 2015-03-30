<?php
// Donor Routes

// Donor Detail Call
$app->get('/donor/:id', function($id) use ($app) {
  echo "Donor Detail Call<br>";
  echo "Donor Id: $id";
});

// Donor Detail with Children Call
$app->get('/donor/:id/children', function($id) use ($app) {
  echo "Donor Detail with Children Call<br>";
  echo "Donor Id: $id";
});