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



$app["hydrator"] = function () {
    return new TheoGuerin\Service\Hydrator();
};

// === DAOS ===
require_once __DIR__.'/daos.php';
