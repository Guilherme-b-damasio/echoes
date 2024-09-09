<?php $_SESSION['logado'] = false; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>
    <div class="container">
        <div class="container-logo">
            <img src="assets/images/logo.png" alt="Logo" class="logo">
        </div>
        <div class="mid-container">
            <div class="left-section">
                <h1>Yesterday's legend, tomorrow's revolution</h1>
                <img src="music-icon.png" alt="Music Icon" class="music-icon">
            </div>
            <div class="right-section">
            <div id="login-form" >
                <h2>Faça seu login no Echoes</h2>
                <p>Abraçe seu fã interior, escute suas músicas favoritas no Echoes.</p>

                <div class="social-login">

                </div>
                <form id="form-login">
                    <p class="text">E-mail ou nome de usuário</p>
                    <input type="text" placeholder="Email ou nome de usuário" class="input-field" name='user' id='user' required>
                    <p class="text">Senha</p>
                    <input type="password" placeholder="Senha" class="input-field" name='pass' id='pass' required>
                    <div class="forgot-password">Esqueceu sua senha?</div>
                    <button class="sign-in-btn" class="btn" onclick="login()">Login</button>
                </form>
                <p class="terms">
                    Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="#">Termos Gerais de Uso</a> e a <a href="#">Política de Privacidade</a>.
                </p>
                <p class="sign-up">Não tem uma conta? <a href="#" id="show-register">Inscrever-se no Echoes</a></p>
            </div>

            <div id="signup-form" class="activate">
                <h2>Cadastre-se no Echoes</h2>
                <p>Abraçe seu fã interior, escute suas músicas favoritas no Echoes.</p>

                <form id="form-register" >
                    <p class="text">Usuário</p>
                    <input type="text" placeholder="Usuário" class="input-field" name="user" required>
                    <p class="text">E-mail</p>
                    <input type="email" placeholder="Email" class="input-field" name="email" required>
                    <p class="text">Senha</p>
                    <input type="password" placeholder="Senha" class="input-field" name="pass" required>
                    <p class="text">Confirme sua senha</p>
                    <input type="password" placeholder="Confirme sua senha" class="input-field" name="confirm-pass" required>
                    <button class="sign-in-btn" class="btn"onclick="register()">Cadastrar</button>
                </form>
                <p class="terms">
                    Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="#">Termos Gerais de Uso</a> e a <a href="#">Política de Privacidade</a>.
                </p>
                <p class="sign-in">Já tem uma conta? <a href="#" id="show-login">Faça login aqui</a></p>
            </div>
        </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script script src="js/login.js"></script>
    <script>
        const loginForm = document.querySelector('#login-form');
        const signupForm = document.querySelector('#signup-form');
        const signUpLink = document.querySelector('.sign-up');
        const signInLink = document.querySelector('.sign-in');

        signUpLink.addEventListener('click', () => {
            signupForm.classList.remove('activate');
            loginForm.classList.add('activate');
        })

        signInLink.addEventListener('click', () => {
            signupForm.classList.add('activate');
            loginForm.classList.remove('activate');
        })
    </script>
</body>

</html>