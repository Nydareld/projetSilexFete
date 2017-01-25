<?php

$app->options("{anything}", function () {
    return new \Symfony\Component\HttpFoundation\JsonResponse(null, 204);
})->assert("anything", ".*");

// Product Routes
$app->get('/api/product',"TheoGuerin\ApiController\ProductController::getAllProductAction");
$app->get('/api/product/{id}',"TheoGuerin\ApiController\ProductController::getProductAction");
$app->post('/api/product',"TheoGuerin\ApiController\ProductController::postProductAction");
$app->put('/api/product/{id}',"TheoGuerin\ApiController\ProductController::putProductAction");
$app->delete('/api/product/{id}',"TheoGuerin\ApiController\ProductController::deleteProductAction");

// Event
$app->get('/api/event',"TheoGuerin\ApiController\EventController::getAllEventAction");
$app->get('/api/event/{id}',"TheoGuerin\ApiController\EventController::getEventAction");
$app->post('/api/event',"TheoGuerin\ApiController\EventController::postEventAction");
$app->put('/api/event/{id}',"TheoGuerin\ApiController\EventController::putEventAction");
$app->delete('/api/event/{id}',"TheoGuerin\ApiController\EventController::deleteEventAction");


//Comment
$app->post('/api/product/{id}/comment',"TheoGuerin\ApiController\ProductController::postCommentAction");
