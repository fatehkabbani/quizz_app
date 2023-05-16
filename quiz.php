<?php
require_once 'database.php';

if (isset($_GET['name'])) {
    $name = $_GET['name'];

    if (isset($_POST['score'])) {
        $score = $_POST['score'];
    
        $sql = "UPDATE scores SET score = '$score' WHERE name = '$name'";
        $result = $laison->exec($sql);
        if ($result !== false) {
            header("Location: res.php?name=$name");
            exit();
        } else {
            echo 'Failed to update score in the database.';
        }
    }
} else {
    echo 'Error: Name parameter not found.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="quiz.css">
</head>


<body>
    <div class="container">
        <div id="question-container">
            <h1 id="question"></h1>
        </div>
        <div id="answers">
            <button class="answer-button"></button>
            <button class="answer-button"></button>
            <button class="answer-button"></button>
            <button class="answer-button"></button>
        </div>
    </div>
    <form method="POST">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="score" id="score-input">

        <button type="submit" id="submit" style="display: none;">submit</button>
    </form>
    <script src="script.js"></script>
</body>

</html>