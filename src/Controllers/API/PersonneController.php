<?php

namespace TheoGuerin\Controllers\API;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use TheoGuerin\Models\Personne;

class PersonneController{

    public function getAllAction(Application $app){
        $personnes = $app["dao.Personne"]->getAll();
        return $app->json($personnes);
    }

    public function getOneByIdAction(Application $app,$id){
        $personne = $app["dao.Personne"]->getOneById($id);
        return $app->json($personne);
    }

    public function createAction(Request $request, Application $app){
        $personne = new Personne();
        foreach (Personne::getFields() as $field) {
            $function = "set".ucfirst($field);
            $personne->$function($request->request->get($field));
        }
        $personne = $app["dao.Personne"]->saveObject($personne);
        return $app->json($personne);
    }

}
