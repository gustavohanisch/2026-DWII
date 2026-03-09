<?php
$nome       ="Gustavo Alves Hanisch";
$pagina_atual = "sobre";
?>
<!DOCTYPE html>
<html lang="pt-BR>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: #f3f4f6;">

<?php include 'includes/cabecalho.php'; ?>

<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #3b579d;">👤 Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de Técnico em Informática no IFPR de Ponta Grossa.</p>
    <p>Quero fazer faculdade de engenharia elétrica ou mecânica na UTFPR e seguir em uma dessas carreiras.</p>
    <a href="index.php"
    style="color: #3b579d; font-weight: bold;">← Voltar ao inicio</a>
</div> 
<?php include 'includes/rodape.php'; ?>

</body>
</html>