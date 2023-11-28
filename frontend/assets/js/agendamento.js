
      document.getElementById('agendamentoForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita o envio padrão do formulário

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

        // Se tudo estiver validado, faz a requisição AJAX
        const formData = new FormData(this);

        fetch('../../backend/agendamento/realizar_agendamento.php', {
    method: 'POST',
    body: formData
})
.then(response => {
    if (!response.ok) {
        throw new Error('Erro na requisição.');
    }
    return response.json();
})
.then(data => {
    // Verifica se a resposta indica sucesso (pode variar dependendo da estrutura da resposta do servidor)
    if (data && data.success) {
        // Mostra um alerta indicando que a consulta foi marcada
        alert('Consulta marcada com sucesso!');
    } else {
        // Se a resposta indicar falha, exibe um alerta de erro (ou realiza outra ação com base na resposta do servidor)
        alert('Erro ao marcar a consulta. Tente novamente.');
    }
})
.catch(error => {
    // Exibe um alerta se houver um erro na requisição AJAX
    alert('Ocorreu um erro na requisição. Verifique sua conexão ou tente novamente mais tarde.');
    console.error('Erro na requisição:', error);
});
    });


