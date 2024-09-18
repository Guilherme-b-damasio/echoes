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
                                <img src="${music.image}" alt="Album Art" />
                                <div class="play">
                                    <span class="fa fa-play" onclick='playerMusic(${music.ID})'></span>
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
                            <h2>${playlist.name}</h2>
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

function playerMusic(ID) {

    fetch(`../src/search_songs.php?music=${ID}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                setMusicList(data, ID);
                document.getElementById('nextButton').setAttribute('data-music', ID);
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}

window.onload = function () {
    loadPlaylist();
}
