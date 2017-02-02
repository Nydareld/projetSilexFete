<?php

namespace TheoGuerin\ApiController;

use TheoGuerin\Model\Event;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class EventController{

    public function getAllEventAction(Request $req, Application $app)
    {
        $events = $app["dao.event"]->getAll();
        return $app["views"]->success($events);
    }

    public function getEventAction(Request $req, Application $app, $id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app["views"]->error('Event not found',404);
        }else{
            return $app["views"]->success($event);
        }
    }

    public function postEventAction(Request $req, Application $app)
    {
        $event = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Event');

        if(gettype($event) == 'string'){
            return $app["views"]->error($event);
        }
        $app['dao.event']->save($event);
        return $app["views"]->success($event,201);
    }

    public function putEventAction(Request $req, Application $app, $id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app["views"]->error('Event not found',404);
        } else {
            $event = $app['hydrator']->update($req->request->all(),$event,'TheoGuerin\Model\Event');
            $app['dao.event']->save($event);
            return $app["views"]->success($event);
        }
    }

    public function deleteEventAction(Request $req, Application $app,$id){
        $event = $app["dao.event"]->getOneById($id);
        if ($event === null){
            return $app["views"]->error('Event not found',404);
        } else {
            $app['dao.event']->remove($event);
            return $app["views"]->success($event);
        }
    }

}
