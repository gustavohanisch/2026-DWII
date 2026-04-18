<?php

$nome        = "Gustavo Alves Hanisch";
$profissao   = "Estudante de Tecnologia";
$curso       = "Técnico em Informática — IFPR";

$titulo_pagina = 'Início';
$caminho_raiz = '../';
$pagina_atual = '';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio — <?php echo $nome; ?></title>
<?php require_once __DIR__ . '../../includes/cabecalho.php'; ?>

</head>

<body>



<div class="hero">
    <h1><?php echo $nome; ?></h1>
    <p><?php echo $profissao; ?> | <?php echo $curso; ?></p>
</div>

<div class="container">
    <h2>Bem-vindo ao meu portfólio</h2>
    <p>Esta página foi gerada pelo PHP em:
        <strong><?php echo date("02/03/2026 \à\s 17:30:30"); ?></strong></p>
</div>

<footer>
    <?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</footer>

</body>
</html>