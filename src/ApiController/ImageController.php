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
        return $app["views"]->success($res);
    }

    public function getCategoryAction(Request $req, Application $app, $catergoryName)
    {
        $images = $app['dao.image']->findBy(array( 'category' => $catergoryName ), array() );
        return $app["views"]->success($images);
    }

    public function postImageAction(Request $req, Application $app)
    {

        $image = $app['hydrator']->hydrate($req->request->all(),'TheoGuerin\Model\Image');

        if(gettype($image) == 'string'){
            return $app["views"]->error($image);
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
            return $app["views"]->error("missing file or external url");
        }
        $app['dao.image']->save($image);
        return $app["views"]->success($image,201);
    }

}
