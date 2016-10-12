<?php

$app->get('/',"TheoGuerin\Controllers\HomeController::indexAction");
$app->get('/hello/{name}',"TheoGuerin\Controllers\HomeController::helloAction");

$app->get('/createBase',"TheoGuerin\Controllers\DataBaseController::createBaseAction");

$app->get('/persones',"TheoGuerin\Controllers\PersonneController::personesAction");
