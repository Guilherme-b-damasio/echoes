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
const progressBall = document.querySelector('.progress-ball');

let songs = []; // Lista de músicas
let currentSong = []; // Lista de músicas
let index = 0;

const textButtonPlay = "<i class='fa-solid fa-circle-play'></i>";
const textButtonPause = "<i class='fa-solid fa-circle-pause'></i>";

function initializePlayer() {
  prevButton.addEventListener('click', () => prevMusic());
  nextButton.addEventListener('click', () => nextMusic());
  playPauseButton.addEventListener('click', togglePlayPause);
  progressBar.addEventListener('click', updatePlaybackPosition);
  player.addEventListener('timeupdate', updateTime);
  player.addEventListener('ended', () => nextMusic());
  playerManager();
}

function nextMusic() {

  let element = document.getElementById('nextButton');
  let id = element.getAttribute('data-music');
  let playlist = element.getAttribute('data-playlist');
  let liked = element.getAttribute('data-liked');
  let perso = element.getAttribute('data-perso');
  let name = document.getElementById('musicName').textContent;

  let formData = new FormData();

  formData.append('option', 'next');
  if (liked == '1') {
    formData.append('section', 'liked');
  }

  if (perso == '1') {
    formData.append('section', 'perso');
  }

  formData.append('music', id);
  formData.append('next', '1');
  formData.append('name', name);
  formData.append('playlist_id', playlist);

  fetch(`../src/search_songs.php`, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data) {
        verifyLiked(data.ID);
        document.getElementById('nextButton').setAttribute('data-music', data.ID);
        changeMusic(data);
      }
    })
    .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}

function prevMusic() {

  let element = document.getElementById('nextButton');
  let id = element.getAttribute('data-music');
  let playlist = element.getAttribute('data-playlist');
  let liked = element.getAttribute('data-liked');
  let perso = element.getAttribute('data-perso');
  let name = document.getElementById('musicName').textContent;

  let formData = new FormData();
  formData.append('option', 'prev');
  if (liked == '1') {
    formData.append('section', 'liked');
  }

  if (perso == '1') {
    formData.append('section', 'perso');
  }

  formData.append('music', id);
  formData.append('prev', '1');
  formData.append('name', name);
  formData.append('playlist_id', playlist);

  fetch(`../src/search_songs.php`, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data) {
        verifyLiked(data.ID);
        document.getElementById('nextButton').setAttribute('data-music', data.ID);
        changeMusic(data);
      }
    })
    .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
}

function verifyLiked(ID) {
  let formData = new FormData();
  formData.append('section', 'verifyLiked');
  formData.append('music', ID);
  fetch(`../src/search_songs.php`, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      let btn = document.getElementById('liked-btn');
      if (data.liked) {
        btn.style.color = "#005CC8";
        btn.setAttribute('data-liked', 1);
        return;
      }
      btn.setAttribute('data-liked', 0);
      btn.style.color = "white";
      return
    })
    .catch(error => console.error('Erro ao carregar músicas da playlist:', error));
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

function getLocalStorageTime() {
  let playerLocalStorage = localStorage.getItem('player');

  for (const [key, value] of Object.entries(playerLocalStorage)) {
    currentMinutes = key == 'currentMinutes' ? value : '';
    currentSeconds = key == 'currentSeconds' ? value : '';
  }

}

function updateTime() {
  var currentMinutes = Math.floor(player.currentTime / 60);
  var currentSeconds = Math.floor(player.currentTime % 60);
  currentTime.textContent = formatTime(currentMinutes, currentSeconds);

  const durationFormatted = isNaN(player.duration) ? 0 : player.duration;
  const durationMinutes = Math.floor(durationFormatted / 60);
  const durationSeconds = Math.floor(durationFormatted % 60);
  duration.textContent = formatTime(durationMinutes, durationSeconds);

  // Cálculo do progresso
  const progressWidth = durationFormatted ? Math.min(100, (player.currentTime / durationFormatted) * 100) : 0;
  progress.style.width = progressWidth + "%";

  // Atualizar a posição da bolinha
  const ballPosition = progressWidth;  // Sem necessidade de subtrair a largura da bolinha, já que estamos lidando com porcentagem
  progressBall.style.left = ballPosition + '%';
}


function formatTime(minutes, seconds) {
  return `${formatZero(minutes)}:${formatZero(seconds)}`;
}

function formatZero(n) {
  return (n < 10 ? "0" + n : n);
}

function updatePlaybackPosition(e) {
  if (player.duration && player.duration > 0) {
    // Calcular a posição do clique dentro da barra
    const progressBarWidth = progressBar.offsetWidth;  // largura da progress-bar
    const clickPosition = e.offsetX;  // posição onde o usuário clicou

    // Calcular a nova posição relativa do tempo da música baseado no clique
    const newTime = (clickPosition / progressBarWidth) * player.duration;

    // Garantir que o novo tempo seja válido
    if (isFinite(newTime) && newTime >= 0 && newTime <= player.duration) {
      player.currentTime = newTime; // Atualiza o tempo da música
    } else {
      console.error('Valor de novo tempo inválido:', newTime);
    }
  } else {
    console.error('Duração do player inválida ou não definida');
  }
}


function changeMusic(musics = null) {
  let music;
  if (musics !== null) {
    music = musics;
  } else {
    music = JSON.parse(songs);
  }

  if (music.length === 0) return;

  if (music.length >= 1) {
    currentSong = music[0];
  } else {
    currentSong = music;
  }

  if (currentSong.src && currentSong.name) {
    player.src = currentSong.src;
    musicName.innerHTML = currentSong.name;
    player.load();
    player.play();
    playPauseButton.innerHTML = textButtonPause;
    updateTime();

    setDetailsMusic(currentSong.image, currentSong.autor);
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
  verifyLiked(ID);
  changeMusic();
}



function playerManager() {
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

  updateVolume();
}

let isDragging = false; // Controla se a bolinha está sendo arrastada

// Função para iniciar o arrasto
progressBall.addEventListener('mousedown', (e) => {
    isDragging = true; // Inicia o arrasto ao clicar na bolinha
    e.preventDefault(); // Impede o comportamento padrão do mouse (seleção de texto)

    // Adiciona os eventos para arrasto e liberação do mouse
    document.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mouseup', onMouseUp);
});


function onMouseMove(e) {
    if (!isDragging) return; 

    const progressBarWidth = progressBar.offsetWidth;
    const mousePosition = e.clientX - progressBar.getBoundingClientRect().left; 

    const newPosition = Math.min(Math.max(0, mousePosition), progressBarWidth);

    progressBall.style.left = `${(newPosition / progressBarWidth) * 100}%`;
}


function onMouseUp(e) {
    isDragging = false;

    document.removeEventListener('mousemove', onMouseMove);
    document.removeEventListener('mouseup', onMouseUp);

    const progressBarWidth = progressBar.offsetWidth;
    const mousePosition = e.clientX - progressBar.getBoundingClientRect().left; 


    const newTime = (mousePosition / progressBarWidth) * player.duration;

    player.currentTime = newTime;

    updateTime();
}


