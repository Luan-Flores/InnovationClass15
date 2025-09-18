<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFStock</title>
    <link rel="stylesheet" href="../../public/css/estoque.css">
</head>
<body>
    <header>
        <div class="hdr1">
            <img src="../../public/imagens/stockLogo.png" alt="Logo">
            <h2>LFStock Gerenciamento de Estoque</h2>
        </div>
        <div class="hdr2">
            <div class="connect">
                <img src="../../public/imagens/connected.png" alt="Conectado">
                <p>Conectado</p>
            </div>
            <div class="logout">
                <a href="../controllers/AuthController.php?action=logout">
                    <img src="../../public/imagens/logout.png" alt="Sair">
                    <p>Sair</p>
                </a>
                </div>

        </div>
    </header>
</body>
</html>