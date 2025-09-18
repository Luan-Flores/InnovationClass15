<?php
class Usuario {
    //funcao autenticar o usuario (confere se user e senha constam no banco de dados)
    public static function autenticar($pdo, $usuario, $senha) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($senha);
        // var_dump($user['senha']);
        //debugando para ver se esta correto

        if ($user && $senha == $user['senha']) {
          
            return $user; // retorna os dados desse usuario
        }
        return false;
    }
}
