<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Own CSS -->
    <link rel="stylesheet" href="movies.css">

    <?php
    $apiKey = "9d24bcfac22c32c732f16116d1db04fa";
    ?>
</head>
<body>

<!-- Navigation -->
<?php include 'navigation.html' ?>

<!-- Movie details -->
<?php include 'movie-details.html' ?>

<!-- Main -->
<div class="container my-5" role="main">

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {

        $search = $_POST['search'];
        $url = "https://api.themoviedb.org/3/search/movie?api_key=$apiKey&language=en-US&query=" . urlencode($search) . "&page=1&include_adult=false";
        $response = file_get_contents($url);
        $result = json_decode($response);
        $movies = $result->results;

        if (count($movies) > 0) {
            ?>
            <div class="mb-5">
                <h1 class="mb-3">Resultat pour "<?php echo $search; ?>"</h1>
                <div class="row">
                    <?php
                    foreach ($movies as $movie) {
                        include "movie.php";
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="mb-5">
                <h1 class="mb-3">Resultat pour "<?php echo $search; ?>"</h1>
                <p>Pas de film trouvé pour "<?php echo $search; ?>"</p>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="mb-5">
            <h1 class="mb-3">Films recent</h1>
            <div id="last-movies-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $url = "https://api.themoviedb.org/3/movie/now_playing?api_key=$apiKey&language=en-US&page=1";
                    $response = file_get_contents($url);
                    $result = json_decode($response);
                    $movies = $result->results;

                    $numMovies = count($movies);
                    $numSlides = ceil($numMovies / 4);

                    for ($i = 0; $i < $numSlides; $i++) {
                        ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <div class="row">
                                <?php
                                $start = $i * 4;
                                $end = min(($i + 1) * 4, $numMovies);

                                for ($j = $start; $j < $end; $j++) {
                                    $movie = $movies[$j];
                                    include "movie.php";
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#last-movies-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#last-movies-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div>
            <h1 class="mb-3">Film Populaire</h1>
            <div class="row">
                <?php
                $url = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=en-US&page=1";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $movies = $result->results;
                include "movie-list.php";
                ?>
            </div>
        </div>
        <?php
    }
    ?>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Own CSS -->
<script src="movies.js"></script>

</body>
</html>