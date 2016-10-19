<?php

namespace TheoGuerin\Controllers\API;

use Silex\Application;

class PersonneController{

    public function getAllAction(Application $app){
        $personnes = $app["dao.Personne"]->getAll();
        return $app->json($personnes);
    }

    public function getOneByIdAction(Application $app,$id){
        $personne = $app["dao.Personne"]->getOneById($id);
        return $app->json($personne);
    }

}
