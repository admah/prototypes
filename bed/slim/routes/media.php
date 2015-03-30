<?php
// Media Call
$app->group('/media', function() use ($app) {

  $app->get('/child/:id', function($id) {
    // Media Call
    echo "Media Call Type Child<br>";
    echo "Id: $id";
  });

  $app->get('/project/:id', function($id) {
    // Media Call
    echo "Media Call Type Project<br>";
    echo "Id: $id";
  });

});