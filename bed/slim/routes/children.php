<?php
// Children Routes

// Child Detail Call
$app->get('/child/:id', function($id) use ($app) {
  echo "Child Detail Call<br>";
  echo "Child Id: $id";
});

// Child Detail With Media
$app->get('/child/:id/media', function($id) use ($app) {
  echo "Child Detail With Media Call<br>";
  echo "Child Id: $id";
});