<?php

namespace App\classes;

class Auxiliar{

    public function moverImagem($arr){
        $temp = $arr['tmp_name'];
        $pasta = "imagens";

        if(!is_dir($pasta)){
            mkdir($pasta, 0777);       
        }
        
        $caminhoSalvar = $pasta.DIRECTORY_SEPARATOR.$arr['name'];
        
        if(!move_uploaded_file($temp, $caminhoSalvar)){
            throw new Exception("Não foi possível cadastrar!, tente novamente mais tarde");
        }
        return $caminhoSalvar;
    }

    public static function render($local, $var=null, $var2=null){

        $caminho = "../App/View".$local.".phtml";

        require_once "../App/View/layout.phtml";
    }

}

