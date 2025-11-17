<?php
session_start();

// Se JÁ ESTIVER logado, redireciona para o painel
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: painel.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="processa_login.php">
    <label>Usuário:</label>
    <input type="text" name="usuario" required><br><br>

    <label>Senha:</label>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Entrar</button>
</form>

</body>
</html>