<?php
require_once '../backend/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Calendário</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Cadastro</h2>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="POST" action="">
        <input type="text" name="nome" placeholder="Nome completo" required><br>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem conta? <a href="login.php">Faça login</a></p>
</body>
</html>
