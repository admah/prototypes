<?php
function getConfigFile($path = "../../slim.api.config.json") {
  $file = file_get_contents($path);
  return $file;
}