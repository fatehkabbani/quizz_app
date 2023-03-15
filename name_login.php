<?php
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $db = new DBConnection();
    $conn = $db->conn;
    
    $sql = "INSERT INTO scores (name) VALUES ('$name')";
    
    if ($conn->query($sql) === true) {
        header("Location: quiz.php?name=$name");
        exit();
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
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
</head>
<style>
    body {
        overflow: hidden;
    }

    ::-webkit-input-placeholder {
        opacity: 1;
        -webkit-transition: opacity .2s;
        transition: opacity .2s;
    }

    :-moz-placeholder {
        opacity: 1;
        -moz-transition: opacity .2s;
        transition: opacity .2s;
    }

    ::-moz-placeholder {
        opacity: 1;
        -moz-transition: opacity .2s;
        transition: opacity .2s;
    }

    :-ms-input-placeholder {
        opacity: 1;
        -ms-transition: opacity .2s;
        transition: opacity .2s;
    }

    ::placeholder {
        opacity: 1;
        transition: opacity .2s;
    }


    *:focus::-webkit-input-placeholder {
        opacity: 0;
    }

    *:focus:-moz-placeholder {
        opacity: 0;
    }

    *:focus::-moz-placeholder {
        opacity: 0;
    }

    *:focus:-ms-input-placeholder {
        opacity: 0;
    }

    *:focus::placeholder {
        opacity: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
        height: 30%;
        width: 50%;
    }

    .name {
        padding: 10px 20px;
        padding-left: 5px;
        font-size: 20px;
        font-family: 'Varela Round', sans-serif;
        box-shadow: -4px -11px 0px -7px rgba(0, 0, 0, 1) inset;
        -webkit-box-shadow: -4px -11px 0px -10px rgba(0, 0, 0, 1) inset;
        -moz-box-shadow: -4px -11px 0px -10px rgba(0, 0, 0, 1) inset;
        transition: 0.2s;
    }

    input {
        outline: 0;
        border: 0;
    }

    input:focus {
        -webkit-box-shadow: inset 0px 0px 0px 1px #000000;
        box-shadow: inset 0px 0px 0px 1px #000000;

    }

    .btn {
        border: none;
        width: 140px;
        height: 50px;
        color: #fff;
        background: #000;
    }

    .btn:hover {
        transition: .2s;
        cursor: pointer;

    }

    .btn p {
        style: unset;
        margin: 0 auto;
        font-size: 17px;
        font-weight: bold;
        text-align: center;
    }
</style>

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