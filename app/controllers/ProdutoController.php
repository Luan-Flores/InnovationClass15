<?php
require_once "../models/Produto.php";

class ProdutoController {
    public function index() {
        $prod = new Produto;
        $produtos = $prod->listarTodos();

        require "../views/estoque.php"; // view que mostra a tabela com os produtos
        
    }
}
//roteando o usuario logado para a pagina estoque.php, para carregar os produtos e mostrar na grid quando ele logar
if (isset($_GET['action'])) {
    $controller = new ProdutoController();

    if ($_GET['action'] === 'index') {
        $controller->index();
    }
}
