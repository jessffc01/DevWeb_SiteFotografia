<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'] ?? '';
    $servico = $_POST['servico']; // Ex: "Ensaio casal.pdf"

    include 'config/conexao.php'; // garante a conexão com o banco

    // Inserir no banco de dados
    $sql = "INSERT INTO orcamento (nome, email, telefone, servico)
            VALUES ('$nome', '$email', '$telefone', '$servico')";

    if ($conn->query($sql) === TRUE) {
        // ✅ Dados gravados com sucesso
        // Agora prepara o download
        $caminho_pdf = __DIR__ . "/pdfs/" . basename($servico);

        if (file_exists($caminho_pdf)) {
            // Limpa o buffer de saída (evita conflito com header)
            if (ob_get_length()) {
                ob_end_clean();
            }

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($caminho_pdf) . '"');
            header('Content-Length: ' . filesize($caminho_pdf));

            readfile($caminho_pdf);
            exit;
        } else {
            echo "❌ O arquivo não foi encontrado em: " . htmlspecialchars($caminho_pdf);
        }
    } else {
        echo "Erro ao salvar no banco: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Acesso inválido.";
}
?>
