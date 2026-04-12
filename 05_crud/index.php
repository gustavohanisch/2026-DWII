<?php

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();


require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();
$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll();

$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';
$editadoOk = isset($_GET['editado']) && $_GET['editado'] === 'ok';
$excluidoOk = isset($_GET['excluido']) && $_GET['excluido'] === 'ok';

$erroMsg    = isset($_GET['erro']) ? $_GET['erro'] : '';

$titulo_pagina = 'Meus Projetos - Portfólio';
$caminho_raiz = '../';
$pagina_atual = '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">

<div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
    <h1 class="titulo-secao" style="margin: 0;">📂 Meus Projetos </h1>
    <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
</div>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">✅ Projeto cadastrado com sucesso!</p>
    </div>
    <?php endif; ?>

    <?php if ($editadoOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">✅ Projeto atualizado com sucesso!</p>
    </div>
    <?php endif; ?>

    <?php if ($excluidoOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">🗑️ Projeto removido com sucesso!</p>
    </div>
    <?php endif; ?>

    <?php if ($erroMsg === 'nao_encontrado'): ?>
        <div class="alerta-erro">
            <p style="margin: 0;">⚠️ Projeto não encontrado. Ele pode já ter sido removido.</p>
    </div>
    <?php elseif ($erroMsg === 'id_invalido'): ?>
        <div class="alerta-erro">
            <p style="margin: 0;">⚠️ Requisição inválida.</p>
    </div>

    <?php endif; ?>

    <?php if (empty($projetos)): ?>
        <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📪</p>
            <p style="font-size: 16px; margin: 0 0 16px;">Nenhum projeto cadastrado ainda.</p>
            <a href="cadastrar.php" class="btn-primario">➕ Cadastrar o primeiro projeto</a>
    </div>

<?php else: ?>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
        <?php foreach ($projetos as $projeto): ?>
            <div class="card">
            <h3 style="margin: 0 0 8px; color: #3b579d; font-size: 17px;">
                <?php echo htmlspecialchars($projeto['nome']); ?>
        </h3>

        <p style="margin: 0 0 10px; font-size: 14px; color: #374151; line-height: 1.6;">
            <?php echo htmlspecialchars($projeto['descricao']); ?>
        </p>

        <p style="margin: 0 0 6px; font-size: 13px; color: #6b7280;">
            🛠️ <?php echo htmlspecialchars($projeto['tecnologias']); ?>
        </p>

        <p style="margin: 0 0 12px; font-size: 13px; color: #6b7280;">
            📅 <?php echo htmlspecialchars($projeto['ano']); ?>
        </p>

        <?php if ($projeto['link_github']): ?>
            <a href="<?php echo htmlspecialchars
            ($projeto['link_github']); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="btn-secundario">🔗 Ver no GitHub</a>
        <?php endif; ?>

        <div style="margin-top: 12px; display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="editar.php?id=<?php echo (int) $projeto['id']; ?>"
                class="btn-secundario">✏️ Editar</a>
             <a href="excluir.php?id=<?php echo (int) $projeto['id']; ?>"
                class="btn-perigo">🗑️ Excluir</a>
            </div>
        </div>
        <?php endforeach; ?>
        </div>

        <p style="margin-top: 16px; font-size: 14px; color: #6b7280; text-align: right;">
            <?php echo count($projetos); ?> projeto(s) cadastrado(s)
        </p>
        <?php endif; ?>

        </div>

        <?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>