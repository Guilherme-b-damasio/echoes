function login() {
    // Seleciona o formulário e adiciona um ouvinte de evento para o envio
    let form = document.getElementById("form-login");
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        let formData = new FormData(form);

        // Converte FormData para um objeto JSON
        let formObject = {};
        formData.forEach(function (value, key) {
            formObject[key] = value;
        });

        let url = "../src/manager.php?login";

        $.ajax({
            url: url,
            method: 'POST',
            data: formObject,
            success: function (response) {
                // Verifica se a resposta indica sucesso ou erro
                if (response.success) {
                    // Redireciona para a página inicial se o login for bem-sucedido
                    window.location.href = "../../public/index.php";
                } else {
                    // Exibe uma mensagem de erro se o login falhar
                    Swal.fire({
                        title: 'Erro!',
                        text: response.message || 'Credenciais inválidas.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('There was a problem with the AJAX request:', textStatus, errorThrown);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao processar a solicitação.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
}
