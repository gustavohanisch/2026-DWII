<?php
$nome        = "Gustavo Alves Hanisch";
$pagina_atual = "projetos";
$caminho_raiz = "../";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos - <?php echo $nome; ?></title>
<?php require_once __DIR__ . '../../includes/cabecalho.php'; ?>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; background: #f3f4f6;">



<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #3b579d;">🚀 Projetos</h1>

    <a href="index.php"
       style="color: #3b579d; font-weight: bold;">← Voltar ao início</a>
</div>

 <?php require_once __DIR__ . '/../includes/rodape.php'; ?>

</body>
</html>