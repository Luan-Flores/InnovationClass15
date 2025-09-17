<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFStock</title>
    <link rel="stylesheet" href="../../public/css/login.css">
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
            <form action="#" method="post" id="login">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" placeholder="nomedousuario" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" placeholder="••••••••" required>

                <button type="submit" class="btn-login">
                Entrar
                </button>

                <!-- Mensagem de erro condicional -->
                <div id="error-message">
                Credenciais inválidas. Verifique usuário e senha.
                </div>

                <p class="forgot-password">
                Esqueceu sua senha? Contate o administrador.
                </p>
            </form>
        </div>
    </section>
    <script src="../../public/js/login.js"></script>
</body>
</html>