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
<style>
    body{
    margin:0;
    padding:0;
    box-sizing: border-box;

}
html{
    scroll-behavior: smooth;
}
.question-container{
    height: 70vh;
    width:100vw;
    background-color: #f5f5f5;
    display: flex;
    justify-content:center;
    align-items: center;
    flex-direction: column;
}
.question-container #question{
    font-size: 2rem;
    font-weight: 500;
    margin-bottom: 1rem;
}
.answer-container{
    width: 100%;
    height:30vh;
    display: flex;
    justify-content: space-around;
    align-items: stretch;
    flex-wrap: wrap;
}
.answer-container .answer-btn{
    width:50%;
    border:0px;
    outline:0;
    color:white;
    font-size:2vw;
    font-weight: bold;
}   
.answer-container .answer-btn:hover{
    filter:brightness(90%);
    cursor:pointer;

}

.answer-btn:focus{
    filter:brightness(80%);
    opacity: 0.7;
}
</style>
<body>
    <h1 id="score"></h1>
    <div class="container">
        <div class="question-container">
            <div id="question"></div>
            <p id="score" name="score"></p>
            <button id="next" onclick="checkAnswer()">next</button>
        </div>
        <div class="answer-container">
            <button class="answer-btn" id="option1" value=""></button>
            <button class="answer-btn" id="option2" value=""></button>
            <button class="answer-btn" id="option3" value=""></button>
            <button class="answer-btn" id="option4" value=""></button>
        </div>
    </div>
    <form method="POST">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="score" id="score-input">

    <button type="submit" id="submit">submit</button>
    </form>
    <script>
        const next = document.getElementById("next");
        const question = document.getElementById('question');
        const option1 = document.getElementById("option1");
        const option2 = document.getElementById("option2");
        const option3 = document.getElementById("option3");
        const option4 = document.getElementById("option4");
        let scoreElement = document.getElementById('score');
        let scoreInput = document.getElementById('score-input');
        function assignButtonColors() {
            const colors = ["#27890D", "#D89E02", "#1368CE", "#E21B3C"];

            const buttons = document.getElementsByClassName("answer-btn");
            const randomColorChecked = [];

            for (let i = 0; i < buttons.length; i++) {
                const availableColors = colors.filter(color => !randomColorChecked.includes(color));
                const randomColor = availableColors[Math.floor(Math.random() * availableColors.length)];
                buttons[i].style.backgroundColor = randomColor;
                randomColorChecked.push(randomColor);
            }
        }
        assignButtonColors();
let answers = `{
    "question":[
        {
            "number":1,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":2,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":3,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":4,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":5,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":6,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":7,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":8,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":9,
            "question":"What is the capital of India?",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        },
        {
            "number":10,
            "question":"hi",
            "options":["Delhi","Mumbai","Kolkata","Chennai"],
            "answer":"Delhi"
        }
    ]
}`;
        const obj = JSON.parse(answers);

        let i = 0;
        let score = 0;
        function showQuestion() {
            question.innerHTML = obj.question[i]?.question;
            option1.innerHTML = obj.question[i]?.options[0];
            option2.innerHTML = obj.question[i]?.options[1];
            option3.innerHTML = obj.question[i]?.options[2];
            option4.innerHTML = obj.question[i]?.options[3];
            // document.getElementById("score").innerHTML = score;
            option1.value = obj.question[i].options[0];
            option2.value = obj.question[i].options[1];
            option3.value = obj.question[i].options[2];
            option4.value = obj.question[i].options[3];
        }
        showQuestion();

        const checkAnswer = () => {
            let options = [option1, option2, option3, option4];
            for (let j = 0; j < obj.question[i].options.length; j++) {
                options[j].onclick = function () {
                    if (this.value === obj.question[i].answer) {
                        score++;
                        if (i < obj.question.length - 1) {
                            console.log(obj.question.length)
                            i++;
                        } else {
                            console.log(`nice you finished the test with:${score} score`)
                        }
                        console.log(score)
                    }
                    scoreElement.innerText = score;
                     scoreInput.value = score;
                };

            }
            showQuestion();
        }

        //TODO  add question number and some other thing 
    </script>
</body>

</html>