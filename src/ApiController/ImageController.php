<?php

namespace TheoGuerin\ApiController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use TheoGuerin\Model\Image;


class ImageController{

    public function __construct($uploadDir = __DIR__.'/../../public/images/uploads',$baseUri = 'public/images/uploads')
    {
        $this->uploadDir = $uploadDir;
        $this->baseUri = $baseUri;
    }

    public function getImageCategoryAction(Request $req, Application $app)
    {
        $categories = $app['dao.image']->distinctValuesOfFied('category');
        $res = array();
        foreach ($categories as $category) {
            array_push($res,array(
                'name'=> $category['category'],
                'path'=> 'http://'.$req->getHttpHost().'/api/images/category/'.$category['category']
            ));
        }
        return $app->json( array(
            'success' => true,
            'count' => count($res),
            'data' => $res
        ),200);
    }

    public function getCategoryAction(Request $req, Application $app, $catergoryName)
    {
        $images = $app['dao.image']->findBy(array( 'category' => $catergoryName ), array() );
        return $app->json( array(
            'success' => true,
            'count' => count($images),
            'data' => $images
        ),200);
    }

    public function postImageAction(Request $req, Application $app)
    {

        $image = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Image');

        if(gettype($image) == 'string'){
            return $app->json( array(
                'success' => false,
                'details' => $image
            ),400);
        }

        $category = $image->getCategory();
        $file = $req->files->get('image');

        if($file){
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $folder = $this->uploadDir.'/'.$category;

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move(
                $folder,
                $fileName
            );
            $image->setPath("http://".$req->getHttpHost()."/".$this->baseUri."/".$category."/".$fileName);
        }elseif ($image->getPath() == null) {
            return $app->json( array(
                'success' => false,
                'details' => "missing file or external url"
            ),400);
        }
        $app['dao.image']->save($image);

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $image
        ),201);
    }

}
