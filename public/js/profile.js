const phoneMask = (value) => {
    if (!value) return "";
    value = value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
    value = value.replace(/(\d{2})(\d)/, "($1) $2"); // Formata o DDD
    value = value.replace(/(\d{5})(\d{4})$/, "$1-$2"); // Formata o número
    return value;
};

// Função que será chamada no evento de input para formatar o telefone
const handlePhone = (input) => {
    input.value = input.value.replace(/[^0-9]/g, ''); // Remove qualquer caractere não numérico
    input.value = phoneMask(input.value); // Aplica a máscara no valor
};

// Função que adiciona o ouvinte de evento para o campo de telefone
const addPhoneInputListener = () => {
    const phoneInput = document.getElementById('phone');
    console.log('aaaaaaa');
    if (phoneInput) {
        phoneInput.addEventListener('input', (event) => {
            handlePhone(event.target); // Chama a função de formatação ao digitar
        });
    }
};

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
                        <input id="phone" type="text" class="input-field" maxlength="15" name="phone" value="${dataUser.phone}">
                    </div>
                    <button class="update-btn" class="btn" onclick="updateProfile()">Salvar</button>
                    <button class="delete-btn" class="btn" onclick="deleteUser(${dataUser.id})">Deletar</button>
                </form>
            </div>
        </div>
        <div id="confirm-delete-modal" class="confirm-modal">
            <div class="modal-content">
                <h3>Tem certeza que deseja excluir este perfil?</h3>
                <div class="modal-buttons">
                    <button id="confirm-delete-btn" class="btn confirm-btn">Confirmar</button>
                    <button id="cancel-delete-btn" class="btn cancel-btn">Cancelar</button>
                </div>
            </div>
        </div>`;
        
    addProfilePhotoListener();
    setProfileImage();
    addPhoneInputListener();

}


const addProfilePhotoListener = () => {
    const profilePhoto = document.getElementById("profile-hover");

    if (profilePhoto && !profilePhoto.classList.contains('listener-added')) {
        profilePhoto.addEventListener('click', async () => {
            const { value: file } = await Swal.fire({
                title: "Selecione a imagem",
                input: "file",
                inputAttributes: {
                    "accept": "image/*",
                    "aria-label": "Selecione a sua imagem"
                }
            });

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = async (e) => {
                    await Swal.fire({
                        title: "Sua imagem selecionada",
                        imageUrl: e.target.result,
                        imageAlt: "Imagem selecionada"
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
                    title: 'Inválida',
                    text: 'Por favor selecione uma imagem válida!',
                });
            }

        });

        profilePhoto.classList.add('listener-added');
    }
};

// Função para verificar e definir a imagem de perfil
function setProfileImage() {
    const imageFormats = ['profile.png', 'profile.jpg', 'profile.jpeg', 'profile.gif', 'profile.webp'];
    const defaultImage = '../src/uploads/default/profile.png'; // Caminho atualizado da imagem padrão
    const profileImage = document.getElementById('profile-img');
    const userImageDir = `../src/uploads/${dataUser.id}/`;

    if (!profileImage) {
        console.error('Element with id "profile-img" not found!');
        return;
    }

    // Função para verificar a existência da pasta
    function checkFolderExists(path) {
        return fetch(path, { method: 'HEAD' })
            .then(response => response.ok)
            .catch(() => false);
    }

    function checkImageFormat(format) {
        return new Promise((resolve) => {
            const img = new Image();
            // Adiciona um parâmetro de timestamp para evitar cache
            const timestamp = new Date().getTime();
            img.src = `${userImageDir}${format}?t=${timestamp}`;
            img.onload = () => resolve(img.src);
            img.onerror = () => resolve(null);
        });
    }

    async function tryLoadProfileImage() {
        const folderExists = await checkFolderExists(userImageDir);
        if (!folderExists) {
            profileImage.src = defaultImage;
            return;
        }

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
    const phonePattern = /^\(\d{2}\)\s?\d{5}-\d{4}$|^\(\d{2}\)\s?\d{4}-\d{4}$/; // Regex para telefone

    if (!emailPattern.test(email)) {
        alert('Por favor, insira um e-mail válido.');
        return false; // Impede o envio do formulário
    }

    // Verifica se o telefone foi preenchido e se está no formato correto
    if (!phonePattern.test(phone)) {
        alert('Por favor, insira um telefone no formato (xx) x-xxxx ou (xx) xxxx-xxxx.');
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
                }).then(() => {
                    // Redireciona para a página de login
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                });

                await searchUser();
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: data.msg || 'Erro desconhecido.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Ocorreu um problema na operação fetch:', error);
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao tentar atualizar o perfil. Tente novamente mais tarde.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
}

function deleteUser(userId) {
    event.preventDefault(); // Impede o comportamento padrão

    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
    }).then((result) => {
        if (result.isConfirmed) {
            // Configura a URL para a chamada ao PHP
            const url = "../src/manager.php?deleteProfile";
            
            // Configura os dados que serão enviados (neste caso, o ID do usuário)
            const formData = new URLSearchParams();
            formData.append('user_id', userId);

            // Faz a chamada fetch para excluir o usuário
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.msg,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Atualiza a página ou remove o elemento correspondente
                        login()
                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: data.msg || 'Erro desconhecido.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Ocorreu um problema na operação fetch:', error);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao tentar excluir o usuário. Tente novamente mais tarde.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
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