<?php
// Mostra o formulário de redefinição de senha
$token = ($_GET['token']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echoes</title>
    <link rel="stylesheet" href="../../public/assets/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script defer src="../../public/js/login.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="icon" href="icon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/92aa46a256.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="left-section">
            <div class="container-logo">
                <img src="../../public/assets/images/logo.png" alt="Logo" class="logo">
            </div>
        </div>
        <div class="mid-container">
            <div class="left-section">
                <h1>Ecoe suas canções favoritas, em qualquer lugar.</h1>
                <img src="../../public/assets/images/logo2.png" alt="Logo" class="logo">
            </div>
            <div class="right-section">

                <!-- Formulário de Redefinição de Senha-->
                <div id="forgot-password-form">
                    <h2>Redefinir Senha</h2>
                    <form id="form-reset-pass">
                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
                        <p for="new_password" class="text">Nova senha</p>
                        <input type="password" placeholder="Nova senha" name="new_password" id="new_password" required>
                    </form>
                    <button type="button" class="sign-in-btn" onclick="reset()">Redefinir Senha</button>
                    <p class="back-to-login"><a href="http://127.0.0.1/echoes/public/index.php" id="show-login-from-forgot">Voltar para o login</a></p>
                </div>

            </div>
        </div>
    </div>