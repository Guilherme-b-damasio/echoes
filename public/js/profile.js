// Função para adicionar o evento ao profilePhoto
const addProfilePhotoListener = () => {
    const profilePhoto = document.getElementById("profile-hover");

    if (profilePhoto) {
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

            if (file) {
                // Verifica se o arquivo é uma imagem
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = async (e) => {
                        // Exibe a imagem carregada
                        await Swal.fire({
                            title: "Your uploaded picture",
                            imageUrl: e.target.result,
                            imageAlt: "The uploaded picture"
                        });

                        // URL do servidor para upload da imagem
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
            } else {
                console.log('File selection was cancelled.');
            }
        });
    }
};

// Selecionar o nó alvo para observar
const targetNode = document.body;
const config = { childList: true, subtree: true };

// Callback que será executada quando mudanças forem observadas
const callback = function(mutationsList) {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList') {
            addProfilePhotoListener(); // Tenta adicionar o listener
        }
    }
};

// Crie uma instância do observer
const observer = new MutationObserver(callback);

// Comece a observar o nó alvo
observer.observe(targetNode, config);
