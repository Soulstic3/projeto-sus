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