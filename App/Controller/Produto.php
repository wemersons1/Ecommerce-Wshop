<?php

namespace App\Controller;
use \App\Classes\Auxiliar;

class Produto{

    public function listarAction(){
        
        $produto = new \App\Model\Produtos();
    
        $produtos = $produto->listarProdutos();    
        $num_registros = count($produtos);
        if($num_registros>0){
            Auxiliar::render("/produtos/listarprodutos", $produtos);
    
        }
        else{
            Auxiliar::render("/semregistro", $produtos);
    
        }
    }

    public function cadastrarAction(){
        $produtos = new \App\Model\Produtos();
        $fornecedores = $produtos->getFornecedores();

        Auxiliar::render("/produtos/cadastrarproduto", $fornecedores);
    } 

    public function salvarAction(){
        
        $produto = new \App\Model\Produtos();
        $dados = $_POST;
        $Imagem = new \App\Classes\Auxiliar();
        $caminhoImagem = $Imagem->moverImagem($_FILES['imagem']);
        $dados['imagem'] = $caminhoImagem;

        $produto->cadastrarProduto($dados);

        Auxiliar::render("/produtos/sucesso");
    }

    public function exibirAction(){
        $produto = new \App\Model\Produtos();
        $id = $_GET['id'];
        $produto = $produto->recuperaProdutoId($id);  
       
        Auxiliar::render("/produtos/exibirproduto", $produto);

    }

    public function editarAction(){

        $bd = new \App\Model\Produtos();
        $id_produto = $_GET['id'];
        $produto = $bd->recuperaProdutoId($id_produto);
        $fornecedores = $bd->getFornecedores();

        $produto['id'] = $id_produto;
        Auxiliar::render("/produtos/editarproduto", $produto, $fornecedores);
    }

    public function editarFinalizadoAction(){
        $bd = new \App\Model\Produtos();
        $produto = $_POST;
        $Imagem = new \App\Classes\Auxiliar();
        $caminhoImagem = $Imagem->moverImagem($_FILES['imagem']);

        $produto['imagem'] = $caminhoImagem;

        $bd->editarProduto($produto);

        Auxiliar::render("/produtos/sucesso");
    }
    
    public function excluirAction(){
        $id = $_GET['id'];
        
        $bd = new \App\Model\Produtos();
        $bd->excluirProduto($id);

        Auxiliar::render("/produtos/sucesso");
    }

}