<?php

namespace App\Controller;

class Api{

    public function listaDeProdutos(){

        $bd = new \App\Model\Bd();
        $produtos = $bd-> listarDados("produtos");
       
            $nome = json_encode($produtos);
     
        echo $nome;
        return json_encode($produtos);
    }
}