function login() {
    window.location.href = "?login"
}

const container = document.querySelector('.container');
const LoginLink = document.querySelector('.SignInLink');
const RegisterLink = document.querySelector('.SignUpLink');

window.onload = function () {
    //loadSongs();
    loadPlaylist();
}

function playerMusic(music) {
    songs = music;
    prevNextMusic("init");
    console.log("")
}

function loadSongs() {
    fetch('../src/list_songs.php')
        .then(response => response.json())
        .then(data => {
            if (data != '') {
                let musics = '';
                let html = '';

                musics = data;
                list = document.getElementById('list');

                musics.forEach(music => {
                    html += 
                    `<div class="item">
                        <img src="${music.image}" alt="Album Art" />
                        <div class="play">
                            <span class="fa fa-play" onclick='playerMusic('${music}')'></span>
                        </div>
                        <h4>${music.music_name}</h4>
                      </div>`
                });

                list.innerHTML = html;
                songs = data;
            }
            playerMusic(data);
        })
        .catch(error => console.error('Erro ao carregar músicas:', error));
};

function loadPlaylist() {

    fetch('../src/list_playlist.php')
        .then(response => response.json())
        .then(data => {
            playlists = data;

            if (playlists != '') {
                let html = '';
                let list = '';

                list = document.getElementById('main-container');

                playlists.forEach(playlist => {
                    html += `<div class="playlists" id="playlists">
                                <h2>${playlist.name}</h2>
                                <div class="list" id="list"></div>
                             </div>`
                });

                list.innerHTML = html;

                loadSongs();
            }
        })
        .catch(error => console.error('Erro ao carregar playlists:', error));
};
