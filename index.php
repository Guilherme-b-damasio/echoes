<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        jQuery.getJSON(
    "https://www.vagalume.com.br/u2/index.js",
    function (data) {
        // Nome do artista
        alert(data.artist.desc);
    
    </script>
</body>
</html>