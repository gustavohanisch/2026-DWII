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
} elseif (strlen($mensagem) < 10) {
    $erros[] = 'A mensagem deve ter pelo menos 10 caracteres.';
}

}
?>



<div class="container">
    <h1 class="titulo-secao">📫 Formulario de Contato</h1>

    <form class="form-container" action="contato.php" method="get">

    <label> Seu nome: </label>
    <input type="text" name="nome_visitante">

    <label> Sua mensagem:</label>
    <textarea name="mensagem" rows="4"></textarea>

    <button type="submit">Enviar</button>
     
</form>
</div>

<?php if ($nome_visitante !== ''): ?>
    <div class="alerta-sucesso" style="margin-top: 20px;">
        <h3>✅ Dados recebidos!</h3>
        <p><strong>Nome:</strong>
        <?php echo htmlspecialchars($nome_visitante); ?></p>
        <p><strong>Mensagem:</strong>
        <?php echo htmlspecialchars($mensagem); ?></p>
</div>
<?php endif; ?>

<?php include '../includes/rodape.php'; ?>



