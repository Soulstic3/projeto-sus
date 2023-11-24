<?php
// Arquivo conexao.php
require_once "mysql_connect.php";

// Função para verificar se o usuário está logado
function verificarUsuarioLogado() {
    // Coloque aqui a lógica para verificar se o usuário está logado
    // Por exemplo, verificar se a variável de sessão está definida
    if (isset($_SESSION['id_usuario'])) {
        return true;
    } else {
        return false;
    }
}
?>
