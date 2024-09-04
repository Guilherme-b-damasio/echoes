<div class="player-container">
<div class="background-blur" id="background-blur"></div>
    <div class="player" id="container-player">
        <div class="musicDetails">
            <img id="img-music" src="" alt="">
            <div class="musicInfos">
        <div id="musicName"></div>
                <div id="artist"></div>
            </div>
        </div>
        <div class="container-2">
        <audio id="player" src=""></audio>

        <div class="controls">
            <button id="prevButton"><i class='bx bx-skip-previous'></i></button>
            <button id="playPauseButton"><i class='bx bx-caret-right'></i></button>
            <button id="nextButton"><i class='bx bx-skip-next'></i></button>
        </div>

        <div class="footer">
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <div class="time">
                <span id="currentTime">0:00</span>
                <span id="duration">0:00</span>
            </div>
        </div>
    </div>
</div>

<script src="../src/player/player.js"></script>