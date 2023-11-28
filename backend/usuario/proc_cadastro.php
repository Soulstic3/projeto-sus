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
        // Define a resposta como sucesso
        $response['success'] = true;
        $response['message'] = "Cadastro concluído com sucesso!";
    } else {
        // Define a resposta como erro
        $response['success'] = false;
        $response['message'] = "Erro ao inserir registro: " . $conn->error;
    }

    // Retorna a resposta em formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fecha a conexão
$conn->close();
?>
