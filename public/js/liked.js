async function loadLikedSongs() {

    const response = await fetch('../src/list_liked.php?option=select');
    const data = await response.json();
    if (data && data.length > 0) {
        let html = '';

        const list = document.getElementById('main-container');

        data.forEach(music => {
            html +=
                `
                 <div class="playlists">  
                       <div class="list"        
                            <div class="item">
                                <img src="${music.image}" alt="Album Art" />
                                <div class="play">
                                    <span class="fa fa-play" onclick='playerMusicLiked(${music.ID})'></span>
                                </div>
                                <h4>${music.name}</h4>
                            </div>
                        </div>
                    </div>`;
        });

        list.innerHTML = html;
    }
}

function playerMusicLiked(ID) {

    fetch(`../src/list_liked.php?music=${ID}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                setMusicList(data, ID);
                document.getElementById('nextButton').setAttribute('data-music', ID);
            }
        })
        .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}


document.addEventListener('DOMContentLoaded', function() {
    loadLikedSongs();
});
