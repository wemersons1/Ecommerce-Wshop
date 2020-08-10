<?php

namespace App\Model;

class Fornecedores extends \App\Model\Bd{

    public function listarFornecedores(){
        
        $query = "SELECT  * from fornecedores";
        $stmt = $this->conexao->prepare($query);     
        $stmt->execute();
        $fornecedores = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $fornecedores;
    }

    public function salvarFornecedor($dados){

        $query = "INSERT INTO fornecedores (nome_fornecedor, logo, descricao_fornecedor, site) values (:NOME, :LOGO, :DESCRICAO, :SITE)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $dados['nome']);
        $stmt->bindValue(":LOGO", $dados['logo']);
        $stmt->bindValue(":DESCRICAO", $dados['descricao']);
        $stmt->bindValue(":SITE", $dados['site']);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo "Erro ao salvar cadastro!";
        }      

    }

    public function exibirProdutosId($id){
       
        $query = "SELECT * FROM produtos WHERE id_fornecedor = :ID";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":ID", $id);
        $stmt->execute();
        $produtos =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        return $produtos;
    }
   
    public function carregarFornecedor($id){
        
        $stmt = "SELECT * FROM fornecedores where id_fornecedor = :ID";
        $stmt = $this->conexao->prepare($stmt);
        $stmt->bindValue(":ID", $id);
        $stmt->execute();
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $dados; 
    }

    public function editarFornecedor($dados){
  
        $query = "UPDATE fornecedores SET 
        nome_fornecedor = :NOME_FORNECEDOR,
        site = :SITE,
        descricao_fornecedor = :DESCRICAO,
        logo = :IMAGEM
        WHERE id_fornecedor = :ID_FORNECEDOR";
        
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME_FORNECEDOR", $dados['nome_fornecedor']);
        $stmt->bindValue(":SITE", $dados['site']);
        $stmt->bindValue(":DESCRICAO", $dados['descricao']);
        $stmt->bindValue(":IMAGEM", $dados['imagem']);
        $stmt->bindValue(":ID_FORNECEDOR", $dados['id_fornecedor']); 
        $stmt->execute();
    }

    public function excluirFornecedor($id){

        $query = "DELETE FROM produtos where id_fornecedor = :ID";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":ID",$id);
        $stmt->execute();
        
        $query = "DELETE FROM fornecedores where id_fornecedor = :ID";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":ID", $id);
        $stmt->execute();
    
    }
      
}

