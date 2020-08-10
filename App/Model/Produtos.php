<?php

namespace App\Model;

class Produtos extends \App\Model\Bd {

    public function listarProdutos(){
        
        $query = "SELECT  * from produtos inner join fornecedores 
        on produtos.id_fornecedor = fornecedores.id_fornecedor";

        $stmt = $this->conexao->prepare($query);     
        $stmt->execute();
        $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $produtos;
    }

    private function idFornecedor($dados){
       
        $query = "SELECT (id_fornecedor) from fornecedores where nome_fornecedor = :fornecedor";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":fornecedor", $dados['fornecedor']); 
        $stmt->execute();
        $id_fornecedor = $stmt->fetch(\PDO::FETCH_ASSOC)['id_fornecedor'];
      
        return $id_fornecedor;
    }      

    public function cadastrarProduto($dados){
        
        $id_fornecedor = $this->idFornecedor($dados);
 
        $query = "INSERT INTO produtos (nome, preco, id_fornecedor, descricao, imagem) 
        values (:NOME, :PRECO, :ID_FORNECEDOR, :DESCRICAO, :IMAGEM)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $dados['nome']);
        $stmt->bindValue(":PRECO", $dados['preco']);
        $stmt->bindValue(":ID_FORNECEDOR",$id_fornecedor);
        $stmt->bindValue(":DESCRICAO",$dados['descricao']);
        $stmt->bindValue(":IMAGEM", $dados['imagem']);
    
        $stmt->execute();    
        
    }

    public function editarProduto($produto){

        $query = "UPDATE produtos
        SET nome = :NOME,
        preco = :PRECO,
        id_fornecedor = :FORNECEDOR,
        descricao = :DESCRICAO,
        imagem = :IMAGEM
        WHERE id = :ID";
        $id_fornecedor = $this->idFornecedor($produto);
      
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $produto['nome']);
        $stmt->bindValue(":PRECO", $produto['preco']);
        $stmt->bindValue(":FORNECEDOR", $id_fornecedor);
        $stmt->bindValue(":DESCRICAO", $produto['descricao']);
        $stmt->bindValue(":IMAGEM", $produto['imagem']);
        $stmt->bindValue(":ID", $produto['id']);

        $stmt->execute();
    }
        
    public function excluirProduto($id){
        $query = " DELETE FROM produtos
        WHERE id=:ID";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":ID", $id);
        $stmt->execute();
     }

     public function getFornecedores(){
   
        $query = "SELECT * FROM fornecedores";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function recuperaProdutoId($id){
        
        $query = "SELECT  * from produtos inner join fornecedores 
        on produtos.id_fornecedor = fornecedores.id_fornecedor where id=:ID";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":ID", $id);
        $stmt->execute();
        $produto = $stmt->fetch(\PDO::FETCH_ASSOC);
 
        return $produto;
    }
}
