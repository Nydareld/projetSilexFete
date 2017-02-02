<?php

namespace TheoGuerin\Service;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Views{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    public function success($data,$statusCode = 200){
        return $this->app->json( array(
            'success' => true,
            'count' => count($data),
            'data' => $data
        ),$statusCode);
    }

    public function error($message,$statusCode=400){
        return $this->app->json( array(
            'success' => false,
            'details' => $message
        ),$statusCode);
    }
}
