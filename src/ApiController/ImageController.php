<?php

namespace TheoGuerin\ApiController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class ImageController{

    public function __construct($uploadDir = __DIR__.'/../../public/images/uploads',$baseUri = 'public/images/uploads')
    {
        $this->uploadDir = $uploadDir;
        $this->baseUri = $baseUri;
    }

    public function postImageAction(Request $req, Application $app)
    {

        $index = $req->request->get('index');
        $file = $req->files->get('image');

        if(!$file){
            return $app->json( array(
                'success' => false,
                'details' => "missing file"
            ),400);
        }
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $folder = $this->uploadDir.'/'.$index;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $file->move(
            $folder,
            $fileName
        );

        return $app->json( array(
            'success' => true,
            'count' => 1,
            'data' => $req->getHttpHost()."/".$this->baseUri."/".$index."/".$fileName
        ),201);
    }

}
