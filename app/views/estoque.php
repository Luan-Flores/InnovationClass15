<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
                <!-- looping no array com os produtos que vem do banco de dados, iteramos sobre eles e exibimos na GRID cada um -->
                <?php if (!empty($produtos)): ?>    
                    <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['quantidade']) ?></td>
                        <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                        <td>
                            <button class="btn-editar"></button>
                            <!-- ainda no loop, passamos como atributo para o botao editar os valores dos produtos, para exibir no modal de edição as informações dinamicamente -->
                            <button data-id="<?= $p['id'] ?>" 
                                data-nome="<?= htmlspecialchars($p['nome']) ?>" 
                                data-sku="<?= htmlspecialchars($p['sku']) ?>" 
                                data-quantidade="<?= htmlspecialchars($p['quantidade']) ?>" 
                                data-preco="<?= number_format($p['preco'], 2, ',', '.') ?>" 
                                class="btn-excluir" >Excluir
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Nenhum produto encontrado</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <section class="modalCadBox hidden">
                <div class="modalCad">
                    <div class="cadHead">
                        <h1>Adicionar Produto</h1>
                        <button class="btn-close">
                            <img src="../../public/imagens/close.png" alt="">
                        </button>
                    </div>
                    <div class="cadMiddle">
                        <form class="formModel" id="formModel" action="../controllers/ProdutoController.php?action=add" method="post">
                            <!-- required em todos os input, como são poucas informaçoes, optei por deixar obrigatório, também segue a estrutura do banco (NOT NULL) -->
                            <label for="Nome">Nome do Produto</label>
                            <input type="text" name="nome" required>
                            <div class="form-mid">
                                <div class="form-mid-1">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" required>
                                    <label for="categoria">Categoria</label>
                                    <input type="text" name="categoria" required>
                                </div>
                                <div class="form-mid-2">
                                    <label for="preco">Preço</label>
                                    <input type="text" name="preco" required>
                                    <label for="estoque">Quantidade em Estoque</label>
                                    <input type="text" name="quantidade" required>
                                </div>
                            </div>
                            <label for="fornecedor">Fornecedor</label>
                            <input type="text" name="fornecedor">
                            <label for="descricao">Descrição</label>
                            <textarea type="text" id="inputDesc" name="descricao"></textarea>
                            <p id="p-desc">Inclua informações como material, dimensões ou cuidados.</p>
                        </form>
                    </div>
                    <div class="cadEnd">
                        <button id="btn-limpar">Limpar</button>
                        <button id="btn-cancelar">Cancelar</button>
                        <button form="formModel" id="btn-salvar" type="submit">Salvar produto</button>
                    </div>
                </div>
            </section>
            <section class="modalDelBox hidden">
                <div class="modalDel">
                    <div class="delHead">
                        <h1>Excluir  Produto</h1>
                        <button class="btn-del-close">
                            <img src="../../public/imagens/close.png" alt="">
                        </button>
                    </div>
                    <div class="delMiddle">
                        <p id="certeza">
                            Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.
                        </p>
                        <div class="infoProd">
                            <div>
                                <p>Produto</p>
                                <p id="nomeProd">Nome do Produto</p>
                            </div>
                            <div>
                                <p>Estoque</p>
                                <p id="qtdProd">100 Unidades</p>
                            </div>
                            <div>
                                <p>SKU</p>
                                <p id="skuProd">ABC-221</p>
                            </div>
                            <div>
                                <p>Preço</p>
                                <p id="precoProd">R$99,90</p>
                            </div>
                        </div>
                        <div class="permaAviso">
                            <p>Essa é uma ação permanente!</p>
                        </div>
                    </div>
                    <div class="delEnd">
                        <button class="btn-del-cancel">Cancelar</button>
                        <button class="btn-del-excluir">Excluir Produto</button>
                    </div>
                </div>
            </section>
            
            <script src="../../public/js/estoque.js"></script>
        </body>
        </html>