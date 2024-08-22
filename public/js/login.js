function login() {
    let form = document.getElementById("form-login");
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(form);

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
                if (response) {
                    window.location.href = "../public/index.php";
                } else {
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
