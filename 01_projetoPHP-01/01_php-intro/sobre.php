<?php
$nome        = "Gustavo Alves Hanisch";
$pagina_atual = "sobre";
$caminho_raiz = "../";
//    <link rel="stylesheet" href="../includes/style.css">
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>
<?php include '../includes/cabecalho.php'; ?>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; background: #f3f4f6;">



<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #3b579d;">👤 Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de
    Técnico em Informática no IFPR de Ponta Grossa.</p>

    <p>Quero fazer faculdade de engenharia elétrica ou mecânica e seguir em uma dessas áreas depois de me formar.</p>

    <a href="index.php"
       style="color: #3b579d; font-weight: bold;">← Voltar ao início</a>
</div>

<?php include '../includes/rodape.php'; ?>

</body>
</html>

