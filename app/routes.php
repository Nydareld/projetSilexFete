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

// Product add Comment
$app->post('/api/product/{id}/comment',"TheoGuerin\ApiController\ProductController::postCommentAction");

// Product add Location
$app->post('/api/product/{id}/location',"TheoGuerin\ApiController\ProductController::postLocationAction");

// Event
$app->get('/api/event',"TheoGuerin\ApiController\EventController::getAllEventAction");
$app->get('/api/event/{id}',"TheoGuerin\ApiController\EventController::getEventAction");
$app->post('/api/event',"TheoGuerin\ApiController\EventController::postEventAction");
$app->put('/api/event/{id}',"TheoGuerin\ApiController\EventController::putEventAction");
$app->delete('/api/event/{id}',"TheoGuerin\ApiController\EventController::deleteEventAction");

// Image
$app->post('/api/images',"TheoGuerin\ApiController\ImageController::postImageAction");
$app->get('/api/images/categories',"TheoGuerin\ApiController\ImageController::getImageCategoryAction");
$app->get('/api/images/category/{catergoryName}',"TheoGuerin\ApiController\ImageController::getCategoryAction");

// Proposal
$app->get('/api/proposal',"TheoGuerin\ApiController\ProposalController::getAllProposalAction");
$app->post('/api/proposal',"TheoGuerin\ApiController\ProposalController::postProposalAction");
$app->delete('/api/proposal/{id}',"TheoGuerin\ApiController\ProposalController::deleteProposalAction");

// Contact
$app->get('/api/contact',"TheoGuerin\ApiController\ContactController::getAllContactAction");
$app->post('/api/contact',"TheoGuerin\ApiController\ContactController::postContactAction");
$app->delete('/api/contact/{id}',"TheoGuerin\ApiController\ContactController::deleteContactAction");
