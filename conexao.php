<?php
$servidor = "localhost";
$usuario = "root";
$senha = "1234";
$dbname = "site_fotografia";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>