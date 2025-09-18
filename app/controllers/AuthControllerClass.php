<?php
session_start();
require_once "../config/database.php";
require_once "../models/Usuario.php";

class AuthController {
    public function login() {
        $pdo = Banco::connect();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuario = $_POST['usuario'];
            $senha   = $_POST['senha'];
            
            $user = Usuario::autenticar($pdo, $usuario, $senha);
            
            if ($user) {
                $_SESSION['usuario'] = $user['usuario']; 
                header("Location: ../views/estoque.php");
                exit;
            } else {
                echo "Erro teste";
                $_SESSION['erro'] = "Credenciais inválidas. Verifique usuário e senha.";
                require "../views/login.php"; // renderiza view com erro
            }
        } else {
            require "../views/login.php"; // primeira vez que entra
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../views/login.php");
        exit;
    }
}
