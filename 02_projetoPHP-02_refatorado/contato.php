<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : contato.php (migrado de 02_formularios/contato.php)
 * Autor      : Gustavo Alves Hanisch
 * Data       : 18/04/2026
 * Padrão     : PRG – Post/Redirect/Get
 * ============================================================
 *
 * ⚠️ session_start() é necessário AQUI porque $_SESSION é usado
 * no bloco POST abaixo, antes de incluir cabecalho.php.
 * Nenhum caractere pode aparecer antes deste bloco.
 */

// session_start() ANTES de qualquer saída HTML.
// Necessário aqui – cabecalho.php é incluído dentro do <head>,
// após o início do output HTML, tarde demais para iniciar sessão.
if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Ordem padrão: $pagina_atual -> $titulo_pagina -> $caminho_raiz
// Sem $nome – fallback do cabecalho.php.
$pagina_atual = 'contato';
$titulo_pagina = 'Contato | Portfólio DWII';
$caminho_raiz = './';

// Valores iniciais – sobrescritos se o formulário for reenviado com erros
$nome_visitante = '';
$email     = '';
$mensagem  = '';
$erros     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // trim() remove espaços; ?? '' evita erro se o campo não existir
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $mensagem       = trim($_POST['mensagem'] ?? '');

    if (empty($nome_visitante)) {
        $erros[] = 'O campo Nome é obrigatório.';
    } elseif (strlen($nome_visitante) < 3) {
        $erros[] = 'O nome deve ter pelo menos 3 caracteres.';
    }

    if (empty($email)) {
        $erros[] = 'O campo E-mail é obrigatório.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // filter_var com FILTER_VALIDATE_EMAIL verifica o formato.
        // O ! inverte: entra no if quando o e-mail é INVÁLIDO.
        $erros[] = 'Informe um e-mail válido (ex: nome@email.com).';
    }

    if (empty($mensagem)) {
        $erros[] = 'O campo Mensagem é obrigatório.';
    } elseif (strlen($mensagem) < 10) {
        $erros[] = 'A mensagem deve ter pelo menos 10 caracteres.';
    } elseif (strlen($mensagem) > 500) {
        $erros[] = 'A mensagem não pode ultrapassar 500 caracteres.';
    }

    if (empty($erros)) {
        // ✅ Nome salvo em $_SESSION em vez de passado pela URL.
        // ANTES: header('Location: obrigado.php?nome=' . urlencode(...))
        // → nome visível na URL, qualquer um pode acessar obrigado.
        // DEPOIS: dado guardado no servidor, não exposto ao visitante.
        $_SESSION['contato_nome'] = $nome_visitante;

        header("Location: obrigado.php");
        exit; // SEMPRE após header Location
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- './../includes/' → './includes/' -->
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="titulo-secao">📩 Entre em Contato</h1>

        <?php if (!empty($erros)) : ?>
            <!-- ✅ Classe .alerta-erro substitui bloco style="" inline -->
            <div class="alerta-erro">
                <h3>⚠️ Corrija os erros abaixo:</h3>
                <ul style="margin: 6px 0 0; padding-left: 20px;">
                    <?php foreach ($erros as $erro) : ?>
                        <li><?php echo htmlspecialchars($erro); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!--
        ✅ CSS inline substituído pelas classes do style.css global:
        .form-container → fundo branco, padding, border-radius
        .campo         → margin-bottom entre campos
        .label-campo   → label em negrito, display: block
        .input-texto   → estilo unificado para input e textarea
        .btn-primario  → botão azul com hover
        -->
<div class="form-container">
    <form class="formulario" method="post" action="contato.php">

        <div class="campo">
            <label class="label-campo" for="nome_visitante">Nome *</label>
            <input class="input-texto" type="text" id="nome_visitante"
                   name="nome_visitante" placeholder="Seu nome completo"
                   value="<?php
                   /*
                    * PRESERVAÇÃO DO VALOR:
                    * Se o formulário foi reenviado com erros,
                    * $nome_visitante
                    * já contém o que o usuário digitou — evita redigitar.
                    *
                    * htmlspecialchars() obrigatório: impede XSS no
                    * atributo value.
                    */
                   echo htmlspecialchars($nome_visitante);
                   ?>">
        </div>

        <div class="campo">
            <label class="label-campo" for="email">E-mail *</label>
            <input class="input-texto" type="email" id="email" name="email"
                   placeholder="seu@email.com"
                   value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="campo">
            <label class="label-campo" for="mensagem">Mensagem *
<span style="color: #6b7280; font-weight: normal; font-size: 13px;">
  (mín. 10, máx. 500 caracteres)
</span>
</label>

<!--
Para <textarea> o valor vai ENTRE as tags, não em value="".
Sem quebra de linha após a abertura — evita espaço extra
no início da mensagem recuperada após erro de validação.
-->

<textarea class="input-texto" id="mensagem" name="mensagem"
  rows="5" placeholder="Escreva sua mensagem..."
  maxlength="500"><?php echo htmlspecialchars($mensagem); ?></textarea>
</div>

<button type="submit" class="btn-primario" style="width: 100%;">
  Enviar Mensagem 📩
</button>

</form>
</div>
</div>

<?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>


