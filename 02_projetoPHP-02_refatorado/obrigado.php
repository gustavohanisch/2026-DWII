<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : obrigado.php (migrado de 02_formularios/obrigado.php)
 * Autor      : Gustavo Alves Hanisch
 * Data       : 18/04/2026
 * Descrição  : Destino do redirecionamento PRG do contato.php.
 *              Lê o nome do visitante via $_SESSION.
 * ============================================================
 */

// session_start() ANTES de qualquer saída HTML.
// Necessário aqui — cabecalho.php é incluído dentro do <head>,
// após o início do output HTML, tarde demais para iniciar sessão.
if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Ordem padrão — sem $nome (fallback do cabecalho.php)
// $pagina_atual = 'contato'; // mantém "Contato" ativo no nav
$titulo_pagina = 'Mensagem enviada | Portfólio DWII';
$caminho_raiz = './';

// ✅ Leitura via $_SESSION em vez de $_GET
//
// ANTES: $nome_visitante = htmlspecialchars($_GET['nome'] ?? '')
//  → nome visível na URL, manipulável por qualquer pessoa
//  → obrigado.php?nome=Hacker funcionaria sem enviar formulário
//
// DEPOIS: nome guardado no servidor após validação do formulário.
//  → Se null aqui → acesso direto sem formulário → redirecionamos.
$nome_visitante = $_SESSION['contato_nome'] ?? null;

if ($nome_visitante === null) {
    header('Location: contato.php');
    exit;
}

// Remove da sessão após ler — evita reexibir no F5 ou no histórico
unset($_SESSION['contato_nome']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!--
    ✅ Resolve P10 e P3:
    ANTES: include 'includes/cabecalho.php'
      → sem __DIR__: frágil, depende do CWD (P10)
      → apontava para 02_formularios/includes/ com <style> embutido (P3)
    DEPOIS: __DIR__ . '/includes/cabecalho.php'
      → caminho absoluto garantido (P10 resolvido)
      → aponta para includes/ global sem CSS duplicado (P3 resolvido)
    -->
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">

        <div class="alerta-sucesso">
            <h3>✅ Mensagem enviada com sucesso!</h3>
            <p>Obrigado, <strong><?php echo htmlspecialchars($nome_visitante); ?></strong>! 🎉</p>
            <p>Sua mensagem foi recebida. Retornarei em breve.</p>
        </div>

        <!-- ✅ Links atualizados — 01_php-intro/ não existe mais -->
        <div style="margin-top: 20px; display: flex; gap: 12px;">
            <a href="index.php" class="btn-primario">🏠 Voltar ao Início</a>
            <a href="contato.php" class="btn-secundario">📩 Enviar outra mensagem</a>
</div>

</div>
<?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>