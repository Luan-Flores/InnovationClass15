<?php
session_start();

// se não existir sessão de usuário, bloqueia o acesso
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // redireciona para a tela de login
    exit;
}
session_start();
require_once "../models/Produto.php";

class ProdutoController {
    public function index() {
    
        session_start();

        // bloqueia usuario sem login
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: login.php"); 
            exit;
        }

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
    public function editar(){
        if ($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $id = $_GET['id'] ?? null;

            // pegar o JSON cru e transformar em array
            $json = file_get_contents('php://input'); //veio no body da requisiçao
            $dados = json_decode($json, true); //pega os dados em json e transforma em um objeto associativo para o php manipular

            if ($id && $dados){
                $prod = new Produto;
                $ok = $prod->editar($id, $dados);

                header('Content-Type: application/json');
                echo json_encode(['success' => $ok]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => "Id ou dados inválidos"]);
                exit;
            }
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
    if ($_GET['action'] === 'edit'){       
        $controller->editar();
    }
    if ($_GET['action'] === 'delete'){       
        $controller->remover();
    }
}
