<?php
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
?>

<body>
    <div class="body-principal">
        <?php include('../src/view/includes/sidebar.php') ?>
        <div class="main-container" id="main-container">
        </div>
        <?php include('../src/view/includes/player.php') ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

</body>