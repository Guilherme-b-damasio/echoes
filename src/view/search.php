<!-- index.html -->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/search.css">
    <title></title>

<body>
    <div class="container-search">
        <div class="header">
            <h1 class="animate__animated animate__fadeInDown" style="color: green;">
                Procure por musicas
            </h1>
        </div>
        <div class="search-container">
            <div id="search">
                <i id="searchBtn" class="fa-solid fa-magnifying-glass" onclick="search()"></i>  
                <input type="text" id="searchInput" placeholder=" Pesquise por músicas">
                <i class="fa-solid fa-xmark" onclick="clearBtn()"></i>
            </div>
        </div>
        <div class="result-container" id="results"></div>
    </div>
    <div class="loading-container" id="loadingContainer">
        <div class="loading-spinner" style="border-color: #3498db; 
                    border-top-color: #e74c3c;"></div>
    </div>

</body>

</html>