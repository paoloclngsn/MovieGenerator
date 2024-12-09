<?php
$con = mysqli_connect("localhost", "root", "", "myfirstdatabase");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function chooseMovie($answers) {
    global $con;
    $genre = "Comedy"; 
    if (in_array("a", $answers)) {
        $genre = "Action";
    } elseif (in_array("b", $answers)) {
        $genre = "Drama";
    } elseif (in_array("c", $answers)) {
        $genre = "Comedy";
    } elseif (in_array("d", $answers)) {
        $genre = "Romance";
    }

    $query = "SELECT * FROM movies_1980_2020_csv_zip WHERE Genre = '$genre' ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST['answers'] ?? [];
    $movie = chooseMovie($answers);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="topHeader">Movie Generator Quiz</h1>

    <div id="directory">
        <h2 id="directoryHeader">Directory</h2>
        <p> <a href="index.php">Home</a> <a href="myFavorites.php">My Favorites</a> <a href="movieQuiz.php">Quiz</a></p>
    </div>

    <div id="movieRecommendation">
        <?php if (isset($movie)): ?>
            <h3>Your Movie Recommendation</h3>
            <?php if ($movie): ?>
                <p>Based on your answers, we recommend the movie:</p>
                <p><strong><?php echo htmlspecialchars($movie['Title']); ?></strong></p>
                <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['Genre']); ?></p>
                <p><strong>Release Date:</strong> <?php echo htmlspecialchars($movie['Release Date']); ?></p>
                <p><strong>Rating:</strong> <?php echo htmlspecialchars($movie['Rating']); ?>/10</p>
            <?php else: ?>
                <p>We couldn't find a movie for you. Try again!</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div id="quiz">
        <h2>Quiz: What's Your Movie Personality?</h2>

        <form action="movieQuiz.php" method="POST">
            <?php
            $questions = [
                [
                    "question" => "What's your ideal way to spend a weekend?",
                    "answers" => [
                        "a" => "Running a marathon",
                        "b" => "Cuddling with a good book",
                        "c" => "Hosting a party",
                        "d" => "Binge-watching Netflix"
                    ]
                ],
                [
                    "question" => "What's your favorite food?",
                    "answers" => [
                        "a" => "Pizza",
                        "b" => "Sushi",
                        "c" => "Burgers",
                        "d" => "Salad"
                    ]
                ],
                [
                    "question" => "How would you describe your fashion style?",
                    "answers" => [
                        "a" => "Sporty and active",
                        "b" => "Chic and elegant",
                        "c" => "Casual and comfy",
                        "d" => "Trendy and bold"
                    ]
                ],
                [
                    "question" => "What's your idea of a perfect vacation?",
                    "answers" => [
                        "a" => "Climbing mountains",
                        "b" => "Relaxing at the beach",
                        "c" => "Exploring a new city",
                        "d" => "Camping in the woods"
                    ]
                ],
                [
                    "question" => "What's your favorite time of day?",
                    "answers" => [
                        "a" => "Morning",
                        "b" => "Afternoon",
                        "c" => "Evening",
                        "d" => "Night"
                    ]
                ],
                [
                    "question" => "Which of these sounds most fun?",
                    "answers" => [
                        "a" => "Fighting crime",
                        "b" => "Attending a fancy gala",
                        "c" => "Watching a movie marathon",
                        "d" => "Visiting an amusement park"
                    ]
                ],
                [
                    "question" => "How do you feel about animals?",
                    "answers" => [
                        "a" => "I love them, especially dogs",
                        "b" => "I’m indifferent, they’re cool",
                        "c" => "I prefer being around people",
                        "d" => "I prefer cats"
                    ]
                ],
                [
                    "question" => "If you were a superhero, what would your power be?",
                    "answers" => [
                        "a" => "Super strength",
                        "b" => "Invisibility",
                        "c" => "Mind control",
                        "d" => "Time travel"
                    ]
                ],
                [
                    "question" => "What's your favorite movie genre?",
                    "answers" => [
                        "a" => "Action",
                        "b" => "Drama",
                        "c" => "Comedy",
                        "d" => "Romance"
                    ]
                ],
                [
                    "question" => "How do you like to end your day?",
                    "answers" => [
                        "a" => "Exercise or a workout",
                        "b" => "Watching a drama movie",
                        "c" => "Laughing with friends",
                        "d" => "Reading or journaling"
                    ]
                ]
            ];

            foreach ($questions as $index => $question) {
                echo "<div class='question'>";
                echo "<p>" . ($index + 1) . ". " . $question['question'] . "</p>";
                foreach ($question['answers'] as $key => $answer) {
                    echo "<div class='button-group'>";
                    echo "<label><input type='radio' name='answers[$index]' value='$key' required> $answer</label>";
                    echo "</div>";
                }
                echo "</div>";
            }
            ?>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
