<?php

namespace TheoGuerin\Controllers;

use Silex\Application;

class HomeController{
    public function indexAction(Application $app){
        return "ca marche";
    }
    public function helloAction(Application $app, $name){
        return "Bonjour $name";
    }
}
