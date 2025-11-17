<?php
session_start();
// 🔒 VERIFICAR SE ESTÁ LOGADO
if (!isset($_SESSION['logado'])) {
    header("Location: ../login.php");
    exit;
}

include "../config/conexao.php";

// 🛡️ VALIDAR E SANITIZAR ID
$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);
if (!$id) {
    die("ID inválido");
}

// 🛡️ PREPARED STATEMENT para segurança
$sql = "UPDATE clientes SET ok = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../painel.php");
exit;
?>