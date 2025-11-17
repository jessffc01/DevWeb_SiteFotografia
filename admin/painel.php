<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
include "../config/conexao.php"; 
$sucesso = $_GET['sucesso'] ?? '';
$erro = $_GET['erro'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel Profissional</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Raleway', sans-serif;
            background: #0a1f0a;
            color: #e8f5e8;
            line-height: 1.6;
            background-image: linear-gradient(45deg, #0a1f0a 0%, #1a3a1a 100%);
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: linear-gradient(135deg, #2d5a2d 0%, #1a3a1a 100%);
            color: #f0f7f0;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            border: 1px solid #3a6a3a;
            text-align: center;
        }
        
        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3em;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: 1px;
        }
        
        .user-info {
            font-size: 1.2em;
            opacity: 0.9;
            font-weight: 300;
            letter-spacing: 0.5px;
        }
        
        .nav {
            background: rgba(42, 85, 42, 0.9);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 1px solid #4a7a4a;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .nav a {
            color: #e8f5e8;
            text-decoration: none;
            padding: 12px 25px;
            margin: 0 8px;
            border: 2px solid #4a7a4a;
            border-radius: 30px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 1.1em;
            background: rgba(58, 106, 58, 0.3);
        }
        
        .nav a:hover {
            background: #4a7a4a;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 122, 74, 0.4);
            border-color: #5a8a5a;
        }
        
        .section {
            background: rgba(42, 85, 42, 0.1);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            border: 1px solid #2d5a2d;
            backdrop-filter: blur(5px);
        }
        
        .section h2 {
            color: #c8e6c8;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #4a7a4a;
            display: inline-block;
            font-family: 'Playfair Display', serif;
            font-size: 2.2em;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(26, 58, 26, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.2);
            border: 1px solid #3a6a3a;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #3a6a3a;
            font-weight: 400;
        }
        
        th {
            background: linear-gradient(135deg, #2d5a2d 0%, #1e421e 100%);
            color: #f0f7f0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
            font-family: 'Raleway', sans-serif;
            border-bottom: 2px solid #4a7a4a;
        }
        
        tr:hover {
            background: rgba(74, 122, 74, 0.2);
        }
        
        tr:nth-child(even) {
            background: rgba(42, 85, 42, 0.3);
        }
        
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
            margin: 2px;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
            font-weight: 500;
            font-family: 'Raleway', sans-serif;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
            color: white;
            border: 1px solid #A0522D;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 69, 19, 0.4);
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #2d5a2d 0%, #4a7a4a 100%);
            color: white;
            border: 1px solid #4a7a4a;
        }
        
        .btn-edit:hover {
            background: linear-gradient(135deg, #4a7a4a 0%, #2d5a2d 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 122, 74, 0.4);
        }
        
        .logout {
            text-align: center;
            margin-top: 50px;
        }
        
        .logout a {
            color: #c8e6c8;
            text-decoration: none;
            padding: 15px 40px;
            border: 2px solid #4a7a4a;
            border-radius: 30px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 1.1em;
            background: rgba(42, 85, 42, 0.3);
        }
        
        .logout a:hover {
            background: #4a7a4a;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 122, 74, 0.4);
        }
        
        .alert {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 500;
            border: 1px solid;
            font-size: 1.1em;
        }
        
        .alert-success {
            background: rgba(76, 175, 80, 0.2);
            color: #c8e6c8;
            border-color: #4a7a4a;
        }
        
        .alert-error {
            background: rgba(244, 67, 54, 0.2);
            color: #ffcdd2;
            border-color: #d32f2f;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #2d5a2d 0%, #1a3a1a 100%);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            border: 1px solid #3a6a3a;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-number {
            font-size: 3em;
            font-weight: bold;
            color: #c8e6c8;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            font-family: 'Playfair Display', serif;
        }
        
        .stat-label {
            color: #a8c8a8;
            font-size: 1em;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
        }
        
        /* Scroll suave personalizado */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a3a1a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #4a7a4a;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #5a8a5a;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 2.2em;
            }
            
            .nav a {
                display: block;
                margin: 8px 0;
                text-align: center;
            }
            
            table {
                font-size: 0.9em;
            }
            
            th, td {
                padding: 12px 8px;
            }
            
            .section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎯 Painel de Controle</h1>
            <div class="user-info">Bem-vinda, <strong><?php echo $_SESSION['usuario']; ?></strong>!</div>
        </div>

        <!-- Mensagens de Feedback -->
        <?php if ($sucesso): ?>
            <div class="alert alert-success">✅ <?php echo htmlspecialchars($sucesso); ?></div>
        <?php endif; ?>
        
        <?php if ($erro): ?>
            <div class="alert alert-error">❌ <?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>

        <!-- Estatísticas -->
        <div class="stats">
            <?php
            $contatos_count = $conn->query("SELECT COUNT(*) as total FROM contato")->fetch_assoc()['total'];
            $orcamentos_count = $conn->query("SELECT COUNT(*) as total FROM orcamento")->fetch_assoc()['total'];
            $contratacoes_count = $conn->query("SELECT COUNT(*) as total FROM contratacoes")->fetch_assoc()['total'];
            ?>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo $contatos_count; ?></div>
                <div class="stat-label">Contatos</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo $orcamentos_count; ?></div>
                <div class="stat-label">Orçamentos</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?php echo $contratacoes_count; ?></div>
                <div class="stat-label">Contratações</div>
            </div>
        </div>

        <!-- Navegação -->
        <div class="nav">
            <a href="#contatos">📩 Contatos Recebidos</a>
            <a href="#orcamentos">💰 Orçamentos</a>
            <a href="#contratacoes">📘 Contratações</a>
        </div>

        <!-- Seções do conteúdo (mantenha o mesmo PHP das tabelas) -->
        <!-- ========================== -->
        <!--   CONTATOS RECEBIDOS       -->
        <!-- ========================== -->
        <div class="section" id="contatos">
            <h2>📩 Contatos Recebidos</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Mensagem</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM contato ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td><strong>{$row['nome']}</strong></td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['telefone']}</td>
                                    <td>{$row['data']}</td>
                                    <td>{$row['horario']}</td>
                                    <td title='".htmlspecialchars($row['mensagem'])."'>" 
                                         . (strlen($row['mensagem']) > 50 ? substr($row['mensagem'], 0, 50) . '...' : $row['mensagem']) . 
                                    "</td>
                                    <td>
                                        <a href='acoes/delete_contato.php?id={$row['id']}' 
                                           onclick='return confirm(\"Tem certeza que deseja excluir este contato?\")'
                                           class='btn btn-danger' title='Excluir'>🗑️ Excluir</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center; color: #a8c8a8;'>Nenhum contato encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- ========================== -->
        <!--       ORÇAMENTOS           -->
        <!-- ========================== -->
        <div class="section" id="orcamentos">
            <h2>💰 Orçamentos Solicitados</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orcamento ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td><strong>{$row['nome']}</strong></td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['telefone']}</td>
                                    <td>{$row['servico']}</td>
                                    <td>" . date('d/m/Y', strtotime($row['data_criacao'] ?? 'now')) . "</td>
                                    <td>
                                        <a href='acoes/delete_orcamento.php?id={$row['id']}' 
                                           onclick='return confirm(\"Tem certeza que deseja excluir este orçamento?\")'
                                           class='btn btn-danger' title='Excluir'>🗑️ Excluir</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; color: #a8c8a8;'>Nenhum orçamento encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- ========================== -->
        <!--       CONTRATAÇÕES         -->
        <!-- ========================== -->
        <div class="section" id="contratacoes">
            <h2>📘 Contratações Realizadas</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Serviço</th>
                        <th>Data Contratação</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM contratacoes ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td><strong>{$row['nome']}</strong></td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['telefone']}</td>
                                    <td>{$row['servico']}</td>
                                    <td>" . date('d/m/Y', strtotime($row['data_contratacao'] ?? 'now')) . "</td>
                                    <td>
                                        <a href='acoes/delete_contratacao.php?id={$row['id']}' 
                                           onclick='return confirm(\"Tem certeza que deseja excluir esta contratação?\")'
                                           class='btn btn-danger' title='Excluir'>🗑️ Excluir</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; color: #a8c8a8;'>Nenhuma contratação encontrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Logout -->
        <div class="logout">
            <a href="logout.php">🚪 Sair do Sistema</a>
        </div>
    </div>

    <script>
        // Smooth scroll para navegação
        document.querySelectorAll('.nav a').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Auto-hide alerts após 5 segundos
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>