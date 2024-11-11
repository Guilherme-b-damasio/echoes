function login() {
    window.location.href = "?login";
}

const container = document.querySelector('.container');
const LoginLink = document.querySelector('.SignInLink');
const RegisterLink = document.querySelector('.SignUpLink');

function loadSongsForPlaylist(playlistId) {
    fetch(`../src/list_songs.php?playlist=${playlistId}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                setMusicList(data);
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}


async function loadSongs(data) {
    for (const playlist of data) {
        const response = await fetch('../src/list_songs.php?playlist=' + playlist.id);
        const data = await response.json();
        if (data && data.length > 0) {

            let html = '';
            const list = document.getElementById('list-' + playlist.id);

            data.forEach(music => {
                html +=
                    `<div class="item">
                    <span class="" data-perso="${music.perso_id}" id="${music.ID}-perso" onclick='saveMusicInPlaylist(${music.ID})' style="color:${music.perso_id != '' ? 'blue' : 'orange'};"></span>
                    <span class="" data-liked="${music.liked}" id="${music.ID}" onclick='saveMusic(${music.ID})' style="color:${music.liked != 'false' ? 'green' : 'white'};"></span>
                                <img src="${music.image}" alt="Album Art" />
                                <div class="play">
                                    <span class="fa fa-play" onclick='playerMusic(${music.ID},${playlist.id})'></span>
                                </div>
                                <h4 class="song-title">${music.name}</h4>
                                <h4 class="autor-name">${music.autor}</h4>
                                </div>`;
            });
            list.innerHTML = html;
        }
    }
}



async function loadPlaylist() {
    try {
        const response = await fetch('../src/list_playlist.php');
        const data = await response.json();

        if (data && data.length > 0) {
            let html = '';
            const list = document.getElementById('main-container');

            data.forEach(playlist => {
                html += `<div class="playlists">
                            <div class="playlist-title">
                                <h2>${playlist.name}</h2>
                                <div class="playlist-buttons">
                                    <div class="button-left" onclick="scrollLeftPlaylist(${playlist.id})">
                                        <span class="fa-solid fa-chevron-left"></span>
                                    </div>
                                    <div class="button-right" onclick="scrollRightPlaylist(${playlist.id})">
                                        <span class="fa-solid fa-chevron-right"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="list" id="list-${playlist.id}"></div>
                         </div>`;
            });

            list.innerHTML = html;

            if (data.length > 0) {
                //loadSongsForPlaylist(data[0].id);
            }

            loadSongs(data);
        }
    } catch (error) {
        console.error('Erro ao carregar playlists:', error);
    }
}

function scrollLeftPlaylist(playlistId) {
    const container = document.getElementById('list-' + playlistId);

    if (container.scrollLeft > 0) {
        container.scrollLeft -= 300; // Ajuste o valor conforme necessário para a quantidade de rolagem
    }
}

function scrollRightPlaylist(playlistId) {
    const container = document.getElementById('list-' + playlistId);
    container.scrollLeft += 300; // Ajuste o valor conforme necessário para a quantidade de rolagem
}

function playerMusic(ID, playlist) {
    fetch(`../src/search_songs.php?music=${ID}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                setMusicList(data, ID);
                document.getElementById('nextButton').setAttribute('data-music', ID);
                document.getElementById('nextButton').setAttribute('data-playlist', playlist);
                document.getElementById('nextButton').setAttribute('data-liked', '0');
                document.getElementById('nextButton').setAttribute('data-perso', '0');
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}


function saveMusic(){

    let heart = document.getElementById('liked-btn');
    let element = document.getElementById('nextButton');
    let ID = element.getAttribute('data-music');
    let liked = heart.getAttribute('data-liked');
    let option = liked != 'false' ? 'delete' : 'update';

    heart.setAttribute('data-liked', liked == 'true' ? 'false' : 'true'); 

    fetch(`../src/setLiked.php?music=${ID}&option=${option}`)
        .then(response => response.json())
        .then(data => {
            if(data){
                if (liked == 'false') {
                    heart.style.color = 'green';
                }else{
                    heart.style.color = 'white';
                }
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}

async function saveMusicInPlaylist() {
    try {
        let element = document.getElementById('nextButton');
        let ID = element.getAttribute('data-music');
        const response = await fetch('../src/playlistManager.php?option=select'); 
        const playlists = await response.json();

        const inputOptions = {};
        playlists.forEach(playlist => {
            inputOptions[playlist.ID] = playlist.name; 
        });

        const { value: selectedPlaylistId } = await Swal.fire({
            title: "Selecione a playlist",
            input: "select",
            inputOptions: inputOptions,
            inputValidator: (value) => {
                if (!value) {
                    return "You need to choose a playlist!";
                }
            }
        });

        if (selectedPlaylistId) {
            saveInPlaylist(selectedPlaylistId, ID);
        }

       
    } catch (error) {
        console.error('Erro ao carregar playlists:', error);
    }
}

function saveInPlaylist(selectedPlaylistId, ID){
    let heart = document.getElementById(ID + '-perso');
    let perso = heart.getAttribute('data-perso');
    let option = perso !== 'false' ? 'delete' : 'update';

    heart.setAttribute('data-perso', perso === 'true' ? 'false' : 'true');

    fetch(`../src/playlistManager.php?music=${ID}&option=set&perso_id=${selectedPlaylistId}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                heart.style.color = perso === 'false' ? 'blue' : 'orange';
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}
