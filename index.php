<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <title>Movie Generator Tool</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1 id="topHeader">Movie Generator</h1>
    <div id="directory">
        <h2 id="directoryHeader">Directory</h2>
        <p> <a href="index.php">Home</a> <a href="myFavorites.php">My Favorites</a> <a href="movieQuiz.php">Quiz</a></p>
    </div>

    <div id="pageDescription">
        <h2>Welcome!</h2>
        <p>Welcome to Movie Generator! Using this tool, you can generate movies to watch based on your preferences! Add your favorite movies <a href="myFavorites.php">here!</a></p>
    </div>

    <div id="searchBox">
        <h4 id="boxHeader">Generate a Recommendation</h4>
        <form method="GET" action="">
            <div>
                <label for="directorName">Director Name</label>
                <input type="text" name="director" id="directorName" placeholder="First Last">
            </div>

            <div>
                <label for="yearReleased">Year Released</label>
                <input type="number" name="year" id="yearReleased" min="1878" max="2024" placeholder="2024">
            </div>

            <div>
                <label for="genre">Genre:</label>
                <select id="genre" name="genre">
                    <option value="">Any</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Drama">Drama</option>
                    <option value="Romance">Romance</option>
                    <option value="Documentary">Documentary</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Action">Action</option>
                </select>
            </div>

            <div>
                <input type="reset">
                <button type="submit">Search</button>
            </div>
        </form>
    </div>

    <h4 id="boxHeader">Movies to Watch!</h4>
    <div id="movieTable">
        <table class="sortable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Movie Name</th>
                    <th>Genre</th>
                    <th>Director</th>
                    <th>Release Date</th>
                    <th>Runtime (m)</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = mysqli_connect("localhost", "root", "", "myfirstdatabase");

                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM movies_1980_2020_csv_zip WHERE 1=1";

                $has_search = false; 

                if (!empty($_GET['director'])) {
                    $director = mysqli_real_escape_string($con, $_GET['director']);
                    $query .= " AND Director LIKE '%$director%'";
                    $has_search = true;
                }

                if (!empty($_GET['year'])) {
                    $year = intval($_GET['year']);
                    $query .= " AND `Release Date` = $year";
                    $has_search = true;
                }

                if (!empty($_GET['genre'])) {
                    $genre = mysqli_real_escape_string($con, $_GET['genre']);
                    $query .= " AND Genre = '$genre'";
                    $has_search = true;
                }
                
                if ($has_search) {
                    $query_run = mysqli_query($con, $query);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $index => $item) {
                            echo "<tr>
                                    <td>" . ($index + 1) . "</td>
                                    <td>" . htmlspecialchars($item['Title']) . "</td>
                                    <td>" . htmlspecialchars($item['Genre']) . "</td>
                                    <td>" . htmlspecialchars($item['Director']) . "</td>
                                    <td>" . htmlspecialchars($item['Release Date']) . "</td>
                                    <td>" . htmlspecialchars($item['Duration']) . "</td>
                                    <td>" . htmlspecialchars($item['Rating']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No Record Found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Please enter search criteria to find movies.</td></tr>";
                }

                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
