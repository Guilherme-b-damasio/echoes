<div class="sidebar">
    <div class="logoIcone">
        <a href="#">
            <img src="assets/images/logo.png" alt="Logo" />
        </a>
    </div>

    <div class="navigation">
        <ul class="ul-sidebar">
            <li>
                <div class="search-container">
                    <div id="search">
                        <a id="searchBtn" class="fa-solid fa-magnifying-glass" href="?search" data-page="search"></a>
                        <input type="text" id="searchInput" placeholder="Pesquisar...">
                        <i class="fa-solid fa-xmark" id="clearBtn" style="display: none;" onclick="clearSearch()"></i>
                    </div>
                </div>
            </li>
            <div class="sidebar-page">
                <a href="?home" data-page="home">
                    <li id="home">
                        <div class="sidebar-button">
                            <span class="fa fa-home"></span>
                            <span>Home</span>
                        </div>
                    </li>
                </a>
                <a href="?profile" data-page="profile">
                    <li>
                        <div class="sidebar-button">
                            <span class="fa-solid fa-user"></span>
                            <span>Perfil</span>
                        </div>
                    </li>
                </a>
                <a href="?biblioteca" data-page="biblioteca">
                    <li>
                        <div class="sidebar-button">
                            <span class="fa fas fa-book"></span>
                            <span>Sua Biblioteca</span>
                        </div>
                    </li>
                </a>
                <li onclick="criarPlaylist()">
                    <div class="sidebar-button">
                        <span class="fa fas fa-plus-square"></span>
                        <span>Criar Playlist</span>
                    </div>
                </li>
                <a href="?likeds" data-page="likeds">
                    <li>
                        <div class="sidebar-button">
                            <span class="fa fas fa-heart"></span>
                            <span>Músicas Curtidas</span>
                        </div>
                    </li>
                </a>
                <a href="?login">
                    <li>
                        <div class="sidebar-button">
                            <span class="fa-solid fa-right-from-bracket"></span>
                            <span>Sair</span>
                        </div>
                    </li>
                </a>
            </div>
        </ul>
    </div>
</div>