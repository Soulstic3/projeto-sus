<?php
session_start(); // Inicia a sessão
require_once "verificar_usuario.php"; // Arquivo com a função verificarUsuarioLogado()
require_once "../mysql_connect.php"; // Arquivo de conexão com o banco de dados

// Verifica se o usuário está logado
if (verificarUsuarioLogado()) {
    // Obtém o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta SQL para buscar os dados de consulta do usuário
    $query = "SELECT tipoConsulta, dataConsulta, horarioConsulta FROM consulta 
    WHERE id_usuario = $id_usuario";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Exibir as consultas agendadas para o usuário
        while ($row = mysqli_fetch_assoc($result)) {
            $tipoConsulta = $row['tipoConsulta'];
            $dataConsulta = $row['dataConsulta'];
            $horarioConsulta = $row['horarioConsulta'];

            // Exibir as informações da consulta
            echo "Tipo de Consulta: $tipoConsulta - Data e Hora: $dataHoraConsulta <br>";
        }
    } else {
        // Caso não haja consultas agendadas para o usuário
        echo "Não há consultas agendadas para este usuário.";
    }
} else {
    // Trate o caso em que o usuário não está logado
    // Por exemplo: redirecionar para a página de login
    echo "Usuário não está logado!";
}
?>