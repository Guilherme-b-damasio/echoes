function login() {
    let form = document.getElementById("form-login");
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
}

document.getElementById("form-login").addEventListener('submit', function (event) {
    event.preventDefault();
    login();
});

document.getElementById("form-register").addEventListener('submit', function (event) {
    event.preventDefault();
    register();
});

document.getElementById("form-reset").addEventListener('submit', function (event) {
    event.preventDefault();
    resetPassword();
});

document.getElementById("form-reset-pass").addEventListener('submit', function (event) {
    event.preventDefault();
    reset();
});


function register() {
    let form = document.getElementById("form-register");
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
                    icon: 'success',
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
}

function reset() {
    let form = document.getElementById("form-reset-pass");
    const formData = new URLSearchParams(new FormData(form));
    let url = "../manager.php?resetpass";

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data && data.type == "success") {
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.msg,
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
function loadOpen(){
    document.getElementById('loader').style.display = 'flex';
    document.getElementById('dolphin').style.display = 'flex';
    document.getElementById('overlay').style.display = 'flex';
}

function loadClose(){
    document.getElementById('loader').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('dolphin').style.display = 'none';
}

function resetPassword() 
{
    let form = document.getElementById("form-reset");
    let formData = new FormData(form);
    let params = new URLSearchParams(formData).toString();

    loadOpen();

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
            loadClose();
            if (data.status) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.msg,
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

// RegisterLink.addEventListener('click', () =>{
//     container.classList.add('active');
// })

// LoginLink.addEventListener('click', () => {
//     container.classList.remove('active');
// })
