<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pega dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'] ?? '';
    $data = $_POST['data'];
    $horario = $_POST['hora'];
   include 'config/conexao.php'; // garante a conexão com o banco
    // 1️⃣ Inserir contato
$stmt = $conn->prepare("INSERT INTO contato (nome, email, telefone, data, horario, mensagem) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $data, $hora, $mensagem);


    if ($stmt->execute()) {
        // Contato salvo com sucesso
        $stmt->close();

        // 2️⃣ Buscar orçamentos existentes pelo email ou telefone
        $stmt_orc = $conn->prepare("SELECT servico FROM orcamento WHERE email = ? OR telefone = ?");
        $stmt_orc->bind_param("ss", $email, $telefone);
        $stmt_orc->execute();
        $result = $stmt_orc->get_result();

        if ($result->num_rows > 0) {
            // 3️⃣ Inserir em contratacoes para cada orçamento encontrado
            $stmt_contrat = $conn->prepare("INSERT INTO contratacoes (nome, email, telefone, servico) VALUES (?, ?, ?, ?)");
            while ($row = $result->fetch_assoc()) {
                $servico = $row['servico'];
                $stmt_contrat->bind_param("ssss", $nome, $email, $telefone, $servico);
                $stmt_contrat->execute();
            }
            $stmt_contrat->close();
        }

        $stmt_orc->close();
        $conn->close();

        // ✅ Redireciona para página de sucesso (você pode criar success.html)
        header("Location: index.html");
        exit;

    } else {
        echo "Erro ao salvar contato: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Acesso inválido.";
}
?>
