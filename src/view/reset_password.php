<?php
// Mostra o formulário de redefinição de senha
$token = htmlspecialchars($_GET['token']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script defer src="../../public/js/login.js"></script>
</head>

<body>
    <div class="container">
        <form id="form-reset2">
            <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
            <label for="new_password">Nova senha:</label>
            <input type="password" name="new_password" id="new_password" required>
            
        </form>
        <button type="button" class="btn" onclick="reset()">Redefinir Senha</button>
    </div>
    
    <link rel="icon" href="icon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/92aa46a256.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function test(){
            console.log('teste');
            reset();
        }
    </script>