<?php
require_once 'database.php';

if (isset($_GET['name'])) {
    $name = $_GET['name'];

    if (isset($_POST['score'])) {
        $score = $_POST['score'];

        $db = new DBConnection();
        $conn = $db->conn;

        $sql = "UPDATE scores SET score = '$score' WHERE name = '$name'";
        if ($conn->query($sql) === true) {
            header("Location: res.php?name=$name");
            exit();
        } else {
            echo 'Error: ' . $sql . '<br>' . $conn->error;
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
</head>
<body>
    <button id="add">add+</button>
    <h1 id="score"></h1>
    <form method="POST">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="score" id="score-input" >
        <button type="submit" name="submit-score">
            submit score
        </button>
    </form>
    <script>
        let add = document.getElementById('add');
        let scoreElement = document.getElementById('score');
        let scoreInput = document.getElementById('score-input');
        let score = 0;
        add.onclick = function () {
            score += 10;
            scoreElement.innerText = score;
            scoreInput.value = score;
        }
    </script>
</body>
</html>
