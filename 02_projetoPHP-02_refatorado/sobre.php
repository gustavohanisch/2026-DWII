<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : sobre.php  (página sobre do portfólio)
 * Autor      : Gustavo Alves Hanisch
 * Data       : 18/04/2026
 * Descrição  : A página Sobre apresenta informações pessoais e acadêmicas do autor do portfólio,
 *              permitindo que o visitante o conheça melhor.
 *              Ela utiliza PHP para definir variáveis como nome e página ativa,
 *              além de incluir arquivos reutilizáveis como cabeçalho e rodapé.
 *              O conteúdo principal mostra uma breve apresentação,
 *              objetivos profissionais e um link para voltar à página inicial.
 *              Seu layout é simples, organizado e mantém o padrão visual de todo o sistema.

 * ════════════════════════════════════════════════════════════
 * 
 *
 */

$nome        = 'Gustavo Alves Hanisch';
$pagina_atual = 'sobre';
$caminho_raiz = './';
$formacoes = [
    [
        'curso' => 'Técnico em Informática',
        'instituicao' => 'IFPR - Centro Integrar Ponta Grossa',
        'periodo' => '2024 - 2026'
    ],
    [
        'curso' => 'Ensino Médio',
        'instituicao' => 'IFPR',
        'periodo' => '2024 - 2026'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>
<?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; background: #f3f4f6;">



<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #3b579d;">👤 Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de
    Técnico em Informática no IFPR de Ponta Grossa.</p>

    <p>Quero fazer faculdade de engenharia elétrica ou mecânica e seguir em uma dessas áreas depois de me formar.</p>

    <h2>Formações Acadêmicas</h2>

<?php foreach ($formacoes as $formacao): ?>
    <div style="margin-bottom: 20px;">
        <strong><?php echo $formacao['curso']; ?></strong><br>
        Instituição: <?php echo $formacao['instituicao']; ?><br>
        Período: <?php echo $formacao['periodo']; ?>
    </div>
<?php endforeach; ?>

    <a href="index.php"
       style="color: #3b579d; font-weight: bold;">← Voltar ao início</a>
</div>

<?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>