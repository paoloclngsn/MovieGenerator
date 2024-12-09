<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "myfirstdatabase");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if movie ID is provided in POST data
if (isset($_POST['id'])) {
    $movie_id = mysqli_real_escape_string($con, $_POST['id']);

    // Delete the movie from the favorites table
    $remove_query = "DELETE FROM favorite_movies WHERE id = $movie_id";
    if (mysqli_query($con, $remove_query)) {
        // Return a success response
        echo 'success';
    } else {
        // Return an error response if the deletion failed
        echo 'error';
    }
} else {
    // Return an error response if no movie ID is provided
    echo 'error';
}

mysqli_close($con);
?>
