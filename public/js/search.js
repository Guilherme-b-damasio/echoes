const apiURL = 'https://api.lyrics.ovh';

function search() {  
        const searchInput = document.getElementById('searchInput').value;
        if (searchInput !== '') {
            searchFn(searchInput);
        } else {
            alert('Por favor, insira o nome de uma música ou artista.');
        }
}

function clearSearch() {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearBtn');
    searchInput.value = '';
    clearBtn.style.display = 'none'; // Esconde o botão de limpar
    document.getElementById('results').innerHTML = ''; // Limpa os resultados
    searchInput.focus(); // Focar no input após limpar
}

// Exibir o botão de limpar quando há texto no input
document.getElementById('searchInput').addEventListener('input', function () {
    const clearBtn = document.getElementById('clearBtn');
    clearBtn.style.display = this.value ? 'block' : 'none';
});

// Evento para limpar o campo quando o botão é clicado
document.getElementById('clearBtn').addEventListener('click', clearSearch);

// Função de busca
function searchFn(query) {
    fetch(`../src/search_songs.php?name=${query}`)
        .then(response => response.json())
        .then(data => showFn(data, query))
        .catch(error => console.error('Erro na busca:', error))

}

function showFn(data, query) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    if (data.length > 0) {
        data.forEach(song => {
            const card = document.createElement('div');
            card.className = 'result-card';
            
            function highlightText(text, query) {
                const regex = new RegExp(query, 'gi');
                return text.replace(regex, match => `<span style="color: orange">${match}</span>`);
            }

            const highlightedName = highlightText(song.name, query);
            const highlightedAutor = highlightText(song.autor, query);

            card.innerHTML = `
                <div class="infoSong">
                    <img src="${song.image}" alt="Album Art" />
                    <div class="play">
                        <a class="fa fa-play" onclick='playerMusic(${song.ID})'></a>
                    </div>
                    <div class="musicInfo">
                        <h3>${highlightedName}</h3>
                        <p>${highlightedAutor}</p>
                    </div>
                </div>
                <button class="back-btn" style="display: none;">Back</button>
            `;
            resultsContainer.appendChild(card);
        });
    } else {
        resultsContainer.innerHTML = '<p>Nenhum resultado encontrado.</p>';
    }
}

function showLoading() {
    const loadingContainer = document.getElementById('loadingContainer');
    loadingContainer.style.display = 'flex';
    loadingContainer.style.opacity = 1;
}

function loadFn() {
    const loadingContainer = document.getElementById('loadingContainer');
    loadingContainer.style.opacity = 0;
    setTimeout(() => loadingContainer.style.display = 'none', 500);
}
