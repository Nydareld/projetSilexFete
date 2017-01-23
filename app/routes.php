<?php
// Product Get
$app->get('/api/product',"TheoGuerin\ApiController\ProductController::getAllProductAction");
$app->get('/api/product/{id}',"TheoGuerin\ApiController\ProductController::getProductAction");
$app->post('/api/product',"TheoGuerin\ApiController\ProductController::postProductAction");
$app->put('/api/product/{id}',"TheoGuerin\ApiController\ProductController::putProductAction");
$app->delete('/api/product/{id}',"TheoGuerin\ApiController\ProductController::deleteProductAction");
