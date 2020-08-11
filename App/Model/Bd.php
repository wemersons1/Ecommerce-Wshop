<?php

namespace App\Model;

class Bd{
    const USER = "root";
    const PASS = "root";
    protected $conexao;

    public function __construct(){

        try{
            $this->conexao = new \PDO("mysql:host=localhost;dbname=loja", self::USER, self::PASS);
            
        }catch(\PDOException $e){
            
            echo "Erro ao conectar no banco";
        }
    
    }
   
}