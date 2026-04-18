<?php
$nome           = "Gustavo Alves Hanisch";
$pagina_atual   = "contato";
$caminho_raiz   = "../";
$titulo_pagina  = "Contato";

$nome_visitante = '';
$mensagem       = '';
$erros          = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

if (empty($nome_visitante)) {
    $erros[] = 'O campo Nome é obrigatório.';
}

if(empty($mensagem)) {
    $erros[] = 'O campo Mensagem é obrigatório.';
} 

if (empty($erros) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    }

}
?>

<head>
<link rel="stylesheet" href="../includes/style.css">
</head>

<?php include '../includes/cabecalho.php'; ?>


<div class="container">
    <h1 class="titulo-secao">📫 Formulario de Contato</h1>

    <?php if (!empty($erros)): ?>
    <div class="alerta-erro">
        <h3>⚠️ Erro no formulário:</h3>
        <ul>
            <?php foreach ($erros as $erro): ?>
                <li><?php echo $erro; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form class="form-container" action="contato.php" method="post">

    <label>Seu nome:</label> 
    <input type="text" name="nome_visitante" value="<?php echo htmlspecialchars($nome_visitante); ?>">

    <label> Sua mensagem:</label>
    <textarea name="mensagem" rows="4"><?php echo htmlspecialchars($mensagem); ?></textarea>

    <button type="submit">Enviar</button>
     
</form>

<?php if ($nome_visitante !== ''): ?>
    <div class="alerta-sucesso" style="margin-top: 20px;">
        <h3>✅ Dados recebidos!</h3>
        <p><strong>Nome:</strong>
        <?php echo htmlspecialchars($nome_visitante); ?></p>
        <p><strong>Mensagem:</strong>
        <?php echo htmlspecialchars($mensagem); ?></p>
</div>
<?php endif; ?>
</div>



<?php include '../includes/rodape.php'; ?>



