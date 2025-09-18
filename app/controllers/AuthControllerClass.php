<?php
session_start();
require_once "../models/Usuario.php";

class AuthController {
    public function login() {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuario = $_POST['usuario'];
            $senha   = $_POST['senha'];
            
            $user = new Usuario;
            $user_dados = $user->autenticar($usuario, $senha);
            
            if ($user_dados) {
                $_SESSION['usuario'] = $user_dados['usuario']; 
                header("Location: ../controllers/ProdutoController.php?action=index");
                exit;
            } else {
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
