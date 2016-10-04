<?php

$app->get('/',"TheoGuerin\Controllers\HomeController::indexAction");
$app->get('/hello/{name}',"TheoGuerin\Controllers\HomeController::helloAction");
