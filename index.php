<?php
// Função para gerar o hash da senha
function generatePasswordHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém a senha do formulário
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($password)) {
        // Gera o hash da senha
        $hashedPassword = generatePasswordHash($password);
        echo '<p>Senha original: ' . htmlspecialchars($password) . '</p>';
        echo '<p>Hash da senha: ' . htmlspecialchars($hashedPassword) . '</p>';
    } else {
        echo '<p>Por favor, insira uma senha.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Hash de Senha</title>
</head>
<body>
    <h1>Gerar Hash de Senha</h1>
    <form method="post" action="">
        <label for="password">Digite a senha:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Gerar Hash</button>
    </form>
</body>
</html>

<h2>Spotify Playlists</h2>

    <div class="list">
        
    </div>*/