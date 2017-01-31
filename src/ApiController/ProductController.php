<?php

namespace TheoGuerin\ApiController;

use TheoGuerin\Model\Product;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use TheoGuerin\Model\Event;
use \Datetime;


class ProductController{

    public function getAllProductAction(Request $req, Application $app)
    {
        $products = $app["dao.product"]->getAll();
        return $app->json( array(
            'success' => true,
            'count' => count($products),
            'data' => $products
        ),200);
    }

    public function getProductAction(Request $req, Application $app, $id){
        $product = $app["dao.product"]->getOneById($id);
        if ($product === null){
            return $app->json( array(
                'success' => false,
                'details' => 'product not found',
            ),404);
        }else{
            return $app->json( array(
                'success' => true,
                'count' => count($product),
                'data' => $product
            ),200);
        }
    }

    public function postProductAction(Request $req, Application $app)
    {
        $product = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Product');

        if(gettype($product) == 'string'){
            return $app->json( array(
                'success' => false,
                'details' => $product
            ),400);
        }
        if($req->request->get('images') !== null){
            foreach ($req->request->get('images') as $imagePost) {
                $image = $app["dao.image"]->getOneById($imagePost['id']);
                if($image !== null){
                    $product->addImage($image);
                }
            }
        }
        $app['dao.product']->save($product);

        return $app->json( array(
        'success' => true,
        'count' => 1,
        'data' => $product
        ),201);
    }

    public function putProductAction(Request $req, Application $app, $id){
        $product = $app["dao.product"]->getOneById($id);
        if ($product === null){
            return $app->json( array(
            'success' => false,
            'details' => 'product not found',
            ),404);
        } else {
            $product = $app['hydrator']->update($req->request->all(),$product,'TheoGuerin\Model\Product');
            if($req->request->get('images') !== null){
                $product->clearImages();
                foreach ($req->request->get('images') as $imagePost) {
                    $image = $app["dao.image"]->getOneById($imagePost['id']);
                    if($image !== null){
                        $product->addImage($image);
                    }
                }
            }
            $app['dao.product']->save($product);
            return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $product
            ),200);
        }

        $app['dao.product']->save($product);

        return $app->json( array(
        'success' => true,
        'count' => 1,
        'data' => $product
        ),201);
    }

    public function deleteProductAction(Request $req, Application $app,$id){
        $product = $app["dao.product"]->getOneById($id);
        if ($product === null){
            return $app->json( array(
            'success' => false,
            'details' => 'product not found',
            ),404);
        } else {
            $app['dao.product']->remove($product);
            return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $product
            ),200);
        }
    }

    public function postCommentAction(Request $req, Application $app,$id)
    {
        $product = $app["dao.product"]->getOneById($id);


        if ($product === null){
            return $app->json( array(
            'success' => false,
            'details' => 'product not found',
            ),404);
        }

        $comment = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Comment');

        if(gettype($comment) == 'string'){
            return $app->json( array(
            'success' => false,
            'details' => $comment
            ),400);
        }

        $comment->setProduct($product);

        $app['dao.comment']->save($comment);
        return $app->json( array(
        'success' => true,
        'count' => 1,
        'data' => $app["dao.product"]->getOneById($id)
        ),201);
    }

    public function postLocationAction(Request $req, Application $app,$id){
        $product = $app["dao.product"]->getOneById($id);

        if ($product === null){
            return $app->json( array(
            'success' => false,
            'details' => 'product not found',
            ),404);
        }

        $location = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Location');

        if(gettype($location) == 'string'){
            return $app->json( array(
            'success' => false,
            'details' => $location
            ),400);
        }

        $debutLocation = new Event();
        $finLocation   = new Event();
        $debutLocation->setDate(new Datetime($req->request->get('debutLocation')));
        $debutLocation->setName("debut location produit ".$product->getId());

        $finLocation->setDate(new Datetime($req->request->get('finLocation')));
        $finLocation->setName("fin location produit ".$product->getId());

        $app['dao.event']->save($debutLocation);
        $app['dao.event']->save($finLocation);

        $location->setDebutLocation($debutLocation);
        $location->setFinLocation($finLocation);
        $location->setProduct($product);


        $app['dao.location']->save($location);
        return $app->json( array(
        'success' => true,
        'count' => 1,
        'data' => $app["dao.product"]->getOneById($id)
        ),201);
    }

}
