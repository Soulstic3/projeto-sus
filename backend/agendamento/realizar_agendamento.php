<?php
session_start();
// Incluir o arquivo de conexão com o banco de dados
include '../mysql_connect.php';

// Verifica se foi enviado um formulário via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura o nome de usuário logado a partir da sessão
    $id_usuario = $_SESSION['id_usuario'];

    // Captura os dados do formulário
    $tipoConsulta = $_POST['options']; // Aqui, 'options' é o name do grupo de checkboxes
    $dataConsulta = $_POST['dataConsulta'];
    $horarioConsulta = $_POST['horarioConsulta'];

    // Prepara e executa a inserção na tabela
    $sql = "INSERT INTO consulta (tipoConsulta, dataConsulta, horarioConsulta, id_usuario) 
    VALUES ('$tipoConsulta', '$dataConsulta', '$horarioConsulta', '$id_usuario')";

    if ($conn->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
