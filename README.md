# 📸 Site de Fotografia - Jessicafcfotografias

Este projeto é um site desenvolvido para a marca **@jessicafcfotografias**, voltado à apresentação de portfólios e à captação de novos clientes por meio de formulários de **orçamento** e **contato**.  
O objetivo é unir estética e funcionalidade, oferecendo uma experiência visual agradável ao usuário e uma estrutura técnica organizada para gerenciamento de dados.

---

## 🧩 Funcionalidades

- 🌅 Página inicial com apresentação e portfólio de serviços.  
- 💬 Formulário de **contato** para reservas e mensagens diretas.  
- 💼 Formulário de **orçamento**, que permite baixar PDFs de pacotes fotográficos.  
- 💾 Integração com banco de dados MySQL para armazenar informações dos formulários.  
- 🔗 Sistema automático que vincula orçamentos e contatos, gerando uma tabela de **contratações**.  
- 🔒 Separação segura da conexão com o banco de dados em uma pasta ignorada pelo Git.

---

## 🛠️ Tecnologias Utilizadas

| Categoria | Tecnologias |
|------------|--------------|
| **Frontend** | HTML5, CSS3 |
| **Backend** | PHP 8 |
| **Banco de Dados** | MySQL |
| **Servidor Local** | Apache (via LAMP ou XAMPP) |
| **Versionamento** | Git e GitHub |
| **Sistema Operacional** | Ubuntu Linux |

---

## 🧱 Estrutura de Pastas

```bash
devweb/
├── config/               # Pasta com o arquivo de conexão (oculta pelo .gitignore)
│   └── conexao.php
├── imagens/              # Armazena as imagens do site
├── pdfs/                 # Contém os PDFs de pacotes de fotografia
├── processa_contato.php  # Script de processamento do formulário de contato
├── processa_orcamento.php# Script de processamento do formulário de orçamento
├── contato.html          # Página de contato
├── orcamento.html        # Página de orçamentos
├── index.html            # Página inicial
├── servicos.html         # Página de apresentação dos serviços
├── style.css             # Estilos gerais do site
└── README.md

🧮 Estrutura do Banco de Dados
Tabela contato
| Campo    | Tipo         | Descrição                |
| -------- | ------------ | ------------------------ |
| id       | INT (AI)     | Identificador único      |
| nome     | VARCHAR(100) | Nome completo            |
| email    | VARCHAR(100) | Endereço de e-mail       |
| telefone | VARCHAR(20)  | Telefone de contato      |
| data     | INT          | Data desejada do serviço |
| horario  | INT          | Horário de início        |
| mensagem | TEXT         | Observações do cliente   |
Tabela orcamento
| Campo      | Tipo         | Descrição                 |
| ---------- | ------------ | ------------------------- |
| id         | INT (AI)     | Identificador único       |
| nome       | VARCHAR(100) | Nome completo             |
| email      | VARCHAR(100) | Endereço de e-mail        |
| telefone   | VARCHAR(20)  | Telefone de contato       |
| servico    | VARCHAR(255) | Tipo de serviço escolhido |
| mensagem   | TEXT         | Observações opcionais     |
| data_envio | TIMESTAMP    | Data de envio automática  |
Tabela contratacoes
| Campo        | Tipo         | Descrição                  |
| ------------ | ------------ | -------------------------- |
| id           | INT (AI)     | Identificador único        |
| nome         | VARCHAR(255) | Nome completo              |
| email        | VARCHAR(255) | Endereço de e-mail         |
| telefone     | VARCHAR(50)  | Telefone de contato        |
| servico      | VARCHAR(255) | Serviço contratado         |
| data_contato | TIMESTAMP    | Data de criação automática |

⚙️ Como Executar o Projeto Localmente
Clone o repositório
git clone https://github.com/seuusuario/devweb.git
cd devweb

Configure o servidor Apache e MySQL
Se estiver usando XAMPP, coloque a pasta devweb dentro de htdocs.
Se estiver usando LAMP (Ubuntu), mova a pasta para /var/www/html/.
Crie o banco de dados
CREATE DATABASE site_fotografia;
USE site_fotografia;
Importe as tabelas

Crie as tabelas contato, orcamento e contratacoes conforme o esquema acima.
Configure a conexão
Dentro da pasta config/, crie o arquivo conexao.php:
<?php
$servidor = "localhost";
$usuario = "root";
$senha = ""; // altere conforme sua configuração
$dbname = "site_fotografia";
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>

Acesse o site
Abra no navegador:
http://localhost/devweb/


🚫 Segurança e Privacidade
O arquivo config/conexao.php não é versionado (listado no .gitignore) para proteger as credenciais do banco.
Dados enviados pelos formulários são tratados e armazenados de forma segura via prepared statements no PHP.
O sistema foi desenvolvido para fins acadêmicos e pode ser expandido com autenticação e painel administrativo.

💡 Possíveis Melhorias Futuras

Implementar painel administrativo para visualizar orçamentos e contatos
Adicionar autenticação com login e senha.
Criar API REST para integração com outras plataformas.
Melhorar a responsividade e acessibilidade do front-end.
Adicionar envio de e-mail automático após o envio dos formulários.

👩‍💻 Autoria

Desenvolvido por Jéssica Fernandes Fragoso de Carvalho
📷 @jessicafcfotografias
