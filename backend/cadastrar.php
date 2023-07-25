<?php
include "conexao.php"; // Puxa o arquivo conexao

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Só entra aq se o metodo do formulario for post
    // Puxa email e senha do HTML
    $email = strtolower($_POST["email"]);
    $senha = $_POST["senha"];

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT); // Joga hash na senha e salva no banco ja com hash
    


    $query = "INSERT INTO usuarios (senha_hash, email) VALUES (:senha, :email)"; // Joga no banco os valores senha e email
    $stmt = $banco->prepare($query); // Prepara a instrucao
    // vincula o email/senha para o parametro  :senha e :email no sql
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':email', $email);

    // Se deu tudo certo ok se nao moio prkl
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar.";
    }
}

?>
