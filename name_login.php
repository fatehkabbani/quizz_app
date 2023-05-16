<?php
include 'php/database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id = $_POST['id'];
    
    $sql = "INSERT INTO scores (name) VALUES ('$name')";
    $conn = $laison->query($sql);
    if ($conn == true) {
        header("Location: quiz.php?name=$name");
        exit();
    } else {
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="container">
        <form action="name_login.php" method="POST" class="form">
            <input type="text" class="name" name="name" placeholder="enter your name" autocomplete="off" />
            <input type="hidden" class="id" name="id">
            <button type="submit" class="btn">
                <p>connect</p>
            </button>
        </form>
    </div>
</body>

</html>