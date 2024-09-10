<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <script src="app.js" defer></script>
</head>
<body>
    <?php include('../src/view/header.php'); ?>
    <nav>
        <a href="#" data-page="login">Login</a>
        <a href="#" data-page="profile">Profile</a>
        <a href="#" data-page="home">Home</a>
    </nav>
    <div id="main-content">
        <!-- O conteúdo será carregado aqui -->
    </div>
    <?php include('../src/view/footer.php'); ?>
</body>
</html>
