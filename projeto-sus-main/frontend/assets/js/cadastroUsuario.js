

        function mostrarFormulario() {
            const loginContainer = document.getElementById('loginContainer');
            loginContainer.style.display = 'block';
        }
    
        function mostrarForm(formulario) {
            const loginForm = document.getElementById('formLogin');
            const cadastroForm = document.getElementById('formCadastro');
            const btnLogin = document.getElementById('btnLogin');
            const btnCadastro = document.getElementById('btnCadastro');
    
            if (formulario === 'login') {
                loginForm.classList.add('active');
                cadastroForm.classList.remove('active');
                btnLogin.classList.add('active');
                btnCadastro.classList.remove('active');
            } else if (formulario === 'cadastro') {
                cadastroForm.classList.add('active'); // Adiciona a classe 'active' ao formulário de cadastro
                loginForm.classList.remove('active');
                btnCadastro.classList.add('active'); // Ativa o botão de cadastro
                btnLogin.classList.remove('active');
            }
        }

        function validarSenha() {
    const senha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    const mensagemErro = document.getElementById('mensagemErro');

    if (senha !== confirmarSenha) {
        mensagemErro.textContent = 'As senhas não coincidem!';
    } else {
        mensagemErro.textContent = '';
    }
}

function validarFormulario() {
    const nome = document.getElementById('nome').value;
    // Validação de outros campos...

    const senha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;

    if (
        nome === '' ||
        // Outras validações...
        senha === '' ||
        confirmarSenha === '' ||
        senha !== confirmarSenha
    ) {
        alert('Por favor, preencha todos os campos corretamente.');
        return false;
    }

    return true;
}
    
        // Oculta o contêiner ao clicar fora dele
        document.addEventListener('click', function hideLoginContainer(event) {
            const loginContainer = document.getElementById('loginContainer');
            if (!loginContainer.contains(event.target) && event.target.tagName !== 'BUTTON') {
                loginContainer.style.display = 'none';
            }
        });

        function validarFormulario() {
            const nome = document.getElementById('nome').value;
            const cartaoSus = document.getElementById('cartao_sus').value;
            const novoCPF = document.getElementById('novoCPF').value;
            const telefone = document.getElementById('telefone').value;
            const nascimento = document.getElementById('nascimento').value;
            const sexo = document.getElementById('sexo').value;
            const novaSenha = document.getElementById('novaSenha').value;
            const confirmarSenha = document.getElementById('confirmarSenha').value;
        
            if (
                nome === '' ||
                cartaoSus === '' ||
                novoCPF === '' ||
                telefone === '' ||
                nascimento === '' ||
                sexo === '' ||
                novaSenha === '' ||
                confirmarSenha === ''
            ) {
                alert('Por favor, preencha todos os campos.');
                return false;
            }
        
            return true;
        }
        