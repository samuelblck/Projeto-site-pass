<?php
include "conexao.php"; // Puxa o arquivo conexao

$msg = ""; // Armazena a mensagem

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Só entra aqui se o método do formulário for POST
    // Puxa email e senha do HTML
    $email = strtolower($_POST["email"]);
    $senha = $_POST["senha"];

    if (strlen($senha) < 8) {
        $msg = "A senha deve ter no minimo 8 caracteres.";
    } else {
        // Verifica se o email ja existe no banco de dados
        $queryValidarEmail = "SELECT COUNT(*) AS total FROM usuarios WHERE email = :email";
        $stmtValidarEmail = $banco->prepare($queryValidarEmail);
        $stmtValidarEmail->bindParam(':email', $email);
        $stmtValidarEmail->execute();

        $resultado = $stmtValidarEmail->fetch();
        $total_usuarios_com_email = $resultado['total'];

        if ($total_usuarios_com_email > 0) {
            // Email em uso
            $msg = "O email ja esta sendo usado";
        } else {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            $query = "INSERT INTO usuarios (senha_hash, email) VALUES (:senha, :email)";
            $stmt = $banco->prepare($query);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                $msg = "Cadastro realizado";
                // Limpa o formulario
                // $_POST["email"] = "";
                // $_POST["senha"] = "";
            } else {
                $msg = "Erro ao cadastrar.";
            }
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
</head>
<body>
    <h1>Cadastro</h1>
    <section>
        <div>
            <form action="cadastrar.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br>
                <input type="submit" value="Cadastrar">
            </form>
            <?php if ($msg !== "") { ?>
                <p><?php echo $msg; ?></p>
            <?php } ?>
            <a href="../index.html">Fazer login</a>
        </div>
    </section>
</body>
</html>
