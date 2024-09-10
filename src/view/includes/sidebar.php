<div class="sidebar">
    <div class="logoIcone">
        <a href="#">
            <img src="assets/images/logo.png" alt="Logo" />
        </a>
    </div>

    <div class="navigation">
        <ul>
            <li>
                <a href="?profile" data-page="profile"><?php echo $dataUser->getLogin(); ?></a>
            </li>

            <li>
                <a href="?home" data-page="home">
                    <span class="fa fa-home"></span>
                    <span>Home</span>
                </a>
            </li>



            <li>
                <a href="?search" data-page="search">
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

            <li>
                <a href="?login">
                    <span class="fa fas fa-heart"></span>
                    <span>Sair</span>
                </a>
                <button onclick="login();" type="button">Sair</button>
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