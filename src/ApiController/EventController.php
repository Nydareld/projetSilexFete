<?php

namespace TheoGuerin\ApiController;

use TheoGuerin\Model\Event;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class EventController{

    public function getAllEventAction(Request $req, Application $app)
    {
        $events = $app["dao.event"]->getAll();
        return $app->json( array(
            'success' => true,
            'count' => count($events),
            'data' => $events
        ),200);
    }

    public function getEventAction(Request $req, Application $app, $id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app->json( array(
                'success' => false,
                'details' => 'event not found',
            ),404);
        }else{
            return $app->json( array(
                'success' => true,
                'count' => count($event),
                'data' => $event
            ),200);
        }
    }

    public function postEventAction(Request $req, Application $app)
    {
        $event = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Event');

        if(gettype($event) == 'string'){
            return $app->json( array(
                'success' => false,
                'details' => $event
            ),400);
        }

        $app['dao.event']->save($event);

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $event
        ),201);
    }

    public function putEventAction(Request $req, Application $app, $id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app->json( array(
                'success' => false,
                'details' => 'event not found',
            ),404);
        } else {
            $event = $app['hydrator']->update($req->request->all(),$event,'TheoGuerin\Model\Event');
            $app['dao.event']->save($event);
            return $app->json( array(
                'success' => true,
                'count' => 1,
                'data' => $event
            ),200);
        }

        $app['dao.event']->save($event);

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $event
        ),201);
    }

    public function deleteEventAction(Request $req, Application $app,$id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app->json( array(
                'success' => false,
                'details' => 'event not found',
            ),404);
        } else {
            $app['dao.event']->remove($event);
            return $app->json( array(
                'success' => true,
                'count' => 1,
                'data' => $event
            ),200);
        }
    }

}
