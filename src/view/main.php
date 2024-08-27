<?php
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
?>

<body>
    <div class="body-principal">

        <div class="sidebar">
            <div class="logo">
                <a href="#">
                    <img src="assets/images/logo.png" alt="Logo" />
                </a>
            </div>

            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="fa fa-home"></span>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="fa fa-search"></span>
                            <span>Search</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="fa fas fa-book"></span>
                            <span>Your Library</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="fa fas fa-plus-square"></span>
                            <span>Create Playlist</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="fa fas fa-heart"></span>
                            <span>Liked Songs</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="policies">
                <ul>
                    <li>
                        <a href="#">Cookies</a>
                    </li>
                    <li>
                        <a href="#">Privacy</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="topbar">
            <div class="prev-next-buttons">
                <button type="button" class="fa fas fa-chevron-left"></button>
                <button type="button" class="fa fas fa-chevron-right"></button>
            </div>

            <div class="navbar">
                <ul>
                    <li>
                        <a href="#">Premium</a>
                    </li>
                    <li class="divider">|</li>
                    <li>
                        <a href="?profile"><?php echo $dataUser->getLogin(); ?></a>
                    </li>
                </ul>
                <button onclick="login();" type="button">Sair</button>
            </div>
        </div>
        <div class="main-container">

            <div class="spotify-playlists">
                <h2>Spotify Playlists</h2>

                <div class="list">
                    <?php foreach ($musicArray as $music): ?>
                        <div class="item">
                            <!-- Exemplo de imagem estática. Idealmente, a URL da imagem viria do objeto da música -->
                            <img src="https://i.scdn.co/image/ab67616d0000b2733b5e11ca1b063583df9492db" alt="Album Art" />
                            <div class="play">
                                <span class="fa fa-play" onclick='playerMusic(<?php echo json_encode($music); ?>)'></span>
                            </div>
                            <h4><?php echo $music->getName(); ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <?php include('../src/view/includes/player.php') ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

</body>