<?php
session_start();
require_once "../../backend/verificar_usuario.php"; // Arquivo com a função verificarUsuarioLogado()

// Verifica se o usuário está logado
if (verificarUsuarioLogado()) {
    // Obtém o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta SQL para buscar os dados do usuário pelo ID
    $query = "SELECT nome, cpf, nascimento, cartao_sus, sexo, telefone FROM usuario WHERE id_usuario = $id_usuario";

    $result = mysqli_query($conn, $query); 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $nascimento = $row['nascimento'];
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const enviarDadosButton = document.getElementById('enviarDados');

    enviarDadosButton.addEventListener('click', function () {
        const enderecoUsuario = 'Valor do endereço'; // Obtenha o valor do campo de endereço
        const bairroUsuario = 'Valor do bairro'; // Obtenha o valor do campo de bairro
        const cepUsuario = 'Valor do CEP'; // Obtenha o valor do campo de CEP

        // Cria um objeto FormData para enviar os dados
        const formData = new FormData();
        formData.append('enderecoUsuario', enderecoUsuario);
        formData.append('bairroUsuario', bairroUsuario);
        formData.append('cepUsuario', cepUsuario);

        fetch('../../backend/usuario/cadastroEndereco.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Se o cadastro foi concluído com sucesso, faça alguma ação, como exibir uma mensagem
                alert(data.message);
            } else {
                // Se houver um erro no cadastro, exiba uma mensagem de erro
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            // Em caso de erro na requisição, exiba uma mensagem de erro genérica
            console.error('Erro ao processar a requisição:', error);
            alert('Erro ao processar a requisição. Por favor, tente novamente mais tarde.');
        });
    });
});
</script>
    <title>Seu Perfil</title>
</head>

<body>
<header>
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
                      <a class="nav-link" href="consultas.php">Ver Consultas</a>
                    </li>
                    <li class="nav-item mx-lg-2">
                      <a class="nav-link" href="dadosUsuario.php">Ver Perfil</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
</header>

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
                    <button class="botao" onclick="mostrarFormulario()">Cadastrar Endereço</button>
                    
                </div>
            </div>

        </section>
    </main>
    <div id="containerCadastro" class="container-popup">
    <!-- Formulário para cadastro de endereço -->
    <form id="formCadastroEndereco" method="post" action>
        <div>
            <label for="endereco">Endereço:</label><br>
            <input type="text" id="enderecoUsuario" name="enderecoUsuario" placeholder="Rua Silas Kow N60"><br><br>
        </div>
        <div>
            <label for="bairro">Bairro:</label><br>
            <input type="text" id="bairroUsuario" name="bairroUsuario" placeholder="Salgado"><br><br>
        </div>
        <div>
            <label for="cep">CEP:</label><br>
            <input type="text" id="cepUsuario" name="cepUsuario" placeholder="55040-075"><br><br>
        </div>
        <button class="botao" type="submit" id="enviarDados">  Salvar Endereço  </button>
    </form>
</div>

    <!-- Overlay (fundo escuro) que cobrirá a tela quando o formulário estiver aberto -->
    <div id="overlay"></div>
    <script>
        function mostrarFormulario() {
            var formulario = document.getElementById('containerCadastro');
            var overlay = document.getElementById('overlay');

            // Exibe o formulário e o overlay
            formulario.style.display = 'block';
            overlay.style.display = 'block';
        }

        function fecharFormulario() {
            var formulario = document.getElementById('containerCadastro');
            var overlay = document.getElementById('overlay');

            // Oculta o formulário e o overlay
            formulario.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Fecha o formulário se o usuário clicar fora dele
        window.onclick = function (event) {
            var formulario = document.getElementById('containerCadastro');
            var overlay = document.getElementById('overlay');

            if (event.target == overlay) {
                formulario.style.display = 'none';
                overlay.style.display = 'none';
            }
        };
    </script>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>