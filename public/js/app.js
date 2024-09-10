document.addEventListener('DOMContentLoaded', function() {
    function loadPage(page) {
        const container = document.getElementById('main-container');
        const overlay = document.getElementById('loading-overlay');

        // Mostra o overlay e inicia a transição de opacidade
        overlay.style.display = 'flex';
        overlay.style.opacity = 1;
        overlay.style.pointerEvents = 'auto'; // Bloqueia interação com o conteúdo subjacente

        // Adiciona a classe fade-out para o desvanecimento do conteúdo atual
        container.classList.add('fade-out');

        // Espera a transição de desvanecimento terminar antes de atualizar o conteúdo
        setTimeout(function() {
            fetch('index.php?' + new URLSearchParams({ page: page, ajax: 'true' }))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição: ' + response.status);
                    }
                    return response.text();
                })
                .then(html => {
                    // Atualiza o conteúdo da página
                    container.innerHTML = html;

                    // Remove a classe fade-out e adiciona fade-in para o novo conteúdo
                    container.classList.remove('fade-out');
                    container.classList.add('fade-in');

                    // Chama a função após atualizar o conteúdo
                    if (page === 'home') {
                        loadPlaylist();
                    }

                    // Atualiza a URL no navegador sem recarregar a página
                    window.history.pushState({}, '', '?' + page);

                    // Remove o overlay após o carregamento
                    overlay.style.opacity = 0;
                    overlay.style.pointerEvents = 'none'; // Permite interação com o conteúdo
                    setTimeout(() => overlay.style.display = 'none', 500); // Tempo para a transição de opacidade
                })
                .catch(error => {
                    console.error(error);
                    // Remove o overlay se houver um erro
                    overlay.style.opacity = 0;
                    overlay.style.pointerEvents = 'none'; // Permite interação com o conteúdo
                    setTimeout(() => overlay.style.display = 'none', 500);
                });
        }, 500); // Tempo para iniciar o carregamento
    }

    // Configura os links para carregar o conteúdo sem recarregar a página
    document.querySelectorAll('a[data-page]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = this.getAttribute('data-page');
            loadPage(page);
        });
    });

    // Gerencia a navegação usando o botão "Voltar" do navegador
    window.addEventListener('popstate', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('page') || 'home';
        loadPage(page);
    });

    // Carrega a página inicial ou a que está na URL quando a página é carregada
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'home';
    loadPage(page);
});
