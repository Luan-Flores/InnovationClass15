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
                <a id="sair" href="../controllers/AuthController.php?action=logout">
                    <img src="../../public/imagens/logout.png" alt="Sair">
                    <p>Sair</p>
                </a>
                </div>
        </div>
    </header>

    <div class="produtos-header">
        <h1>Produtos</h1>
        <div class="right">
            <div class="search-container">
                <input type="text" placeholder="Buscar por nome...">
            </div>
            <button class="add-button">Adicionar Produto</button>
        </div>
    </div>
    <section class="middle">

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
        </thead>
        <tbody>
            <?php if (!empty($produtos)): ?>
                
                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['quantidade']) ?></td>
                        <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                        <td>
                            <a class="btn-editar" href="../controllers/ProdutoController.php?action=editar&id=<?= $p['id'] ?>">Editar</a>
                            <a class="btn-excluir" href="../controllers/ProdutoController.php?action=excluir&id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Nenhum produto encontrado</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <section class="modalCadBox">
                <div class="modalCad">
                    <div class="cadHead">
                        <h1>Adicionar Produto</h1>
                        <button class="btn-close">
                            <img src="../../public/imagens/addIcon.png" alt="">
                        </button>
                    </div>
                    <div class="cadMiddle">
                        <form action="" method="post">
                            <label for="Nome">Nome do Produto</label>
                            <input type="text" name="nome">
                            <div class="form-mid">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku">
                                <label for="categoria">Categoria</label>
                                <input type="text" name="categoria">
                                <label for="preco">Preço</label>
                                <input type="text" name="preco">
                                <label for="estoque">Quantidade em Estoque</label>
                                <input type="text" name="quantidade">
                            </div>
                            <label for="fornecedor">Fornecedor</label>
                            <input type="text" name="fornecedor">
                            <label for="descricao">Descrição</label>
                            <input type="text" name="descricao">
                            <p>Inclua informações como material, dimensões ou cuidados.</p>
                        </form>
                    </div>
                    <div class="cadEnd">
                        <button>Limpar</button>
                        <button>Cancelar</button>
                        <button>Salvar produto</button>
                    </div>
                </div>
            </section>

</body>
</html>