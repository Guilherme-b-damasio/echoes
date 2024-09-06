// Seletores de elementos DOM
const player = document.querySelector("#player");
const musicName = document.querySelector("#musicName");
const playPauseButton = document.querySelector("#playPauseButton");
const prevButton = document.querySelector("#prevButton");
const nextButton = document.querySelector("#nextButton");
const currentTime = document.querySelector("#currentTime");
const duration = document.querySelector("#duration");
const progressBar = document.querySelector(".progress-bar");
const progress = document.querySelector(".progress");

let songs = []; // Lista de músicas
let currentSong = []; // Lista de músicas
let index = 0;

const textButtonPlay = "<i class='bx bx-caret-right'></i>";
const textButtonPause = "<i class='bx bx-pause'></i>";

function initializePlayer() {
  prevButton.addEventListener('click', () => changeMusic("prev"));
  nextButton.addEventListener('click', () => changeMusic("next"));
  playPauseButton.addEventListener('click', togglePlayPause);
  progressBar.addEventListener('click', updatePlaybackPosition);
  player.addEventListener('timeupdate', updateTime);
  player.addEventListener('ended', () => changeMusic("next"));
  playerManager();
}

function togglePlayPause() {
  if (player.paused) {
    player.play();
    playPauseButton.innerHTML = textButtonPause;
  } else {
    player.pause();
    playPauseButton.innerHTML = textButtonPlay;
  }
}

function updateTime() {
  const currentMinutes = Math.floor(player.currentTime / 60);
  const currentSeconds = Math.floor(player.currentTime % 60);
  currentTime.textContent = formatTime(currentMinutes, currentSeconds);

  const durationFormatted = isNaN(player.duration) ? 0 : player.duration;
  const durationMinutes = Math.floor(durationFormatted / 60);
  const durationSeconds = Math.floor(durationFormatted % 60);
  duration.textContent = formatTime(durationMinutes, durationSeconds);

  const progressWidth = durationFormatted
    ? (player.currentTime / durationFormatted) * 100
    : 0;
  progress.style.width = progressWidth + "%";
}

function formatTime(minutes, seconds) {
  return `${formatZero(minutes)}:${formatZero(seconds)}`;
}

function formatZero(n) {
  return (n < 10 ? "0" + n : n);
}

function updatePlaybackPosition(e) {
  if (player.duration && player.duration > 0) {
    const newTime = (e.offsetX / progressBar.offsetWidth) * player.duration;
    if (isFinite(newTime) && newTime >= 0 && newTime <= player.duration) {
      player.currentTime = newTime;
    } else {
      console.error('Valor de novo tempo inválido:', newTime);
    }
  } else {
    console.error('Duração do player inválida ou não definida');
  }
}

function changeMusic(type = "next", ID = 0) {
  const music = JSON.parse(songs);
  if (music.length === 0) return;

  if (type === "next") {
    if (index <= music.length) {
      index = (index + 1);
    }

  } else if (type === "prev") {
    if (index != 0) {
      index = (index - 1);
    }
  } else if (type === "init") {
    index = 0;
  }


  if (music[0].length >= 1) {
    currentSong = music[0];
  } else {
    currentSong = music;
  }


  if (currentSong[index].src && currentSong[index].name) {

    if (ID) {
      for (let count = 0; count < currentSong.length; index++) {
        if (currentSong[index].ID == ID) {
          player.src = currentSong[index].src;
          musicName.innerHTML = currentSong[index].name;
          player.load();
          player.play();
          playPauseButton.innerHTML = textButtonPause;
          updateTime();
          setDetailsMusic(currentSong[index].image, currentSong[index].autor);
          return;
        }
      }
    } else {
      player.src = currentSong[index].src;
      musicName.innerHTML = currentSong[index].name;
      player.load();
      player.play();
      playPauseButton.innerHTML = textButtonPause;
      updateTime();
    }
    setDetailsMusic(currentSong[index].image, currentSong[index].autor);
  } else {
    console.error('Fonte da música ou nome inválido:', currentSong);
  }
}

function setDetailsMusic(imgSrc, artist) {

  img = document.getElementById('img-music');
  bckImg = document.getElementById('background-blur');
  eArtist = document.getElementById('artist');
  img.src = imgSrc;
  bckImg.background = imgSrc; 
  bckImg.backgroundColor = "#f3f3f3";
  bckImg.style.backgroundImage = `url('${imgSrc}')`;
  eArtist.innerHTML = artist;
  return;

}

function setMusicList(musicList, ID) {
  songs = JSON.stringify(musicList);
  ID = ID != null ? ID : 0;
  changeMusic("init", ID);
}



function playerManager () {
  const audioPlayer = document.getElementById('player');
  const volumeSlider = document.getElementById('volumeSlider');
  const volumeUpButton = document.getElementById('volumeUp');
  const volumeDownButton = document.getElementById('volumeDown');
  const volumeIcon = document.getElementById('volumeIcon');

  // Atualiza o controle deslizante e o ícone para refletir o volume atual
  function updateVolume() {
    volumeSlider.value = audioPlayer.volume;
    updateVolumeIcon();
  }


  function updateVolumeIcon() {
    const volume = audioPlayer.volume;
    if (volume === 0) {
      volumeIcon.className = 'bx bx-volume-mute';
    } else if (volume <= 0.3) {
      volumeIcon.className = 'bx bx-volume';
    } else if (volume <= 0.7) {
      volumeIcon.className = 'bx bx-volume-low';
    } else {
      volumeIcon.className = 'bx bx-volume-full';
    }
  }

  volumeIcon.addEventListener('click', function () {
    if (audioPlayer.volume === 0) {
      audioPlayer.volume = volumeSlider.value; // Restaura o volume anterior
    } else {
      volumeSlider.value = audioPlayer.volume; // Armazena o volume atual
      audioPlayer.volume = 0; // Muda para mudo
    }
    updateVolumeIcon();
  });

  volumeSlider.addEventListener('input', function () {
    audioPlayer.volume = volumeSlider.value;
    updateVolumeIcon();
  });

  // Aumenta o volume
  volumeUpButton.addEventListener('click', function () {
    audioPlayer.volume = Math.min(1, audioPlayer.volume + 0.1);
    updateVolumeIcon();
  });

  // Diminui o volume
  volumeDownButton.addEventListener('click', function () {
    audioPlayer.volume = Math.max(0, audioPlayer.volume - 0.1);
    updateVolumeIcon();
  });


  updateVolume();
}



