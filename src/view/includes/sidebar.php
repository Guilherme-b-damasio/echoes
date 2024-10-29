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
            <li class="li-profile">
                <?php

                $dir = "../src/uploads/" . $dataUser->getId() . "/profile.png";
                if (is_dir($dir) || file_exists($dir) ) {
                    echo '<img src="../src/uploads/' . $dataUser->getId() . '/profile.png" alt="profile-image" id="profile" class="profile-photo">';
                } else {
                    echo '<img src="../src/uploads/default/profile.png" alt="profile-image" id="profile" class="profile-photo">';
                } ?>

                <a href="?profile" data-page="profile" class="profile-name"><?php echo $dataUser->getLogin(); ?></a>
            </li>

            <div class="sidebar-page">
                <li>
                    <a href="?home" data-page="home">
                        <span class="fa fa-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="?search" data-page="search">
                        <span class="fa fa-search"></span>
                        <span>Pesquisar</span>
                    </a>
                </li> -->
                <li>
                    <a href="#">
                        <span class="fa fas fa-book"></span>
                        <span>Sua Biblioteca</span>
                    </a>
                </li>
                <li>
                    <a href="?playlist">
                        <span class="fa fas fa-plus-square"></span>
                        <span>Criar Playlist</span>
                    </a>
                </li>
                <li>
                    <a href="?likeds" data-page="likeds">
                        <span class="fa fas fa-heart"></span>
                        <span>Músicas Curtidas</span>
                    </a>
                </li>
                <li>
                    <a href="?login">
                        <span class="fa-solid fa-right-from-bracket"></span>
                        <span>Sair</span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</div>