<?php
session_start();
require_once "../models/Produto.php";

class ProdutoController {
    public function index() {
        $prod = new Produto;
        $produtos = $prod->listarTodos();
        
        require "../views/estoque.php"; // view que mostra a tabela com os produtos
    }
    public function adicionar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nome = $_POST['nome'] ?? '';
            $sku = $_POST['sku'] ?? '';
            $categoria = $_POST['categoria'] ?? '';
            $preco = $_POST['preco'] ?? 0;
            $quantidade = $_POST['quantidade'] ?? 0;
            $fornecedor = $_POST['fornecedor'] ?? '';
            $descricao = $_POST['descricao'] ?? '';

            $prod = new Produto;
          
            $prod->adicionar($nome,
                $categoria,
                $quantidade,
                $preco,
                $sku,
                $fornecedor,
                $descricao
            );
            
            header("Location: ProdutoController.php?action=index");
            exit;
        }
    }
    public function remover(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'] ?? $_GET['id'] ?? null;
            if ($id){
                $prod = new Produto;
                $ok = $prod->remover($id);

                header('Content-type: application/json');
                echo json_encode(['success' => $ok]);
                exit;
            }else{
                header('Content-type: application/json');
                echo json_encode(['success' => false, 'error' => "Id inválido"]);
                exit;
            }
        }
    }
}

if (isset($_GET['action'])) {
    
    $controller = new ProdutoController();
    
    //roteando o usuario logado para a pagina estoque.php, para carregar os produtos e mostrar na grid quando ele logar
    if ($_GET['action'] === 'index') {
        $controller->index();
    }
    if ($_GET['action'] === 'add'){
        $controller->adicionar();
    }
    if ($_GET['action'] === 'delete'){       
        $controller->remover();
    }
}
