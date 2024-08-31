<?php

require_once '../app/init.php';

try {
  $app = new App();
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
