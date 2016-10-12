<?php

$app->get('/',"TheoGuerin\Controllers\HomeController::indexAction");
$app->get('/hello/{name}',"TheoGuerin\Controllers\HomeController::helloAction");

$app->get('/admin/createBase',"TheoGuerin\Controllers\DataBaseController::createBaseAction");

$app->get('api/persones',"TheoGuerin\Controllers\API\PersonneController::getAllAction");
