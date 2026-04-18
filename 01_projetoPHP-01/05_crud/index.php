<?php

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();


require_once __DIR__ . '/includes/conexao.php';

$pdo = conectar();
$stmtTec = $pdo->query('SELECT DISTINCT tecnologias FROM projetos ORDER BY tecnologias');
$tecnologiasLista = $stmtTec->fetchAll(PDO::FETCH_COLUMN);

$busca = trim($_GET['busca'] ?? '');
$tecnologia = trim($_GET['tecnologia'] ?? '');

$sql = 'SELECT * FROM projetos WHERE 1=1';
$params = [];

if ($busca !== '') {
    $sql .= ' AND nome LIKE :busca';
    $params[':busca'] = '%' . $busca . '%';
}

if ($tecnologia !== '') {
    $sql .= ' AND tecnologias = :tecnologia';
    $params[':tecnologia'] = $tecnologia;
}

$sql .= ' ORDER BY criado_em DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

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
    <form method="get"
    style="margin-bottom: 20px; display: flex; justify-content: center; align-items: center; gap: 10px;">
    
    <input type="text"
        name="busca"
        placeholder="Buscar por nome do projeto..."
        value="<?php echo htmlspecialchars($busca); ?>"
        class="input-texto"
        style="width: 350px;">

    <select name="tecnologia" class="input-texto" style="width: 220px;">
    <option value="">Todas as tecnologias</option>
    <?php foreach ($tecnologiasLista as $tec): ?>
        <option value="<?php echo htmlspecialchars($tec); ?>"
            <?php echo $tecnologia === $tec ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($tec); ?>
        </option>
    <?php endforeach; ?>
</select>

    <button type="submit" class="btn-secundario">🔍 Buscar</button>

    <?php if ($busca !== ''): ?>
        <a href="index.php" class="btn-secundario">✖ Limpar</a>
    <?php endif; ?>

</form>
    <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
</div>

    <?php if ($cadastroOk): ?>
    <div class="alerta-sucesso" style="background: #dcfce7; border-left: 4px solid #16a34a; padding: 12px; margin-bottom: 16px;">
        <p style="margin: 0; color: #166534;">✅ Projeto cadastrado com sucesso!</p>
    </div>
<?php endif; ?>

<?php if ($editadoOk): ?>
    <div class="alerta-sucesso" style="background: #dcfce7; border-left: 4px solid #16a34a; padding: 12px; margin-bottom: 16px;">
        <p style="margin: 0; color: #166534;">✏️ Projeto atualizado com sucesso!</p>
    </div>
<?php endif; ?>

<?php if ($excluidoOk): ?>
    <div class="alerta-sucesso" style="background: #dcfce7; border-left: 4px solid #16a34a; padding: 12px; margin-bottom: 16px;">
        <p style="margin: 0; color: #166534;">🗑️ Projeto removido com sucesso!</p>
    </div>
<?php endif; ?>

<?php if ($erroMsg === 'nao_encontrado'): ?>
    <div class="alerta-erro" style="background: #fee2e2; border-left: 4px solid #dc2626; padding: 12px; margin-bottom: 16px;">
        <p style="margin: 0; color: #991b1b;">❌ Projeto não encontrado. Ele pode já ter sido removido.</p>
    </div>
<?php elseif ($erroMsg === 'id_invalido'): ?>
    <div class="alerta-erro" style="background: #fee2e2; border-left: 4px solid #dc2626; padding: 12px; margin-bottom: 16px;">
        <p style="margin: 0; color: #991b1b;">❌ Requisição inválida.</p>
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
            <a href="detalhe.php?id=<?php echo (int) $projeto['id']; ?>" 
            class="btn-secundario">👁️ Detalhes</a>
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