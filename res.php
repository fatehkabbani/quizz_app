<?php
include_once 'database.php';
// get score from database
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $sql = "SELECT score FROM scores WHERE name = '$name'";
    $result = $laison->query($sql);
    if ($result == true) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $score = $row['score'];
    } else {
        echo 'Failed to fetch score from the database.';
    }
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
    <link rel="stylesheet" href="res_style.css">
</head>


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
                $result = $laison->query($sql);
                $sql = "SELECT id FROM scores WHERE name = '$name'";
                $id = $laison->query($sql)->fetch(PDO::FETCH_ASSOC)['id'];
                $i = 0;
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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