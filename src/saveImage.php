<?php

session_start();
require '../vendor/autoload.php';

$dataUser = unserialize($_SESSION['dataUser']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = 'uploads/' . $dataUser->getId() . '/';

    // Cria o diretório se não existir
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Extensão do arquivo enviado
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . 'profile.' . $ext;

    // Verifica e exclui arquivos antigos que começam com 'profile'
    foreach (glob($uploadDir . 'profile.*') as $oldFile) {
        if (file_exists($oldFile)) {
            unlink($oldFile); // Exclui o arquivo antigo
        }
    }

    // Verificar se o arquivo foi enviado corretamente
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $response = ['message' => 'Imagem modificada com sucesso!', 'imagePath' => $uploadFile];
        } else {
            $response = ['message' => 'Sua modificação falhou.'];
        }
    } else {
        $response = ['message' => 'Nenhum arquivo enviado ou ocorreu um erro.'];
    }
} else {
    $response = ['message' => 'Invalid request.'];
}

header('Content-Type: application/json');
echo json_encode($response);

?>
