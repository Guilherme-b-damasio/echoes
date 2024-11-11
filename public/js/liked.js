async function loadLikedSongs() {

    const response = await fetch('../src/list_liked.php?option=select');
    const data = await response.json();
    if (data && data.length > 0) {
        let html = '';

        const list = document.getElementById('main-container');

        html += `<div class="playlists"> 
                    <h1>Curtidas</h1> 
                       <div class="list">`;
        data.forEach(music => {
            html +=
                `<div class="item">
                    <img src="${music.image}" alt="Album Art" />
                    <div class="play">
                        <span class="fa fa-play" onclick='playerMusicLiked(${music.ID})'></span>
                    </div>
                    <h4 class="song-title">${music.name}</h4>
                    <h4 class="autor-name">${music.autor}</h4>
                </div>`;
        });

        html += `</div></div>`;
        list.innerHTML = html;
    }
}

function playerMusicLiked(ID) {

    fetch(`../src/list_liked.php?music=${ID}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                setMusicList(data, ID);
                document.getElementById('nextButton').setAttribute('data-music', data[0]['ID']);
                document.getElementById('nextButton').setAttribute('data-liked', '1');
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}
