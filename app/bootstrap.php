<?php

require 'Slim/Slim.php';

Slim::init();

Slim::get('/', function () {
  echo '<html><body>Hey, try something like <a href="/status/200">/status/200</a>, <a href="/status/404">/status/404</a> or <a href="/status/500">/status/500</a></body></html>';
});

Slim::get('/status/(:status)', function ($status = null) {
  if (is_null($status)) {
    Slim::response()->status(404);
    Slim::response()->body("Sorry Sir, You should provide a status.");
 }
  try {
    Slim::response()->status($status);
    echo Slim::response()->getMessageForCode($status);
  } catch (Exception $e) {
    Slim::response()->status(404);
    Slim::response()->body("Sorry Sir, we don't know this status ($status).");
  }
});

Slim::run();

