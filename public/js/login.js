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

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(formObject)
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                window.location.href = "../public/index.php";
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.message || 'Credenciais inválidas.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao processar a solicitação.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
        
    });
}
