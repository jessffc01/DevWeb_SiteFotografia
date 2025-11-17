<?php
session_start();

// Incluir configuração - VERIFIQUE O CAMINHO!
$config = include __DIR__ . "/../config/env.php";

// Conexão com banco
include __DIR__ . "/../config/conexao.php";

// Verificar se formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validar campos
    if (empty($_POST['usuario']) || empty($_POST['senha'])) {
        header("Location: login.php?erro=Preencha todos os campos");
        exit;
    }

    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = $_POST['senha'];

    // USANDO AS CREDENCIAIS DO PAINEL do env.php
    if ($usuario === $config["painel_user"] && $senha === $config["painel_pass"]) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: painel.php");
        exit;
    } else {
        header("Location: login.php?erro=Usuário ou senha incorretos");
        exit;
    }
} else {
    // Se acessar diretamente, redireciona
    header("Location: login.php");
    exit;
}
?>