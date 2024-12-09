<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <title>Movie Generator Tool</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale1.0">
</head>

<body>
    <h1 id="topHeader">Movie Generator</h1>
    <div id="directory">
        <h2 id="directoryHeader">Directory</h2>
        <p> <a href="index.php">Home</a> <a href="myFavorites.php">My Favorites</a> <a href="movieQuiz.php">Quiz</a></p> 
    </div>

    <div id="pageDescription">
        <h2>Welcome!</h2>
        <p> Welcome to Movie Generator! Using this tool, you can generate movies to watch based on your preferences! In order to tailor your preferences, add your favorite movies <a href="myFavorites.html">here!</a> </p>
    </div>
    
    <div id="searchBox">
        <h4 id="boxHeader">Generate a Reccomendation</h4>

        <form action="<?php 
        $director = $_GET['director'];
        $year = $_GET['year'];
        $genre = $_GET['genre'];
        $combined = $director . $year . $genre;
        if(isset($_GET['combined'])){echo $_GET['combined']; } ?>" method="GET">
            <div class="input-group mb-3">
            <div>
                <label for="directorName"> Director Name</label>
                <input type="text" name="director" id="fname" placeholder="First Last">
            </div>

            <div>
                <label for="yearReleased"> Year Released </label>
                <input type="number" name="year" id="yearReleased" min="1878" max="2024" placeholder="2024">
            </div>
<!--
            <div>
                <label>Hour Length Max</label>
                <input type="number" name="search" id="hourLength" min="0" max="4" value="0">
            </div>
-->
            <div>
                <label for="genre">Genre:</label>
                <select id="genre" name="genre">
                    <option value="Comedy">Comedy</option>
                    <option value="Drama">Drama</option>
                    <option value="Romance">Romance</option>
                    <option value="Documentary">Documentary</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Action">Action</option>
                </select>
            </div>
            <!----
            <div>
                <label style="margin-bottom: 0;">Rating:</label>
                <label for="G">G</label>
                <input  style="margin-left: 0px;" type="checkbox" id="G" name="search" value="G">
                <label style="margin-left: 8px;" for="G">PG</label>
                <input style="margin-left: 0px;" type="checkbox" id="PG" name="search" value="PG">
                <label style="margin-left: 8px;" for="PG-13">PG-13</label>
                <input style="margin-left: 0px;" type="checkbox" id="PG-13" name="search" value="PG-13">
                <label style="margin-left: 8px;" for="R">R</label>
                <input style="margin-left: 0px;" type="checkbox" id="R" name="search" value="R">
            </div>
                --->
            <div>
                <input type="reset">
                <button type="submit">Search</button>
            </div>
            <br>
            <h4 id="boxHeader">Favorites Based List</h4>
            <p style="margin-top: 0;">If you would like a reccomendation based solely on your favorite movies, click here!</p>
            <div>
                <button style="margin-left: 40%;" id="personalReccommendation">Generate</button>
            </div>
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
                    <th>Year Released</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $con = mysqli_connect("");
                    $director = $_GET['director'];
                    $year = $_GET['year'];
                    $genre = $_GET['genre'];
                    $combined = $director . $year . $genre;
                    if(isset($_GET['combined']))
                    {
                        $filtervalues = $_GET['combined'];
                        $query = "SELECT * FROM databas WHERE CONCAT(data,data,data) LIKE '%$filtervalues%' ";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run)> 0){
                                foreach($query_run as $items)
                                {
                                    ?>
                                    
                                    <?php
                                }
                        }
                        else{
                            ?>
                                <tr>
                                    <td colspan="4" >No Record Found</td>
                                </tr>

                            <?php
                        }
                    }
                
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>