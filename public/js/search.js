const apiURL = 'https://api.lyrics.ovh';

document.getElementById('searchBtn').addEventListener('click', () => {
    const searchInput = document.getElementById('searchInput').value;

    if (searchInput !== '') {
        showLoading();
        seachFn(searchInput);
    } else {
        alert('Please enter a song or artist name.');
    }
});

document.getElementById('clearBtn').addEventListener('click', () => {
    document.getElementById('searchInput').value = '';
    document.getElementById('results').innerHTML = '';
});

document.getElementById('results').addEventListener('click', (event) => {
    const target = event.target;
    if (target.classList.contains('back-btn')) {
        showResFn();
    } else if (target.classList.contains('lyrics-btn')) {
        const artist = target.getAttribute('data-artist');
        const title = target.getAttribute('data-title');
        apiGetFn(artist, title);
    }
});

function seachFn(query) {
    fetch(`${apiURL}/suggest/${query}`)
        .then(response => response.json())
        .then(data => showFn(data))
        .catch(error => console.error('Erro na busca:', error))
        .finally(() => loadFn()); // Esconder o overlay, independentemente do sucesso ou falha
}

function showFn(data) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    if (data.total > 0) {
        data.data.slice(0, 6).forEach(song => {
            const card = document.createElement('div');
            card.classList.add('animate__animated', 'animate__fadeIn', 'result-card');

            card.innerHTML = `
                <h3>${song.title}</h3>
                <p>${song.artist.name}</p>
                <button class="lyrics-btn" data-artist="${song.artist.name}" data-title="${song.title}">
                Get Lyrics
                </button>
                <button class="back-btn" style="display: none;">Back</button>
            `;

            resultsContainer.appendChild(card);
        });
    } else {
        resultsContainer.innerHTML = '<p>No results found.</p>';
    }
}

function apiGetFn(artist, title) {
    showLoading();
    const encodedTitle = encodeURIComponent(title);
    fetch(`${apiURL}/v1/${artist}/${encodedTitle}`)
        .then(response => response.json())
        .then(data => disResFn(data, title, artist))
        .catch(error => console.error('Erro ao obter letra:', error))
        .finally(() => loadFn()); // Esconder o overlay, independentemente do sucesso ou falha
}

function disResFn(data, title, artist) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    const resCard = document.createElement('div');
    resCard.classList.add('animate__animated', 'animate__fadeIn', 'result-card');

    if (data.lyrics) {
        resCard.innerHTML = `
            <h3>${title}</h3>
            <p>${artist}</p>
            <div class="lyrics-container">
            ${formatFn(data.lyrics)}</div>
            <button class="back-btn">Back</button>
        `;
        bckFn(resCard);
    } else {
        resCard.innerHTML = '<p>No lyrics found for this song.</p>';
    }
    resultsContainer.appendChild(resCard);
}

function formatFn(lyrics) {
    return lyrics.split('\n').map(line => `<p>${line}</p>`).join('');
}

function showLoading() {
    const loadingContainer = document.getElementById('loadingContainer');
    loadingContainer.style.display = 'flex'; // Mostra o overlay
    loadingContainer.style.opacity = 1; // Garante visibilidade completa
}

function loadFn() {
    const loadingContainer = document.getElementById('loadingContainer');
    loadingContainer.style.opacity = 0; // Inicia a transição de opacidade
    setTimeout(() => loadingContainer.style.display = 'none', 500); // Remove o overlay após a transição
}

function bckFn(card) {
    const bckBtn = card.querySelector('.back-btn');
    bckBtn.style.display = 'block';
}

function showResFn() {
    const resCon = document.getElementById('results');
    resCon.innerHTML = '';
    seachFn(document.getElementById('searchInput').value);
}
