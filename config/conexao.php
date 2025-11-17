<?php
$config = include __DIR__ . "/env.php";

$conn = mysqli_connect(
    $config["db_host"],
    $config["db_user"],
    $config["db_pass"],
    $config["db_name"]
);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}
?>
