<?php
// Incluindo o arquivo de conexão
require_once ("../mysql_connect.php");

// Verifica se o usuário está logado
if (verificarUsuarioLogado()) {
    // Obtém o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $enderecoUsuario = $_POST['enderecoUsuario'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];

    // Prepara a consulta SQL para inserção dos dados
    $sql = "INSERT INTO usuario (enderecoUsuario, bairroUsuario, cepUsuario)  
            VALUES ('$enderecoUsuario', '$bairroUsuario', '$cepUsuario')
            WHERE id_usuario = $id_usuario";

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
