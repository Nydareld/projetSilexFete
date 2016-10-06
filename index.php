<?php

require_once __DIR__."/vendor/autoload.php";

$app = new Silex\Application();
global $app;
require_once __DIR__."/app/app.php";

$app->run();
