<?php
session_start(); // Inicia a sessão
require_once "../../backend/verificar_usuario.php"; // Arquivo com a função verificarUsuarioLogado()

// Verifica se o usuário está logado
if (verificarUsuarioLogado()) {
    // Obtém o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta SQL para buscar os dados do usuário pelo ID
    $query = "SELECT dataConsulta, horarioConsulta, tipoConsulta, codigoConsulta 
    FROM consulta ORDER BY dataConsulta DESC LIMIT 1";
    

    $result = mysqli_query($conn, $query); 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dataConsulta = $row['dataConsulta'];
        $horarioConsulta = $row['horarioConsulta'];
        $tipoConsulta = $row['tipoConsulta'];
        $codigoConsulta = $row['codigoConsulta'];
    } else {
        // Trate o caso em que o usuário não foi encontrado ou ocorreu um erro na consulta
        // Por exemplo: redirecionar para uma página de erro, exibir uma mensagem, etc.
        echo "Usuário não encontrado!";
    }
} else {
    // Trate o caso em que o usuário não está logado
    // Por exemplo: redirecionar para a página de login
    echo "Usuário não está logado!";
}

// Recebendo a data no formato americano
$dataAmericana = $dataConsulta;

// Convertendo a data para o formato brasileiro
$dataBrasileira = date('d/m/Y', strtotime($dataAmericana));

// Exibindo a data no formato brasileiro
echo $dataBrasileira; // Saída: 29/11/2023
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Agendadas</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--Customização de containers-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/consultas.css">
</head>

<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f0f0f0;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img class="logotipo" src="../assets/img/2560px-Logo_SUS.svg.png">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item mx-lg-2">
              <a class="nav-link" href="agendamento.html">Agendar Consulta</a>
            </li>
            <li class="nav-item mx-lg-2">
              <a class="nav-link" href="consultas.html">Ver Consultas</a>
            </li>
            <li class="nav-item mx-lg-2">
              <a class="nav-link" href="dadosUsuario.php">Ver Perfil</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

<body>
    <div class="container-sm titulo">
        <div class="flexbox-container">
            <h6>Sua Proxima consulta esta marcada para:</h6>

            <div class="flexbox-item">
                <label for="">Código da Consulta:</label><br>
                <input type="text" class="campo-estatico" value="<?php echo isset($codigoConsulta) ? $codigoConsulta : ''; ?>" readonly>
            </div>

            <div class="flexbox-item">
                <label for="">Data:</label><br>
                <input type="text" class="campo-estatico" value="<?php echo isset($dataBrasileira) ? $dataBrasileira : ''; ?>" readonly>
            </div>

            <div class="flexbox-item">
                <label for="">Horario:</label><br>
                <input type="text" class="campo-estatico" value="<?php echo isset($horarioConsulta) ? $horarioConsulta : ''; ?>" readonly>
            </div>

            <div class="flexbox-item">
                <label for="">Tipo de Consulta:</label><br>
                <input type="text" class="campo-estatico" value="<?php echo isset($tipoConsulta) ? $tipoConsulta : ''; ?>" readonly>
            </div>
        </div>
        <button class="botao" onclick="window.location.href='dadosUsuario.php'">  Voltar  </button>
            </button>
        </div>
    </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>