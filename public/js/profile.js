function loadProfile() {
    const container = document.getElementById('main-container');
    container.innerHTML =
        `<link rel="stylesheet" href="assets/css/profile.css">
    
        <div class="profile-container">
            <div class="card profile-card-2">
                <div id="card-img-block" class="card-img-block">
                </div>
                <div class="card-body pt-5">
                    <img id="profile-img" class="profile" alt="profile-image" src="">
                    <div id="profile-hover" class="profile-hover">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <p class="text-photo">Alterar foto</p>
                    </div>
                    <div class="profile-text">
                        <h5 class="card-title">${dataUser.login}</h5>
                    </div>
                </div>
            </div>
            <div class="profile-body">
                <form class="form-update" id="form-update">
                    <div class="form-input">
                        <label class="name-input" for="user">Usuário</label>
                        <input type="text" class="input-field" name="login" value="${dataUser.login}">
                    </div>
                    <div class="form-input">
                        <label class="name-input" for="name">Nome</label>
                        <input type="text" class="input-field" name="name" value="${dataUser.name}">
                    </div>
                    <div class="form-input">
                        <label class="name-input" for="email">Email</label>
                        <input type="text" class="input-field" name="email" value="${dataUser.email}">
                    </div>
                    <div class="form-input">
                        <label class="name-input" for="phone">Telefone</label>
                        <input type="text" class="input-field" name="phone" value="${dataUser.phone}">
                    </div>
                    <button class="update-btn" class="btn" onclick="updateProfile()">Salvar</button>
                </form>
            </div>
        </div>`;

    addProfilePhotoListener();
    setProfileImage();
}


const addProfilePhotoListener = () => {
    const profilePhoto = document.getElementById("profile-hover");

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

                            setProfileImage(); // Atualiza a imagem após o upload
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

        profilePhoto.classList.add('listener-added');
    }
};

// Função para verificar e definir a imagem de perfil
function setProfileImage() {
    const imageFormats = ['profile.png', 'profile.jpg', 'profile.jpeg', 'profile.gif', 'profile.webp'];
    const defaultImage = '../src/images/default-profile.png';
    const profileImage = document.getElementById('profile-img');

    if (!profileImage) {
        console.error('Element with id "profile" not found!');
        return;
    }

    function checkImageFormat(format) {
        return new Promise((resolve) => {
            const img = new Image();
            // Adiciona um parâmetro de timestamp para evitar cache
            const timestamp = new Date().getTime();
            img.src = `../src/uploads/${dataUser.id}/${format}?t=${timestamp}`;
            img.onload = () => resolve(img.src);
            img.onerror = () => resolve(null);
        });
    }

    async function tryLoadProfileImage() {
        for (const format of imageFormats) {
            const imageSrc = await checkImageFormat(format);
            if (imageSrc) {
                profileImage.src = imageSrc;
                return;
            }
        }
        profileImage.src = defaultImage;
    }

    tryLoadProfileImage();
}


// Função de callback do MutationObserver
const callback = function (mutationsList) {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            addProfilePhotoListener(); // Adiciona listener de foto de perfil
        }
    }
};

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

async function updateProfile() {
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
        .then(async data => {
            if (data && data.status) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

                await searchUser();
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
                text: data.msg,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
}

async function searchUser() {
    let url = "../src/manager.php?searchUser=1";

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
    })
        .then(response => response.json())
        .then(data => {
            dataUser = data;
            location.reload();
        })
   
    return;
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