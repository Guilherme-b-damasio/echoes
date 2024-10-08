// Função para aplicar a cor dominante na div de fundo
const applyDominantColor = (imgElement) => {
    if (imgElement.complete) { // Verifica se a imagem já foi carregada
        const colorThief = new ColorThief();
        const color = colorThief.getColor(imgElement);
        document.getElementById('card-img-block').style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
    } else {
        // Aguarda a imagem carregar completamente
        imgElement.onload = () => {
            const colorThief = new ColorThief();
            const color = colorThief.getColor(imgElement);
            document.getElementById('card-img-block').style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
        };
    }
};

// Função para lidar com o upload de foto de perfil
const addProfilePhotoListener = () => {
    const profilePhoto = document.getElementById("profile-hover");
    
    // Adiciona o listener apenas se ainda não foi adicionado
    if (profilePhoto && !profilePhoto.classList.contains('listener-added')) {
        profilePhoto.addEventListener('click', async () => {
            console.log('Aqui editar');

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

                            // Após upload bem-sucedido, cria o novo elemento de imagem
                            const imgElement = document.createElement('img');
                            imgElement.src = data.imagePath;
                            imgElement.crossOrigin = 'anonymous';
                            imgElement.id = 'profile';  // Para usar o ColorThief
                            document.body.appendChild(imgElement);

                            // Aplica a cor dominante à div
                            applyDominantColor(imgElement);

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

        // Marca que o listener foi adicionado
        profilePhoto.classList.add('listener-added');
    }
};

// Função de callback do MutationObserver
const callback = function(mutationsList) {
    // Desliga o observer enquanto modificamos o DOM para evitar loops
    observer.disconnect();

    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            addProfilePhotoListener(); // Adiciona listener de foto de perfil
            const imgElement = document.getElementById('profile');
            if (imgElement) {
                applyDominantColor(imgElement); // Aplica a cor dominante se a imagem existir
            }
        }
    }

    // Religa o observer após as modificações
    observer.observe(targetNode, config);
};

// Observa mutações no DOM
const targetNode = document.body;
const config = { childList: true, subtree: true };
const observer = new MutationObserver(callback);

// Inicializa no carregamento da página
document.addEventListener('DOMContentLoaded', () => {
    const imgElement = document.getElementById('profile');
    if (imgElement) {
        applyDominantColor(imgElement); // Aplica a cor dominante se a imagem já estiver no DOM
    }

    addProfilePhotoListener(); // Adiciona o evento de click para upload
    observer.observe(targetNode, config); // Começa a observar mutações no DOM
});
