<?php

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

$pdo = conectar();

$stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
$stmt->execute([
    ':id' => $id
]);

$projeto = $stmt->fetch();

if (!$projeto) {
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

$titulo_pagina = 'Detalhes do Projeto';
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
    <div class="card">
        <h1 class="titulo-secao">📄 Detalhes do Projeto</h1>

        <p><strong>📌 Nome:</strong>
            <?php echo htmlspecialchars($projeto['nome']); ?>
        </p>

        <p><strong>📝 Descrição:</strong><br>
            <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?>
        </p>

        <p><strong>🛠️ Tecnologias:</strong>
            <?php echo htmlspecialchars($projeto['tecnologias']); ?>
        </p>

        <p><strong>📅 Ano:</strong>
            <?php echo htmlspecialchars($projeto['ano']); ?>
        </p>

        <?php if (!empty($projeto['link_github'])): ?>
            <p>
                <strong>🔗 GitHub:</strong>
                <a href="<?php echo htmlspecialchars($projeto['link_github']); ?>"
                   target="_blank"
                   rel="noopener noreferrer">
                    Ver repositório
                </a>
            </p>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="index.php" class="btn-secundario">⬅ Voltar</a>
            <a href="editar.php?id=<?php echo (int) $projeto['id']; ?>" class="btn-primario">✏️ Editar</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>