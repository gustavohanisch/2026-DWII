<?php
/**
 * ============================================================
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal – versão refatorada
 * Arquivo    : incudes/conexao.php
 * Autor      : Gustavo Alves Hanisch
 * Data       : 04/05/2026
 * Descricao  : Conexao PDO única do projeto.
 * Resolve P5 (dois bancos) e P6 (dois conexao.php).
 * ============================================================
 */

function conectar(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=portfolio;charset=utf8mb4';
    $usuario = 'root';
    $senha = 'dwii2026';

    try {
        return new PDO($dsn, $usuario, $senha, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            PDO::ATTR_EMULATE_PREPARES => false,

        ]);

    } catch (PDOException $e) {
        die('Erro de conexão com o banco de dados.');
    }
}