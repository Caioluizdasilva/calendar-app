<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Calendário</title>
    <link href="assets/libs/fullcalendar/main.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <h2>Bem-vindo ao seu calendário</h2>
    <p><a href="logout.php">Sair</a></p>

    <div id="calendar"></div>

    <!-- Scripts -->
   <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
   <script src="assests/js/calendar.js"></script>
</body>
</html>
