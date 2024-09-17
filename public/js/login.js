function login() {
    let form = document.getElementById("form-login");
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(form);
        let params = new URLSearchParams(formData).toString();

        let url = "../src/manager.php?login";

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: params
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                window.location.href = "../public/?home";
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

function register(){
    let form = document.getElementById("form-register");
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(form);

        let formObject = {};
        formData.forEach(function (value, key) {
            formObject[key] = value;
        });

        let url = "../src/manager.php?register";

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(formObject)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                Swal.fire({
                    title: "Sucesso",
                    icon: 'sucess',
                    text: "Cadastro Efetuado com Sucesso!",
                    confirmButtonText: "Logar",
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../public/?login";
                    }
                  });
                
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.msg || 'Credenciais inválidas.',
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

function reset() {
    let form = document.getElementById("form-reset2");
    
        event.preventDefault();

        let formData = new FormData(form);
        let params = new URLSearchParams(formData).toString();

        let url = "../manager.php?resetpass";

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: params
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.message || 'Senha Alterada com Sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
                window.location.href = "../public/?login";
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.message || 'Senha não Alterada',
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
        
}

function resetPassword() {
        let form = document.getElementById("form-reset");
        form.addEventListener('submit', function (event) {
            event.preventDefault();
        let formData = new FormData(form);
        let params = new URLSearchParams(formData).toString();
        
        let url = "../src/manager.php?reset";

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: params
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.message || 'E-mail Enviado com Sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.message || 'Não foi Possiível enviar o E-mail',
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

// RegisterLink.addEventListener('click', () =>{
//     container.classList.add('active');
// })

// LoginLink.addEventListener('click', () => {
//     container.classList.remove('active');
// })
