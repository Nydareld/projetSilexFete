<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/config/config.php';

$app["debug"] = true;


$app->before(function(Request $request){
    if(0 === strpos($request->headers->get('Content-Type'),'application/json')){
        $data = json_decode($request->getContent(),true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

//  === doctrine orm ===
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src/Model"), $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);
