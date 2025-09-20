*LFStock - Guia de Teste*
- Pré-requisitos

Antes de rodar o projeto, é necessário ter instalado:
PHP + MySQL (recomendado XAMPP, WAMP ou MAMP)
Navegador moderno (Chrome, Firefox, Edge)

*1. Baixar o projeto*

Faça download do ZIP do repositório.

Extraia a pasta *InnovationClass15-main* na pasta de projetos do servidor local:

XAMPP (Windows): C:\xampp\htdocs\InnovationClass15-main

MAMP (Mac): /Applications/MAMP/htdocs/InnovationClass15-main

Linux: /var/www/html/InnovationClass15-main

*2. Configurar o banco de dados*

Abra o phpMyAdmin (http://localhost/phpmyadmin)

Importe o arquivo esquema.sql que vem na pasta InnovationClass15-main/app/config/esquema.sql

O script já inclui:

CREATE DATABASE IF NOT EXISTS lfstock;
USE lfstock;

Assim, o banco é criado automaticamente se não existir.

Confirme que as tabelas (produtos, usuarios, etc.) foram criadas corretamente.

*3. Ajustar credenciais de conexão - (Normalmente não precisa)*

No arquivo de configuração (Produto.php ou config.php), ajuste se necessário:

$host = "localhost";

$dbname = "lfstock";

$user = "root";   // usuário do MySQL

$pass = "";       // senha do MySQL

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

*4. Rodar o sistema*

Acesse no navegador:

http://localhost/InnovationClass15-main/index.php

O index.php redireciona automaticamente para a tela de login.

Faça login com um usuário já existente no banco (ex.: criado pelo esquema.sql).

Usuário: user123

Senha: 123

Ao logar, você será redirecionado para a tela de estoque, onde poderá visualizar, adicionar, editar e excluir produtos.


