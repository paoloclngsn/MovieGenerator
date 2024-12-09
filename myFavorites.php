<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "myfirstdatabase");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle adding a movie to the database
if (isset($_POST['add_movie'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $release_date = mysqli_real_escape_string($con, $_POST['release_date']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);

    // Insert the new movie into the database
    $query = "INSERT INTO movies_1980_2020_csv_zip (Title, `Release Date`, Duration, Director, Genre, Rating) 
              VALUES ('$title', '$release_date', '$duration', '$director', '$genre', '$rating')";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Movie added successfully!');</script>";
    } else {
        echo "<script>alert('Error: Could not add movie');</script>";
    }
}

// Handle adding to favorites
if (isset($_POST['add_to_favorites'])) {
    $movie_title = mysqli_real_escape_string($con, $_POST['movie_title']);
    $release_date = mysqli_real_escape_string($con, $_POST['release_date']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);

    // Insert the movie into the favorite_movies table
    $insert_favorite = "INSERT INTO favorite_movies (movie_title, release_date, duration, genre, director, rating) 
                        VALUES ('$movie_title', '$release_date', '$duration', '$genre', '$director', '$rating')";
    mysqli_query($con, $insert_favorite);
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites</title>
</head>
<body>
    <h1 id="topHeader">Movie Generator</h1>
    <div id="directory">
        <h2 id="directoryHeader">Directory</h2>
        <p> <a href="index.php">Home</a> <a href="myFavorites.php">My Favorites</a> <a href="movieQuiz.php">Quiz</a></p> 
    </div>
    <div id="pageDescription">
        <h2>My Favorites</h2>
        <p>Here you can compile a list of your favorite movies! This will aid our algorithm in our movie search to find which movie most accurately fits your taste!</p>
    </div>

    <div id="searchBox">
        <h4 id="boxHeader">Find A Movie</h4>
        <label for="movieName">Movie Name</label>
        <form action="" method="GET">
            <input type="search" id="movieName" name="search">
            <button type="submit">Search</button>
        </form>
        <h2>Can't find your movie? Add a New Movie</h2>
        <form id="addNewMovie" action="" method="POST">
            <label for="title">Movie Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="release_date">Release Date:</label>
            <input type="date" id="release_date" name="release_date" required>

            <label for="duration">Duration (in minutes):</label>
            <input type="number" id="duration" name="duration" min="1" required>

            <label for="director">Director:</label>
            <input type="text" id="director" name="director" required>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>

            <label for="rating">Rating (1-10):</label>
            <input type="number" id="rating" name="rating" step="0.1" min="1" max="10" required>

            <button type="submit" name="add_movie">Add Movie</button>
        </form>
    </div>

    <h4 id="boxHeader">Movies</h4>
    <div id="movieTable">
        <table id="sortableList">
            <thead>
                <tr>
                    <th onclick="sortTable(0,`sortableList`)">No.</th>
                    <th onclick="sortTable(1,`sortableList`)">Movie Name</th>
                    <th onclick="sortTable(2,`sortableList`)">Release Date</th>
                    <th>Add</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Connect to the database
                    $con = mysqli_connect("localhost", "root", "", "myfirstdatabase");

                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Initialize query for searching movies
                    $query = "SELECT * FROM movies_1980_2020_csv_zip WHERE 1=1";

                    // Check if search parameter is set
                    if (!empty($_GET['search'])) {
                        $search = mysqli_real_escape_string($con, $_GET['search']);
                        $query .= " AND Title LIKE '%$search%'";
                    }

                    // If there is a search query, run the query and display the results
                    if (!empty($_GET['search'])) {
                        $query_run = mysqli_query($con, $query);

                        if ($query_run && mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $index => $item) {
                                echo "<tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>" . htmlspecialchars($item['Title']) . "</td>
                                        <td>" . htmlspecialchars($item['Release Date']) . "</td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='movie_title' value='" . htmlspecialchars($item['Title']) . "'>
                                                <input type='hidden' name='release_date' value='" . htmlspecialchars($item['Release Date']) . "'>
                                                <input type='hidden' name='duration' value='" . htmlspecialchars($item['Duration']) . "'>
                                                <input type='hidden' name='genre' value='" . htmlspecialchars($item['Genre']) . "'>
                                                <input type='hidden' name='director' value='" . htmlspecialchars($item['Director']) . "'>
                                                <input type='hidden' name='rating' value='" . htmlspecialchars($item['Rating']) . "'>
                                                <button type='submit' name='add_to_favorites'>Add</button>
                                            </form>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Record Found</td></tr>";
                        }
                    } else {
                        // If there's no search query, leave the table empty
                        echo "<tr><td colspan='4'>Please enter a movie name to search.</td></tr>";
                    }

                    mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>

    <h4 id="boxHeader">My Movies</h4>
    <div id="movieTable">
        <table id="sortableFav">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Movie Name</th>
                    <th>Runtime</th>
                    <th>Genre</th>
                    <th>Director</th>
                    <th>Year</th>
                    <th>Rating</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch the favorite movies from the database
                    $con = mysqli_connect("localhost", "root", "", "myfirstdatabase");
                    $fav_query = "SELECT * FROM favorite_movies";
                    $fav_query_run = mysqli_query($con, $fav_query);

                    if ($fav_query_run && mysqli_num_rows($fav_query_run) > 0) {
                        foreach ($fav_query_run as $fav_movie) {
                            echo "<tr id='movie-row-" . $fav_movie['id'] . "'>
                                    <td>" . htmlspecialchars($fav_movie['id']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['movie_title']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['duration']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['genre']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['director']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['release_date']) . "</td>
                                    <td>" . htmlspecialchars($fav_movie['rating']) . "</td>
                                    <td><button class='remove-btn' data-id='" . $fav_movie['id'] . "'>X</button></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No favorite movies found</td></tr>";
                    }

                    mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Handle the Remove button click using AJAX
        $(document).ready(function() {
            $('.remove-btn').on('click', function() {
                var movieId = $(this).data('id');  // Get the movie ID from the button's data attribute

                // Send AJAX request to delete the movie
                $.ajax({
                    url: 'remove_movie.php',  // Point to the PHP script that will handle the deletion
                    type: 'POST',
                    data: { id: movieId },
                    success: function(response) {
                        if (response === 'success') {
                            // If deletion was successful, remove the row from the table
                            $('#movie-row-' + movieId).remove();
                        } else {
                            alert('Error: Could not remove movie');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
