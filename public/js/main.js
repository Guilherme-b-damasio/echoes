function login(){
    window.location.href ="?login" 
}

const container = document.querySelector('.container');
const LoginLink = document.querySelector('.SignInLink');
const RegisterLink = document.querySelector('.SignUpLink');

RegisterLink.addEventListener('click', () =>{
    container.classList.add('active');
})

LoginLink.addEventListener('click', () => {
    container.classList.remove('active');
})

window.onload = function(){
    loadSongs();
}

function playerMusic($music){
    songs = 
    prevNextMusic("init");
}

const loadSongs = () => {
    fetch('../src/list_songs.php')
        .then(response => response.json())
        .then(data => {
            songs = data;
            prevNextMusic("init");
        })
        .catch(error => console.error('Erro ao carregar músicas:', error));
};