<?php

session_start();
require '../vendor/autoload.php';

$dataUser = unserialize($_SESSION['dataUser']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = 'uploads/' . $dataUser->getId() . '/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    // Processar o upload do arquivo
    $uploadFile = $uploadDir . 'profile.' . $ext;

    // Verificar se o arquivo foi enviado corretamente
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $response = ['message' => 'Image uploaded successfully!'];
        } else {
            $response = ['message' => 'Failed to upload image.'];
        }
    } else {
        $response = ['message' => 'No file uploaded or an error occurred.'];
    }
} else {
    $response = ['message' => 'Invalid request.'];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
