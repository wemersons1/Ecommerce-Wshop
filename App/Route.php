<?php
namespace App;

class Route{

    private $rotas;

    public function __construct(){
        $this->run();
    
    }

    private function rotas(){

        $rotas['home'] = ['rota' => '/', 'controller' => 'index', 'action' => 'indexAction'];
        $rotas['listar-produtos'] = ["rota" => '/listarprodutos', "controller" => "produto", "action" => "listarAction"];
        
        $rotas['listar-fornecedores'] = ["rota" => '/listarfornecedores', "controller" => "fornecedor", "action" => "listarAction"];

        $rotas['cadastrar-produto'] = ["rota" => '/cadastrarproduto', "controller" => "produto", "action" => "cadastrarAction"];
        $rotas['cadastrar-fornecedor'] = ["rota" => '/cadastrarfornecedor', "controller" => "fornecedor", "action" => "cadastrarAction"];
        
        $rotas['salvar-produto'] = ["rota" => '/salvarproduto', "controller" => "produto", "action" => "salvarAction"];
        $rotas['salvar-fornecedor'] = ["rota" => '/salvarfornecedor', "controller" => "fornecedor", "action" => "salvarAction"];
        
        $rotas['exibir-produto'] = ["rota" => '/produto', "controller" => "produto", "action" => "exibirAction"];
       
        $rotas['editar'] = ["rota" =>"/editar", "controller" => "produto", "action"=> "editarAction"];
        $rotas['editar-produto'] = ["rota" =>"/editarproduto", "controller" => "produto", "action"=> "editarFinalizadoAction"];

        $rotas['excluir'] = ["rota" =>"/excluir", "controller" => "produto", "action"=> "excluirAction"];
        $rotas['produtos-fornecedor'] = ['rota' =>"/fornecedores/todosprodutos", "controller" => "fornecedor", "action" =>'todosProdutosAction'];

        $rotas['editar-view'] = ["rota" =>"/fornecedor/editar", "controller" => "fornecedor", "action"=> "editarViewAction"];
        
        $rotas['editar-fornecedor'] = ["rota" =>"/fornecedores/editarfornecedor", "controller" => "fornecedor", "action"=> "editarFornecedorAction"];
        
        $rotas['excluir-fornecedor'] = ["rota" =>"/fornecedor/excluir", "controller" => "fornecedor", "action"=> "excluirFornecedorAction"];
    
        $rotas['api'] = ["rota" =>"/api/v1/listadeprodutos", "controller" => "api", "action"=> "listaDeProdutos"];

        $this->setRotas($rotas);
    }

    private function setRotas($rotas){
        $this->rotas = $rotas;
    }

    private function getRota(){
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);    
        return $url;
    }

    private function run(){
        $rota = $this->getRota();
        $this->rotas(); // A variável privada rota foi setada
        
        foreach($this->rotas as $key => $value){
            if($rota === $value['rota']){
                
                $class = "\\App\\Controller\\";
                
                $class .=ucfirst($value['controller']);
             
                $controller = new $class();
                $acao = $value['action'];
                $controller->$acao();
            }
        }
    }

   
}