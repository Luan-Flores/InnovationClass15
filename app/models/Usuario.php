<?php
require_once '../config/database.php';

class Usuario {
    //optei por nao abrir conexao a cada funcao, e sim a cada chamada da classe, para evitar repetiçao de codigo
    private $pdo; 
    public function __construct()
    {
        $this->pdo = Banco::connect();
    }
    //funcao autenticar o usuario (confere se user e senha constam no banco de dados)
    public function autenticar($usuario, $senha) {
        
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($senha);
        // var_dump($user['senha']);
        //debugando para ver se esta correto
        
        // em um projeto real, seria ideal usar o password_verify para senhas salvas com password_hash() 
        // porém para usuario pré-definido apenas para o teste técnico (sem cadastro), optei por nao usar
        if ($user && $senha == $user['senha']) {
          
            return $user; // retorna os dados desse usuario
        }
        return false;
    }
}
