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

// Função para inicializar o player e configurar os eventos
function initializePlayer() {
  prevButton.addEventListener('click', () => changeMusic("prev"));
  nextButton.addEventListener('click', () => changeMusic("next"));
  playPauseButton.addEventListener('click', togglePlayPause);
  progressBar.addEventListener('click', updatePlaybackPosition);
  player.addEventListener('timeupdate', updateTime);
  player.addEventListener('ended', () => changeMusic("next")); // Avança para a próxima música quando a atual terminar
}

// Função para alternar entre tocar e pausar a música
function togglePlayPause() {
  if (player.paused) {
    player.play();
    playPauseButton.innerHTML = textButtonPause;
  } else {
    player.pause();
    playPauseButton.innerHTML = textButtonPlay;
  }
}

// Função para atualizar o tempo atual e a barra de progresso
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

// Função para formatar minutos e segundos com zero à esquerda
function formatTime(minutes, seconds) {
  return `${formatZero(minutes)}:${formatZero(seconds)}`;
}

// Função para adicionar zero à esquerda para números menores que 10
function formatZero(n) {
  return (n < 10 ? "0" + n : n);
}

// Função para atualizar a posição de reprodução ao clicar na barra de progresso
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

// Função para alternar para a música anterior ou próxima
function changeMusic(type = "next", ID = 0) {
  const music = JSON.parse(songs);
  if (music.length === 0) return;

  if (type === "next") {
    if(index <= music.length){
      index = (index + 1);
    }
    
  } else if (type === "prev") {
    if(index != 0){
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
          return;
        }
      }
    } else {
      player.src = currentSong[index].src;
      musicName.innerHTML = currentSong[index].name;
      player.load(); // Força o carregamento da nova fonte
      player.play(); // Inicia a reprodução automaticamente
      playPauseButton.innerHTML = textButtonPause; // Atualiza o botão para 'pause'
      updateTime();
    }
  } else {
    console.error('Fonte da música ou nome inválido:', currentSong);
  }
}


function setMusicList(musicList, ID) {
  songs = JSON.stringify(musicList);
  ID = ID != null ? ID : 0;
  changeMusic("init", ID);
}

initializePlayer();


window.setMusicList = setMusicList;
