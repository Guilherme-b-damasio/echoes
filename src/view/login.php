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
        <div class="curved-shape"></div>
        <div class="curved-shape2"></div>
        <div class="form-box Login">
            <h2 class="animation" style="--D:0; --S:19">Login</h2>
            <form id="form-login" method="post">
                <div class="input-box animation" style="--D:1; --S:18">
                    <input type="text" name='user' id='user' required>
                    <label for="">Usuário</label>
                    <box-icon type='solid' name='user'></box-icon>
                </div>

                <div class="input-box animation" style="--D:2; --S:17">
                    <input type="password" name='pass' id='pass' required>
                    <label for="">Senha</label>
                    <box-icon name='lock-alt' type='solid'></box-icon>
                </div>

                <div class="input-box animation" style="--D:3; --S:20">
                    <button class="btn" onclick="login()">Login</button>
                </div>

                <div class="regi-link animation" style="--D:4; --S:20">
                    <p>Não possui conta? <br> <a href="#" class="SignUpLink">Sign Up</a></p>
                </div>
            </form>
        </div>

        <div class="info-content Login">
            <h2 class="animation" style="--D:0; --S:20">Echoes</h2>
            <p class="animation" style="--D:1; --S:21">Escute as melhores musicas, faça login!</p>
        </div>

        <div class="form-box Register">
            <h2 class="animation" style="--li:14; --S:0">Registrar</h2>
            <form id="form-register" action="#">
                <div class="input-box animation" style="--li:14; --S:1">
                    <input name='user' type="text" required>
                    <label for="">Usuario</label>
                    <box-icon type='solid' name='user'></box-icon>
                </div>

                <div class="input-box animation" style="--li:14; --S:2">
                    <input name='email' type="email" required>
                    <label for="">Email</label>
                    <box-icon name='envelope' type='solid'></box-icon>
                </div>

                <div class="input-box animation" style="--li:14; --S:3">
                    <input name='pass' type="password" required>
                    <label for="">Senha</label>
                    <box-icon name='lock-alt' type='solid'></box-icon>
                </div>

                <div class="input-box animation" style="--li:14; --S:4">
                    <button class="btn" onclick="register()">Registre</button>
                </div>

                <div class="regi-link animation" style="--li:14; --S:5">
                    <p>Não possui conta? <br> <a href="#" class="SignInLink">login</a></p>
                </div>
            </form>
        </div>

        <div class="info-content Register">
            <h2 class="animation" style="--li:14; --S:0">Bem vindo!</h2>
            <p class="animation" style="--li:14; --S:1">A Echoes te deseja boas vibrações!</p>
        </div>

    </div>

    <script src="index.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <script>
        const container = document.querySelector('.container');
        const LoginLink = document.querySelector('.SignInLink');
        const RegisterLink = document.querySelector('.SignUpLink');

        RegisterLink.addEventListener('click', () => {
            container.classList.add('active');
        })

        LoginLink.addEventListener('click', () => {
            container.classList.remove('active');
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/login.js"></script>

</body>

</html>