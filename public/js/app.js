document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('main-container');
    const overlay = document.getElementById('loading-overlay');
    const sidebarItems = document.querySelectorAll('.sidebar-page li');
    let input = document.getElementById("searchInput");

    input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            loadPage('search')
        }
    });

    function showOverlay() {
        overlay.style.display = 'flex';
        overlay.style.opacity = 1;
        overlay.style.pointerEvents = 'auto';
    }

    function hideOverlay() {
        overlay.style.opacity = 0;
        overlay.style.pointerEvents = 'none';
        setTimeout(() => overlay.style.display = 'none', 500);
    }

    function handleResponse(response) {
        if (!response.ok) {
            throw new Error('Request error: ' + response.status);
        }
        return response.text();
    }

    function updateContent(html, page) {
        container.innerHTML = html;

        container.classList.remove('fade-out');
        container.classList.add('fade-in');

        if (page === 'home') {
            loadPlaylist();
        }

        if (page === 'likeds') {
            loadLikedSongs();
        }

        if (page === 'search') {
            search();
        }

        if (page === 'profile') {
            loadProfile();
        }
        if (page === 'biblioteca') {
            loadPlaylistPerso();
        }

        window.history.pushState({}, '', '?' + page);
    }

    function loadPage(page) {
        //showOverlay();
        container.classList.add('fade-out');
        setTimeout(() => {
            fetch('index.php?' + new URLSearchParams({ page: page, ajax: 'true' }))
                .then(handleResponse)
                .then(html => updateContent(html, page))
                .catch(error => {
                    console.error(error);
                  //  hideOverlay();
                });
        }, 500);
       // hideOverlay();
    }

    document.querySelectorAll('a[data-page]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const page = this.getAttribute('data-page');
            loadPage(page);
        });
    });

    window.addEventListener('popstate', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('page') || 'home';
        loadPage(page);
    });

    sidebarItems.forEach(item => {
        item.addEventListener('click', function () {
          // Remove a classe 'active' de todos os itens <li>
          sidebarItems.forEach(item => item.classList.remove('active'));
          
          // Adiciona a classe 'active' ao item <li> clicado
          this.classList.add('active');
        });
      });

    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'home';
    loadPage(page);
});



