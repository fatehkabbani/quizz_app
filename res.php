<?php
require_once 'database.php';
// get score from database
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $db = new DBConnection();
    $conn = $db->conn;
    $sql = "SELECT score FROM scores WHERE name = '$name'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $score = $row['score'];
} else {
    echo 'Error: Name parameter not found.';
}
?>

<!-- display score -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .name-container {
        height: 20vh;
        width: 100%;

    }

    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        height: calc(100vh - 20vh);
    }

    .leader-board-list {
        font-size: 1.2em;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
        padding:10px;
        display: flex;
        justify-content: space-between;
        padding-bottom: 10px;
        border-bottom: black 1px solid;
        width: 25em;
    }
    .leader-board-list:hover{
        background-color: #000;
        color: #fff;
        cursor:pointer;
    }
    .leader-board {
        list-style: none;
        padding: 0;
    }


    .leader-board legend {
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
        margin: 20px auto;
        font-size: 2em;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
        border-bottom: 0px;
    }

    fieldset {
        border: none;
        display: flex;
        flex-direction: column;

    }

    button[type="submit"] {
        width: fit-content;
        margin: 20px auto;
        padding: 10px 20px;
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
        font-size: 1.2em;
        border: none;
        background-color: #000;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        transition: all 0.3s ease-in-out;
        opacity: 0.9;
    }

    .current-user {
        color: red;
    }

    .name-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .name-container p {
        font-family: 'Rubik', sans-serif;
        font-weight: 500;
        font-size: 1.2em;
    }
    .name-container p span{
        display:block;
        padding-bottom:5px;
    }
    
    .name-co-container{
        display: flex;
        justify-content: center;
        align-items: center;
        padding:20px;
    }

</style>

<body>
    <div class="name-container">
        <div class="name-co-container">
            <p>
                <span class="name">Name:
                    <?php echo $name; ?>
                </span>
                     Score:
                <?php echo $score; ?>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="leader-board">
            <fieldset>
                <legend>LEADER BOARD</legend>
                <?php
                $sql = 'SELECT * FROM scores ORDER BY score DESC';
                $result = $conn->query($sql);
                $sql = "SELECT id FROM scores WHERE name = '$name'";
                $id = $conn->query($sql)->fetch_assoc()['id'];
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    $class = '';
                    if ($row['id'] == $id) {
                        $class = 'current-user';
                    }
                    echo '<li class="leader-board-list ' .
                        $class .
                        '">' .
                        $i .
                        '. ' .
                        $row['name'] .
                        ': ' .
                        '<span class="name_score">' .
                        $row['score'] .
                        '</span>' .
                        '</li>';
                }
                ?>
                <button type="submit">take another test</button>
            </fieldset>
        </div>
    </div>
    <script>
        const takeTest = document.querySelector('button[type="submit"]');
        takeTest.addEventListener('click', () => {
            window.location.href = 'name_login.php';
        });
    </script>
</body>

</html>