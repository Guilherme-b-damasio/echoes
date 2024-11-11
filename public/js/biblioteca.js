async function loadSongPerso(data) {
    for (const playlist of data) {
        const response = await fetch('../src/playlistManager.php?option=songs&perso_id='+playlist.ID);
        const data = await response.json();
        if (data && data.length > 0) {
            let html = '';
            const list = document.getElementById('list-' + playlist.ID);

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
        }
    }
}



async function loadPlaylistPerso() {
    try {
        const response = await fetch('../src/playlistManager.php?option=select');
        const data = await response.json();

        if (data && data.length > 0) {
            let html = '';
            const list = document.getElementById('main-container');

            data.forEach(playlist => {
                html += `<div class="playlists">
                            <h2>${playlist.name}</h2>
                            <div class="list" id="list-${playlist.ID}"></div>
                         </div>`;
            });

            list.innerHTML = html;

            loadSongPerso(data);
        }
    } catch (error) {
        console.error('Erro ao carregar playlists:', error);
    }
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
