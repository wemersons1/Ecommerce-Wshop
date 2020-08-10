<?php

namespace App\Controller;
use \App\Classes\Auxiliar;

class Index{

    public function indexAction(){
     
        Auxiliar::render("/produtos/index");

    }

}