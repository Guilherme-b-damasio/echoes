// Função para aplicar a cor dominante na div de fundo
// const applyDominantColor = (imgElement) => {
//     if (imgElement.complete) { // Verifica se a imagem já foi carregada
//         const colorThief = new ColorThief();
//         const color = colorThief.getColor(imgElement);
//         document.getElementById('card-img-block').style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
//     } else {
//         // Aguarda a imagem carregar completamente
//         imgElement.onload = () => {
//             const colorThief = new ColorThief();
//             const color = colorThief.getColor(imgElement);
//             document.getElementById('card-img-block').style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
//         };
//     }
// };

// Função para lidar com o upload de foto de perfil
// Função que adiciona o event listener para alterar a foto do perfil
const addProfilePhotoListener = () => {
    
    const profilePhoto = document.getElementById("profile-hover");
    console.log('Aqui editar');
    // Adiciona o listener apenas se ainda não foi adicionado
    if (profilePhoto && !profilePhoto.classList.contains('listener-added')) {
        profilePhoto.addEventListener('click', async () => {

            const { value: file } = await Swal.fire({
                title: "Select image",
                input: "file",
                inputAttributes: {
                    "accept": "image/*",
                    "aria-label": "Upload your profile picture"
                }
            });

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = async (e) => {
                    await Swal.fire({
                        title: "Your uploaded picture",
                        imageUrl: e.target.result,
                        imageAlt: "The uploaded picture"
                    });

                    const url = '../src/saveImage.php';
                    const formData = new FormData();
                    formData.append('image', file);

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData
                        });

                        const data = await response.json();
                        if (response.ok) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success'
                            });
                            
                            loadPage('profile');

                        } else {
                            throw new Error(data.message || 'Error uploading image.');
                        }
                    } catch (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: error.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                };

                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please upload a valid image file!',
                });
            }

        });              
    }
    if (!profilePhoto) {
        console.error("Elemento 'profile-hover' não encontrado no DOM");
        return; // Sai da função se o elemento não existir
    }
    if (profilePhoto) {
        console.error("Elemento 'profile-hover' foi encontrado no DOM");
        return; // Sai da função se o elemento não existir
    }
    // Marca que o listener foi adicionado
    profilePhoto.classList.add('listener-added');
};

// Função de callback do MutationObserver
const callback = function(mutationsList) {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            addProfilePhotoListener(); // Adiciona listener de foto de perfil
        }
    }
};

// Observa mutações no contêiner de perfil (pode ser mais eficiente que observar todo o body)
const profileContainer = document.querySelector('.profile-container');
const config = { childList: true, subtree: true };
const observer = new MutationObserver(callback);

// Inicializa no carregamento da página
document.addEventListener('DOMContentLoaded', () => {
    console.log('Carregou o DOM');
    addProfilePhotoListener(); // Adiciona o evento de click para upload
    if (profileContainer) {
        observer.observe(profileContainer, config); // Começa a observar mutações no contêiner de perfil
    }
});

function loadPage(page) {
   // showOverlay();
   
    //container.classList.add('fade-out');
    setTimeout(() => {
        fetch('index.php?' + new URLSearchParams({ page: page, ajax: 'true' }))
            .then(handleResponse)
            .then(html => updateContent(html, page))
            .catch(error => {
                console.error(error);
               // hideOverlay();
            });
    }, 500);
   // hideOverlay();
}

function handleResponse(response) {
    if (!response.ok) {
        throw new Error('Request error: ' + response.status);
    }
    return response.text();
}


function updateContent(html, page) {
    let container = document.getElementById('main-container');
    container.innerHTML = html;

    if (page === 'profile') {
        addProfilePhotoListener();
        
    }

    window.history.pushState({}, '', '?' + page);
}

function validateProfileForm() {
    const email = document.querySelector('input[name="email"]').value;
    const phone = document.querySelector('input[name="phone"]').value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex para validação de e-mail
    const phonePattern = /^\d{10,15}$/; // Regex para telefone com ou sem parênteses

    if (!emailPattern.test(email)) {
        alert('Por favor, insira um e-mail válido.');
        return false; // Impede o envio do formulário
    }

    // Verifica se o telefone foi preenchido
    if (phone && !phonePattern.test(phone)) {
        alert('Por favor, insira um telefone no formato (xx) x-xxxx ou xx x-xxxx.');
        return false; // Impede o envio do formulário
    }

    return true; // Permite o envio do formulário
}

function updateProfile() {
    event.preventDefault(); // Impede o envio do formulário padrão

    if (!validateProfileForm()) {
        return; // Se a validação falhar, não continua
    }

    let form = document.getElementById("form-update");
    const formData = new URLSearchParams(new FormData(form));    

    let url = "../src/manager.php?updateProfile";

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

// Máscara para o campo telefone
const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g, '')
    value = value.replace(/(\d{2})(\d)/, "($1) $2")
    value = value.replace(/(\d)(\d{4})$/, "$1-$2")
    return value
}