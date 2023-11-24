<?php
// Incluindo o arquivo de conexão
require_once ("../mysql_connect.php");

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $novaSenha = $_POST['novaSenha'];
    $cartao_sus = $_POST['cartao_sus'];
    $novoCPF = $_POST['novoCPF'];
    $nascimento = $_POST['nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];

    // Prepara a consulta SQL para inserção dos dados
    $sql = "INSERT INTO usuario (nome, senha, cartao_sus, cpf, nascimento, sexo, telefone) 
            VALUES ('$nome', '$novaSenha', '$cartao_sus', '$novoCPF', '$nascimento', '$sexo', '$telefone')";

    // Executa a consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Mensagem de sucesso em JavaScript
        echo '<script>alert("Cadastro concluído com sucesso!");';
        echo 'window.location.href = "http://localhost/Projeto_SUS";</script>';
        exit(); // Termina a execução do script PHP após o redirecionamento
    } else {
        // Mensagem de erro em JavaScript
        echo '<script>alert("Erro ao inserir registro: ' . $conn->error . '");</script>';
    }
}

// Fecha a conexão
$conn->close();
?>
