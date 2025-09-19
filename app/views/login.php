<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['usuario'])) {
    header("Location: ./estoque.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFStock</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="shortcut icon" href="../../public/imagens/stockLogo.png" type="image/x-icon">
</head>
<body>
    <section id="mainSec">
        <div class="top">
            <div class="top1">
                <img src="../../public/imagens/stockLogo.png" alt="">
                <h1>LFStock Gerenciador de Estoque</h1>
            </div>
            <p>Acesse sua conta para gerenciar o estoque</p>
        </div>
        <div class="middle">
            <form action="../controllers/AuthController.php?action=login" method="POST" id="login">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="nomedousuario" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <button type="submit" class="btn-login">
                Entrar
                </button>

                 <!-- exibir mensagem de erro condicional -->
                <?php if (isset($_SESSION['erro'])):   ?>
                     <div id="error-message">
                        <p><?php echo $_SESSION['erro'] ?></p>
                    </div>
                    <?php  unset($_SESSION['erro'])?>
                <?php endif; ?>
                
               
                <p class="forgot-password">
                Esqueceu sua senha? Contate o administrador.
                </p>
            </form>
        </div>
    </section>

</body>
</html>