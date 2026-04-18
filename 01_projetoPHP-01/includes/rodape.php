<?php
$autor = isset($nome) ? htmlspecialchars($nome) : "Portfólio";
?>

<footer>
    <?php echo $autor; ?>
    &copy; <?php echo date("2026"); ?>
    | Desenvolvido com PHP
    | IFPR - Ponta Grossa
</footer>