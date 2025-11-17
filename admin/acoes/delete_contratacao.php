<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: ../login.php");
    exit;
}

require_once "../config/conexao.php";

$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: ../painel.php?erro=ID inválido");
    exit;
}

$sql = "DELETE FROM contratacoes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../painel.php?sucesso=Contratação excluída com sucesso");
} else {
    header("Location: ../painel.php?erro=Erro ao excluir contratação");
}
exit;
?>