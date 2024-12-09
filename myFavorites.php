<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <input type="search" id="movieName" name="movieName">
        <br>
        <input type="submit">
    </div>
    <h4 id="boxHeader">Movies</h4>
    <div id="movieTable">
        <table id="sortableList">
            <tr>
            <th onclick="sortTable(0,`sortableList`)">No.</th>
            <th onclick="sortTable(1,`sortableList`)">Movie Name</th>
            <th>Add</th>
            </tr>
           <?php
           
           ?>
            

        </table>
    </div>
    <h4 id="boxHeader">My Movies</h4>
    <div id="movieTable">
        <table id="sortableFav">
            <tr>
                <th onclick="sortTable(0,`sortableFav`)">No.</th>
                <th onclick="sortTable(1,`sortableFav`)">Movie Name</th>
                <th onclick="sortNum(2,`sortableFav`)">Runtime</th>
                <th onclick="sortTable(3,`sortableFav`)">Genre</th>
                <th onclick="sortTable(4,`sortableFav`)">Director</th>
                <th onclick="sortTable(5,`sortableFav`)">Year</th>
                <th onclick="sortTable(6,`sortableFav`)">Rating</th>
                <th> X </th>
            </tr> 
            <tr>
                <td>1</td>
                <td>Transformers</td>
                <td>123</td>
                <td>Action</td>
                <td>Michael Bay</td>
                <td>2007</td>
                <td>PG-13</td>
                <td><button id="delete"><img src="https://thumbs.dreamstime.com/b/trash-icon-garbage-symbol-beautiful-meticulously-designed-201894866.jpg"></button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Avengers</td>
                <td>90</td>
                <td>Action</td>
                <td>Russo Bros.</td>
                <td>2012</td>
                <td>PG-13</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sound of Music</td>
                <td>190</td>
                <td>Drama</td>
                <td>Michael Bay</td>
                <td>1940</td>
                <td>PG</td>
            </tr>
            <tr>
                <td>4</td>
                <td>The Purge</td>
                <td>180</td>
                <td>Horror</td>
                <td>Ethan</td>
                <td>2012</td>
                <td>R</td>
            </tr>
        </table>
    </div>
</body>
</html>