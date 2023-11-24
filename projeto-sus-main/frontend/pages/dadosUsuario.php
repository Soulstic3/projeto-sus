<?php
session_start(); // Inicia a sessão
require_once "../../backend/verificar_usuario.php"; // Arquivo com a função verificarUsuarioLogado()

// Verifica se o usuário está logado
if (verificarUsuarioLogado()) {
    // Obtém o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta SQL para buscar os dados do usuário pelo ID
    $query = "SELECT nome, cpf, nascimento, endereco, cartao_sus, sexo, telefone FROM usuario WHERE id_usuario = $id_usuario";

    $result = mysqli_query($conn, $query); 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $nascimento = $row['nascimento'];
        $endereco = $row['endereco'];
        $cartao_sus = $row['cartao_sus'];
        $sexo = $row['sexo'];
        $telefone = $row['telefone'];
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dadosUsuario.css">
    <script src="http://localhost/frontend/assets/js/cadastroEndereco.js"></script>
    <title>Dados do Usuário</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f0f0f0;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="../assets/img/2560px-Logo_SUS.svg.png" alt="" width="85" height="44">
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
                <li class="nav-item">
                  <a class="nav-link active mx-lg-2" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item mx-lg-2">
                  <a class="nav-link" href="#">Agendar Consulta</a>
                </li>
                <li class="nav-item mx-lg-2">
                  <a class="nav-link" href="#">Ver Consultas</a>
                </li>
                <li class="nav-item mx-lg-2">
                  <a class="nav-link" href="#">Ver Perfil</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

    <main>
        
        <section class="container-fluid min-vh-100">
            <div class="row">
                <div class="dados1">
                    <div class="col-md-12">
                        <div class="icone_usuario">
                            <img src="../assets/img/usuario.png" alt="usuario" class="icone_usuario">
                            <?php if (isset($nome) && !empty($nome)) { ?>
                            <h5><?php echo $nome; ?></h5><br>
                            <?php } else { ?>
                            <h5>Nome do Usuário</h5><br>
                            <?php } ?>
                            <h4>Seus dados:</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="containers">
                        <p>CPF:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($cpf) ? $cpf : ''; ?>" readonly>
                    </div>
                    <br>
                    <div class="containers">
                        <p>Data de Nascimento:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($nascimento) ? $nascimento : ''; ?>" readonly>
                    </div>
                    <br>
                    <div class="containers">
                        <p>Número do Cartão:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($cartao_sus) ? $cartao_sus : ''; ?>" readonly>
                    </div>
                    <br>
                    <div class="containers">
                        <p>Sexo:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($sexo) ? $sexo : ''; ?>" readonly>
                    </div>
                    <br>
                    <div class="containers">
                        <p>Telefone:</p>
                        <input type="tel" class="campo-estatico" value="<?php echo isset($telefone) ? $telefone : ''; ?>" readonly>
                    </div>
                    <br>
                </div>

                <div class="col-md-6 ">
                    <div class="containers">
                        <p>Endereço:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($endereco) ? $endereco : ''; ?>" readonly>
                    </div>
                    <div class="containers">
                        <p>Bairro:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($endereco) ? $endereco : ''; ?>" readonly>
                    </div>
                    <div class="containers">
                        <p>CEP:</p>
                        <input type="text" class="campo-estatico" value="<?php echo isset($endereco) ? $endereco : ''; ?>" readonly>
                    </div>
                    <br>
                    <button onclick="mostrarCadastroEndereco()">Cadastrar Endereço</button>
                    
                </div>
            </div>

        </section>
    </main>
    


    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>