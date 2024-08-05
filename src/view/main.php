<body>

    <div class="sidebar">
        <div class="logo">
            <a href="#">
                <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2018/11/Spotify_Logo_CMYK_Green.png" alt="Logo" />
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

    <div class="main-container">
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
                    <li>
                        <a href="#">Support</a>
                    </li>
                    <li>
                        <a href="#">Download</a>
                    </li>
                    <li class="divider">|</li>
                    <li>
                        <a href="#">Sign Up</a>
                    </li>
                </ul>
                <button onclick="login();" type="button">Log In</button>
            </div>
        </div>

        <div class="spotify-playlists">
            <h2>Spotify Playlists</h2>

            <div class="list">
                <div class="item">
                    <img src="https://i.scdn.co/image/ab67616d0000b2733b5e11ca1b063583df9492db" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Mega Hit Mix</h4>
                    <p>A mega mix of 75 favorites from the last...</p>
                </div>

            </div>
        </div>

        <div class="spotify-playlists">
            <h2>Focus</h2>
            <div class="list">
                <div class="item">
                    <img src="https://i.scdn.co/image/ab67616d0000b2733b5e11ca1b063583df9492db" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Beats to think to</h4>
                    <p>Focus with deep techno and tech house.</p>
                </div>
            </div>
        </div>

        <div class="spotify-playlists">
            <h2>Mood</h2>
            <div class="list">
                <div class="item">
                    <img src="https://i.scdn.co/image/ab67616d0000b2733b5e11ca1b063583df9492db" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>Feel-Good Indie Rock</h4>
                    <p>The best indie rock vibes - classic and...</p>
                </div>
            </div>

            <hr>
        </div>
    </div>
    <?php include('../src/view/includes/player.php') ?>

    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    
</body>