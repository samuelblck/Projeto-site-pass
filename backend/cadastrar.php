<?php
include "conexao.php"; // Puxa o arquivo conexao

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Só entra aqui se o método do formulario for POST
    // Puxa email e senha do HTML
    $email = strtolower($_POST["email"]);
    $senha = $_POST["senha"];

    // Verifica se a senha tem pelo menos 8 caracteres
    if (strlen($senha) < 8) {
        echo "A senha deve ter no mínimo 8 caracteres.";
        exit; // Finaliza o script se a senha for inválida
    }

    

    // Verifica se o email ja existe no banco de dados
    $queryValidarEmail = "SELECT COUNT(*) AS total FROM usuarios WHERE email = :email";
    $stmtValidarEmail = $banco->prepare($queryValidarEmail);
    $stmtValidarEmail->bindParam(':email', $email);
    $stmtValidarEmail->execute();

    $resultado = $stmtValidarEmail->fetch();
    $total_usuarios_com_email = $resultado['total'];

    if ($total_usuarios_com_email > 0) { // Email ja em uso
        echo "O email ja esta sendo usado";
        exit; // Finaliza o script
    }

    // Começa o cadastro

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $query = "INSERT INTO usuarios (senha_hash, email) VALUES (:senha, :email)";
    $stmt = $banco->prepare($query);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        // Cadastro realizado com sucesso
        echo "Cadastro realizado";
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>
