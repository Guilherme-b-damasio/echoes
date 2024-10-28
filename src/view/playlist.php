<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echoes</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="main-container">
            <div class="right-section">
                <!-- Formulário de Login -->
                <div id="login-form">
                    <form id="form-playlist">
                        <label class="text">Nome da playlist</label>
                        <input type="text" placeholder="Nome de sua playlist" class="input-field" name='playlist_name' id='playlist_name' required>
                        <button class="sign-in-btn" class="btn" onclick="salvarPlaylist()">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="js/playlist.js"></script>