<?php
$banco = new PDO('sqlite:bancoUsuarios.db'); // Cria a conexao com o banco

if (!$banco) { // Finaliza tudo se der erro
    die("Erro ao conectar ao banco de dados.");
}

// Cria a tabela usuarios com as colunas case nao e exista
$query = "CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY,
            senha_hash TEXT NOT NULL,
            email TEXT NOT NULL
          )";

$banco->exec($query); // Executa instrucao sql
?>
