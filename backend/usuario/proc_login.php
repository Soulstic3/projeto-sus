<?php
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cpf']) && isset($_POST['senha'])) {

        // Inclui o arquivo de conexão com o banco de dados
        include_once "../mysql_connect.php"; 

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        // Consulta SQL para buscar o usuário pelo CPF
        $sql = "SELECT id_usuario, cpf, senha FROM usuario WHERE cpf = ? LIMIT 1";

        // Prepara a consulta SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $cpf);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verifica se a senha informada corresponde à senha no banco de dados
            if ($senha == $row['senha']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['cpf'] = $cpf;
                $_SESSION['id_usuario'] = $row['id_usuario'];

                header("Location: http://localhost/Projeto_SUS/frontend/pages/dadosUsuario.php");
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "CPF não encontrado!";
        }

        // Fecha a consulta preparada
        $stmt->close();
    }
}
?>
