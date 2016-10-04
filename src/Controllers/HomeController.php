<?php

namespace TheoGuerin\Controllers;

class HomeController{
    public function indexAction(){
        return "ca marche";
    }
    public function helloAction($name){
        return "Bonjour $name";
    }
}
