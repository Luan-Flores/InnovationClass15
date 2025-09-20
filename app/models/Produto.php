<?php
require_once "../config/database.php";
class Produto {
    private $pdo; 
    
    public function __construct() {
        $this->pdo = Banco::connect();
    }
    
    //optei por nao fazer tratamentos de exceçao muito robustos visto que a complexidade do projeto é baixa

    public function adicionar($nome, $categoria, $quantidade, $preco, $sku, $fornecedor, $descricao) {
        try {
            $sql = "INSERT INTO produtos (nome, categoria, quantidade, preco, sku, fornecedor, descricao) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            
            $params = [$nome, $categoria, $quantidade, $preco, $sku, $fornecedor, $descricao];
            
            // retorna true se a execução for bem-sucedida
            return $stmt->execute($params);

        } catch (PDOException $e) {
            // se houver erro, exibe a mensagem e retorna false
            echo "Erro ao adicionar o produto: " . $e->getMessage();
            return false;
        }
    }
    public function listarTodos() {
        try{
            
            $sql = "SELECT * FROM produtos";
            
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $dados;

        }catch (PDOException $e){
            echo "Erro ao listar produtos: " . $e->getMessage();
            return false;
        }
    }
    public function editar($id, $dados) {
        try{
            $sql = "UPDATE produtos SET nome = ?, categoria = ?, quantidade = ?, preco = ?, sku = ?, fornecedor = ?, descricao = ?  WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $params = [$dados['nome'], $dados['categoria'], $dados['quantidade'], $dados['preco'], $dados['sku'], $dados['fornecedor'], $dados['descricao'], $id];
            return $stmt->execute($params);
        }catch (PDOException $e){
            echo "Erro ao editar produtos: " . $e->getMessage();
            return false;
        }
    }

    public function remover($id) {
        try{
            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return true;

        }catch (PDOException $e){
            echo "Erro ao listar produtos: " . $e->getMessage();
            return false;
        }
    }

}