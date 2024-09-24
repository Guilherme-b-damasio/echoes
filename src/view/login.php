<?php $_SESSION['logado'] = false; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echoes</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <div class="container-logo">
                <img src="assets/images/logo.png" alt="Logo" class="logo">
            </div>
        </div>
        <div class="mid-container">
            <div class="left-section">
                <h1>Ecoe suas canções favoritas, em qualquer lugar.</h1>
                <img src="assets/images/logo2.png" alt="Logo" class="logo">
            </div>
            <div class="right-section">
                <!-- Formulário de Login -->
                <div id="login-form">
                    <h2>Faça seu login no Echoes</h2>

                    <div class="social-login">

                    </div>
                    <form id="form-login">
                        <p class="text">E-mail ou nome de usuário</p>
                        <input type="text" placeholder="E-mail ou nome de usuário" class="input-field" name='user' id='user' required>
                        <p class="text">Senha</p>
                        <div class="password-container">
                            <input type="password" placeholder="Senha" class="input-field" name="pass" id="pass-login" required>
                            <i id="togglePasswordLogin" class="fa-solid fa-eye eye-icon"></i> <!-- Ícone de olho -->
                        </div>
                        <div class="forgot-password">
                            <a href="#" id="show-forgot-password">Esqueceu sua senha?</a>
                        </div>
                        <button class="sign-in-btn" class="btn" onclick="login()">Login</button>
                    </form>
                    <p class="terms">
                        Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="#">Termos Gerais de Uso</a> e a <a href="#">Política de Privacidade</a>.
                    </p>
                    <p class="sign-up">Não tem uma conta? <a href="#" id="show-register">Cadastre-se agora</a></p>
                </div>

                <!-- Formulário de Cadastro -->
                <div id="signup-form" class="activate">
                    <h2>Cadastre-se no Echoes</h2>

                    <form id="form-register">
                        <p class="text">Nome</p>
                        <input type="text" placeholder="Nome" class="input-field" name="name" required>
                        <p class="text">Usuário</p>
                        <input type="text" placeholder="Usuário" class="input-field" name="user" required>
                        <p class="text">E-mail</p>
                        <input type="email" placeholder="E-mail" class="input-field" name="email" required>
                        <p class="text">Telefone</p>
                        <input type="tel" placeholder="Telefone" class="input-field" name="phone" maxlength="15" onkeyup="handlePhone(event)" required>
                        <p class="text">Senha</p>
                        <div class="password-container">
                            <input type="password" placeholder="Senha" class="input-field" name="pass" id="pass-register" required>
                            <i id="togglePasswordRegister" class="fa-solid fa-eye eye-icon"></i> <!-- Ícone de olho -->
                        </div>
                        <button class="sign-up-btn" class="btn" onclick="register()">Cadastrar-se</button>
                    </form>
                    <p class="terms">
                        Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="#">Termos Gerais de Uso</a> e a <a href="#">Política de Privacidade</a>.
                    </p>
                    <p class="sign-in">Já tem uma conta? <a href="#" id="show-login">Faça login</a></p>
                </div>

                <!-- Formulário de Redefinição de Senha-->
                <div id="forgot-password-form" class="hidden">
                    <h2>Redefinir Senha</h2>
                    <form id="form-reset">
                        <p class="text">E-mail</p>
                        <input type="email" placeholder="E-mail" class="input-field" name="email" required>
                        <button class="send-token-btn" class="btn" onclick="resetPassword()">Enviar Token</button>
                    </form>
                    <p class="back-to-login"><a href="#" id="show-login-from-forgot"><i class="fa-solid fa-arrow-left"></i> Voltar para o login</a></p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <script>
        const loginForm = document.querySelector('#login-form');
        const signupForm = document.querySelector('#signup-form');
        const forgotPasswordForm = document.querySelector('#forgot-password-form');
        const signUpLink = document.querySelector('#show-register');
        const signInLink = document.querySelector('#show-login');
        const showForgotPasswordLink = document.querySelector('#show-forgot-password');
        const showLoginFromForgot = document.querySelector('#show-login-from-forgot');

        // Exibir formulário de cadastro
        signUpLink.addEventListener('click', () => {
            signupForm.classList.remove('activate');
            loginForm.classList.add('activate');
            forgotPasswordForm.classList.add('hidden');
        });

        // Exibir formulário de login
        signInLink.addEventListener('click', () => {
            signupForm.classList.add('activate');
            loginForm.classList.remove('activate');
            forgotPasswordForm.classList.add('hidden');
        });

        // Exibir formulário de redefinição de senha
        showForgotPasswordLink.addEventListener('click', (event) => {
            event.preventDefault(); // Prevenir o comportamento padrão do link
            loginForm.classList.add('hidden');
            forgotPasswordForm.classList.remove('hidden');
        });

        // Voltar para o formulário de login
        showLoginFromForgot.addEventListener('click', (event) => {
            event.preventDefault(); // Prevenir o comportamento padrão do link
            forgotPasswordForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });
    </script>


    <!-- Exibição da senha -->
    <script>
        // Para o login
        const togglePasswordLogin = document.querySelector('#togglePasswordLogin');
        const passwordFieldLogin = document.querySelector('#pass-login');

        togglePasswordLogin.addEventListener('click', function() {
            const type = passwordFieldLogin.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordFieldLogin.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Para o cadastro
        const togglePasswordRegister = document.querySelector('#togglePasswordRegister');
        const passwordFieldRegister = document.querySelector('#pass-register');

        togglePasswordRegister.addEventListener('click', function() {
            const type = passwordFieldRegister.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordFieldRegister.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

    <!-- Máscara para o campo telefone -->
    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</body>

</html>