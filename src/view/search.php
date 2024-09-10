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
    <script defer src="js/app.js"></script>
    <script defer src="js/search.js"></script>
    <title>GeeksforGeeks Lyrics Searcher</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="animate__animated animate__fadeInDown" style="color: green;">
                GeeksforGeeks Lyrics Searcher
            </h1>
        </div>
        <div class="search-container">
            <i class="fas fa-music" style="color: #e74c3c;">
            </i>
            <input type="text" id="searchInput" placeholder="Search for lyrics"
                style="background: #ecf0f1; color: #333;">
            <button id="searchBtn" style="background: #2ecc71; color: #fff;">
                earch
            </button>
            <button id="clearBtn" style="background: #e74c3c; color: #fff;">
                Clear
            </button>
        </div>
        <div class="result-container" id="results"></div>
    </div>
    <div class="loading-container" id="loadingContainer">
        <div class="loading-spinner" style="border-color: #3498db; 
                    border-top-color: #e74c3c;"></div>
    </div>
    <script src="app.js"></script>
</body>

</html>