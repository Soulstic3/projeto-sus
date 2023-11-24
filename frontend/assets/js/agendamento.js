function validarFormulario() {
    const opcao1 = document.getElementById('option1').checked;
    const opcao2 = document.getElementById('option2').checked;
    const opcao3 = document.getElementById('option3').checked;

    if (!(opcao1 || opcao2 || opcao3)) {
        alert('Por favor, selecione um tipo de consulta.');
        return false;
    }

    const dateInput = document.getElementById('dataConsulta');
    const selectedDate = new Date(dateInput.value);
    const today = new Date();

    const currentDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

    if (selectedDate < currentDate) {
        alert('Por favor, selecione uma data futura ou o dia de hoje.');
        return false;
    }

    return true;
}
