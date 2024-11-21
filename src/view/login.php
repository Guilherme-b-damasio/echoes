<?php $_SESSION['logado'] = false; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echoes</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body style="overflow: hidden">
    <div class="container">
        <div class="left-section">
            <div class="container-logo">
                <img src="assets/images/logo.png" alt="Logo" class="logo">
            </div>
        </div>
    </div>
    <div class="mid-container">
        <div class="left-section">

            <div class="submarine__container">
                <div class="light"></div>
                <div class="submarine__periscope"></div>
                <div class="submarine__periscope-glass"></div>
                <div class="submarine__sail">
                    <div class="submarine__sail-shadow dark1"></div>
                    <div class="submarine__sail-shadow light1"></div>
                    <div class="submarine__sail-shadow dark2"></div>
                </div>
                <div class="submarine__body">
                    <div class="submarine__window one"></div>
                    <div class="submarine__window two"></div>
                    <div class="submarine__shadow-dark"></div>
                    <div class="submarine__shadow-light"></div>
                    <div class="submarine__shadow-arcLight"></div>
                </div>
                <div class="submarine__propeller">
                    <div class="propeller__perspective">
                        <div class="submarine__propeller-parts darkOne"></div>
                        <div class="submarine__propeller-parts lightOne"></div>
                    </div>
                </div>
                <div class="bubbles__container">
                    <span class="bubbles bubble-1"></span>
                    <span class="bubbles bubble-2"></span>
                    <span class="bubbles bubble-3"></span>
                    <span class="bubbles bubble-4"></span>
                </div>
            </div>

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
                    <button class="sign-in-btn" class="btn">Login</button>
                </form>
                <p class="terms">
                    Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="?terms" data-page="terms">Termos Gerais de Uso</a> e a <a href="?polices" data-page="polices">Política de Privacidade</a>.
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
                    <input type="tel" id="phone" placeholder="Telefone" class="input-field" name="phone" maxlength="15" onkeyup="handlePhone(event)" required>
                    <p class="text">Senha</p>
                    <div class="password-container">
                        <input type="password" placeholder="Senha" class="input-field" name="pass" id="pass-register" required>
                        <i id="togglePasswordRegister" class="fa-solid fa-eye eye-icon"></i> <!-- Ícone de olho -->
                    </div>
                    <button class="sign-up-btn" class="btn">Cadastrar-se</button>
                </form>
                <p class="terms">
                    Ao continuar, certifico que atingi a maioridade no meu país de residência e concordo com os <a href="?terms" data-page="terms">Termos Gerais de Uso</a> e a <a href="?polices" data-page="polices">Política de Privacidade</a>.
                </p>
                <p class="sign-in">Já tem uma conta? <a href="#" id="show-login">Faça login</a></p>
            </div>

            <!-- Formulário de Redefinição de Senha-->
            <div id="forgot-password-form" class="hidden">
                <h2>Redefinir Senha</h2>

                <form id="form-reset">
                    <p class="text">E-mail</p>
                    <input type="email" placeholder="E-mail" class="input-field" name="email" required>
                    <button class="send-token-btn" class="btn">Enviar Token</button>
                </form>
                <p class="back-to-login"> Lembrou a senha? <a href="#" id="show-login-from-forgot">Voltar para o login</a></p>
            </div>

        </div>

        <div class="ground__container">
            <div class="ground ground1">
                <span class="up-1"></span>
                <span class="up-2"></span>
                <span class="up-3"></span>
                <span class="up-4"></span>
                <span class="up-5"></span>
                <span class="up-6"></span>
                <span class="up-7"></span>
                <span class="up-8"></span>
                <span class="up-9"></span>
                <span class="up-10"></span>
            </div>
            <div class="ground ground2">
                <span class="up-1"></span>
                <span class="up-2"></span>
                <span class="up-3"></span>
                <span class="up-4"></span>
                <span class="up-5"></span>
                <span class="up-6"></span>
                <span class="up-7"></span>
                <span class="up-8"></span>
                <span class="up-9"></span>
                <span class="up-10"></span>
                <span class="up-11"></span>
                <span class="up-12"></span>
                <span class="up-13"></span>
                <span class="up-14"></span>
                <span class="up-15"></span>
                <span class="up-16"></span>
                <span class="up-17"></span>
                <span class="up-18"></span>
                <span class="up-19"></span>
                <span class="up-20"></span>
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
        const phoneInput = document.getElementById('phone');

        if (phoneInput) {
            phoneInput.addEventListener('input', (event) => {
                handlePhone(event.target); // Chama a função de formatação ao digitar
            });
        }

        const phoneMask = (value) => {
            if (!value) return "";
            value = value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
            value = value.replace(/(\d{2})(\d)/, "($1) $2"); // Formata o DDD
            value = value.replace(/(\d{5})(\d{4})$/, "$1-$2"); // Formata o número
            return value;
        };

        // Função que será chamada no evento de input para formatar o telefone
        const handlePhone = (input) => {
            input.value = input.value.replace(/[^0-9]/g, ''); // Remove qualquer caractere não numérico
            input.value = phoneMask(input.value); // Aplica a máscara no valor
        };

        // Função que adiciona o ouvinte de evento para o campo de telefone
        
        
        
        
    </script>

</body>

</html>