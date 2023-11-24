<?php
// Conectar ao banco de dados (exemplo com MySQLi)
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "posto de saude"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);

//} else {
//   echo "Conexão bem-sucedida!";
}
?>