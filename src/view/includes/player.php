<div class="player-container">
    <div class="background-blur" id="background-blur"></div>
    <div class="player" id="container-player">
        <div class="musicDetails">
            <img id="img-music" src="" alt="">
            <div class="musicInfos">
                <div id="musicName"></div>
                <div id="artist"></div>
            </div>

            <span class="fa fa-list" style="z-index:99" id="perso-select" onclick=saveMusicInPlaylist()></span>
            <span class="fa fa-heart" style="z-index:99" id="liked-btn" onclick=saveMusic()></span>
        </div>
        <div class="container-2">
            <audio id="player" src=""></audio>

            <div class="controls">
                <button id="prevButton"><i class='fa-solid fa-backward-step'></i></button>
                <button id="playPauseButton"><i class='fa-solid fa-circle-play'></i></button>
                <button id="nextButton"><i class='fa-solid fa-forward-step'></i></button>
            </div>

            <div class="footer">
                <div class="progress-bar">
                    <div class="progress"></div>
                    <div class="progress-ball"></div>
                    <div id="timeTooltip" class="time-tooltip"></div>
                </div>
       
                <div class="time">
                    <span id="currentTime">0:00</span>
                    <span id="duration">0:00</span>
                </div>
            </div>
        </div>

        <div class="volume-control">
            <span id="volumeIcon" class="bx bx-volume-full"></span>
            <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1">
        </div>
    </div>
</div>

<script src="../src/player/player.js"></script>
<script>
    initializePlayer();
</script>