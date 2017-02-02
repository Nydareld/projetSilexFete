<?php

namespace TheoGuerin\ApiController;

use TheoGuerin\Model\Contact;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class ContactController{

    public function getAllContactAction(Request $req, Application $app)
    {
        $contact = $app["dao.contact"]->getAll();
        return $app->json( array(
            'success' => true,
            'count' => count($contact),
            'data' => $contact
        ),200);
    }


    public function postContactAction(Request $req, Application $app)
    {
        $contact = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Contact');

        if(gettype($contact) == 'string'){
            return $app->json( array(
                'success' => false,
                'details' => $contact
            ),400);
        }

        $app['dao.contact']->save($contact);

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $contact
        ),201);
    }

    public function deleteContactAction(Request $req, Application $app,$id){
        $contact = $app["dao.contact"]->getOneById($id);
        if ($contact === null){
            return $app->json( array(
                'success' => false,
                'details' => 'Contact not found',
            ),404);
        } else {
            $app['dao.contact']->remove($contact);
            return $app->json( array(
                'success' => true,
                'count' => 1,
                'data' => $contact
            ),200);
        }
    }

}
