<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["Usuario"];
    $senha = $_POST["Senha"];

    $banco = new PDO('sqlite:bancoUsuarios.db');

    if (!$banco) {
        die("Erro ao conectar.");
    }

    $query = "SELECT senha_hash FROM usuarios WHERE email = :usuario";
    $stmt = $banco->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // confere os dados
    if ($resultado && password_verify($senha, $resultado['senha_hash'])) {
        // login feito
        $_SESSION['usuario'] = $usuario;
        header('Location: ../paginaInicial.html');// manda pra pagina inicial
        exit();
    } else {
        // Falhou
        echo "Dados invalidos";
    }
}
?>
