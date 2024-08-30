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