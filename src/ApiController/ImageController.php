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

        if(!$file){
            return $app->json( array(
                'success' => false,
                'details' => "missing file"
            ),400);
        }
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $folder = $this->uploadDir.'/'.$category;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $file->move(
            $folder,
            $fileName
        );
        $image->setPath($req->getHttpHost()."/".$this->baseUri."/".$category."/".$fileName);
        $app['dao.image']->save($image);

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $image
        ),201);
    }

}
