<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/config/config.php';

$app["debug"] = true;


// === Milldleware d'entrée ===
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

//  === doctrine orm ===
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Model"), $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);


// === Hydrateur d'objets ===
$app["hydrator"] = function () {
    return new TheoGuerin\Service\Hydrator();
};

// === Hydrateur d'objets ===
$app["querryparam"] = function ($app) {
    return new TheoGuerin\Service\QuerryParam($app['request_stack']->getCurrentRequest());
};

// === DAOS ===
require_once __DIR__.'/daos.php';


// === Milldleware de sortie ===
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, Authorization');
    $response->headers->set('Access-Control-Allow-Methods','GET, POST, PUT, DELETE');
});
