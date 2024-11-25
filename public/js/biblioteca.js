async function loadSongPerso(data) {
    for (const playlist of data) {
        const response = await fetch('../src/playlistManager.php?option=songs&perso_id=' + playlist.ID);
        const data = await response.json();
        const list = document.getElementById('list-' + playlist.ID);
        if (data && data.length > 0) {
            let html = '';

            data.forEach(music => {
                html +=
                    `<div class="item">
                    <span class="bi bi-music-note-list" data-perso="" data-liked="" id="${music.ID}" onclick='saveMusic(${music.ID})'"></span>
                                <img src="${music.image}" alt="Album Art" />
                                <div class="play">
                                    <span class="fa fa-play" onclick='playerMusicPerso(${music.ID},${playlist.ID})'></span>
                                </div>
                                <h4 class="song-title">${music.name}</h4>
                                <h4 class="autor-name">${music.autor}</h4>
                                </div>`;
            });
            list.innerHTML = html;
        } else {
            list.innerHTML = '<h4 class="song-title">Nenhuma música foi adicionada na playlist</h4>';
        }
    }
}

async function deletePerso(ID) {
    event.preventDefault(); // Impede o comportamento padrão

    // Exibe o SweetAlert para confirmação
    Swal.fire({
        title: 'Tem certeza?',
        text: "Deseja realmente excluir esta playlist? Essa ação não pode ser desfeita.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                // Faz a requisição para deletar a playlist
                const response = await fetch(`../src/playlistManager.php?option=delete&perso_id=${ID}`);
                const data = await response.json();

                // Verifica o status do retorno
                if (data) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'A playlist foi excluída com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        // Recarrega as playlists ou atualiza a página
                        loadPlaylistPerso();
                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: data.msg || 'Ocorreu um erro ao excluir a playlist.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                }
            } catch (error) {
                console.error('Erro ao excluir a playlist:', error);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível excluir a playlist. Tente novamente mais tarde.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
}


// async function deletePerso(ID) {
//     try {
//         const response = await fetch(`../src/playlistManager.php?option=delete&perso_id=${ID}&option=delete`);
//         const data = await response.json();

//         if (data) {
//             loadPlaylistPerso();
//         }
//     } catch (error) {
//         console.error('Erro ao carregar playlists:', error);
//     }
// }

async function loadPlaylistPerso() {
    try {
        const response = await fetch('../src/playlistManager.php?option=select');
        const data = await response.json();

        const list = document.getElementById('main-container');
        if (data && data.length > 0) {
            let html = '';
            list.innerHTML = html;

            data.forEach(playlist => {
                html += `<div class="playlists">
                            <div class="playlist-title">
                                <div class="playlist-name">
                                    <h2>${playlist.name}</h2>
                                    <div class="delete" onclick="deletePerso(${playlist.ID})">
                                        <span class="fa-solid fa-trash" onclick="deletePerso(${playlist.ID})"></span>
                                    </div>
                                </div>
                                <div class="playlist-buttons">
                                    <div class="button-left" onclick="scrollLeftPlaylist(${playlist.ID})">
                                        <span class="fa-solid fa-chevron-left"></span>
                                    </div>
                                    <div class="button-right" onclick="scrollRightPlaylist(${playlist.ID})">
                                        <span class="fa-solid fa-chevron-right"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="list" id="list-${playlist.ID}"></div>
                         </div>`;
            });

            list.innerHTML = html;

            loadSongPerso(data);
        } else {
            list.innerHTML = '';
        }
    } catch (error) {
        console.error('Erro ao carregar playlists:', error);
    }
}

function scrollLeftPlaylist(playlistId) {
    const container = document.getElementById('list-' + playlistId);

    if (container.scrollLeft > 0) {
        container.scrollLeft -= 500; // Ajuste o valor conforme necessário para a quantidade de rolagem
    }
}

function scrollRightPlaylist(playlistId) {
    const container = document.getElementById('list-' + playlistId);
    container.scrollLeft += 500; // Ajuste o valor conforme necessário para a quantidade de rolagem
}

function playerMusicPerso(ID, playlist) {
    fetch(`../src/search_songs.php?music=${ID}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                setMusicList(data, ID);
                document.getElementById('nextButton').setAttribute('data-music', ID);
                document.getElementById('nextButton').setAttribute('data-playlist', playlist);
                document.getElementById('nextButton').setAttribute('data-liked', '0');
                document.getElementById('nextButton').setAttribute('data-perso', '1');
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}
