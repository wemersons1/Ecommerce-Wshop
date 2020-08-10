<?php

namespace App\Controller;
use \App\Classes\Auxiliar;

class Fornecedor{

    public function listarAction(){
       
        $dados = new \App\Model\Fornecedores();
        
        $fornecedores = $dados->listarFornecedores();
        $num_registros = count($fornecedores);
        if($num_registros>0){
            Auxiliar::render("/fornecedores/listarfornecedores", $fornecedores);
        }
        else{
            Auxiliar::render("/semregistro", $produtos);
        }
    }

    public function cadastrarAction(){
     
        Auxiliar::render("/fornecedores/cadastrarfornecedor");
      
    }

    public function salvarAction(){

        $dados = $_POST;
        $imagem = new \App\Classes\Auxiliar();
        $caminhoImagem = $imagem->moverImagem($_FILES['logo']);
        $dados['logo'] = $caminhoImagem;
        $fornecedor = new \App\Model\Fornecedores();

        $fornecedor->salvarFornecedor($dados);
 
        Auxiliar::render("/produtos/sucesso");
    }

    public function todosProdutosAction(){

        $id = $_GET['id'];
        $bd = new \App\Model\Fornecedores();
        $produtos = $bd->exibirProdutosId($id);//qualquer parametro só cair em else
        if(count($produtos)>0){
            $produtos[0]['nome'] = $_GET['nome'];  
   
            Auxiliar::render("/fornecedores/exibirprodutosfornecedor", $produtos);
           
        }
        else{
            Auxiliar::render("/semregistro", $produtos);
        }
        
    }

    public function editarViewAction(){

       $id = $_GET['id'];
       $bd = new \App\Model\Fornecedores();
      
       $fornecedor = $bd->carregarFornecedor($id);
       
       Auxiliar::render("/fornecedores/editarfornecedor", $fornecedor);

    }

    public function editarFornecedorAction(){
    
        $dados = $_POST;
        $imagem = new \App\Classes\Auxiliar();
        $caminhoImagem = $imagem->moverImagem($_FILES['logo']);
        $dados['imagem'] = $caminhoImagem; 
        
        $bd = new \App\Model\Fornecedores();
        $bd->editarFornecedor($dados);

        Auxiliar::render("/produtos/sucesso");

    }

    public function excluirFornecedorAction(){
        $id = $_GET['id'];
        $bd = new \App\Model\Fornecedores();
        $bd->excluirFornecedor($id);

        Auxiliar::render("/produtos/sucesso");
    }

}