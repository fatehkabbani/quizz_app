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
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

#question-container {
    height: 70vh;
    width: 100vw;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

#question-container #question {
    font-size: 2rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

#answers {
    width: 100vw;
    height: 30vh;
    display: flex;
    justify-content: space-around;
    align-items: stretch;
    flex-wrap: wrap;

}

.answer-button {
    width: 50%;
    border: 0px;
    outline: 0;
    color: white;
    font-size: 2vw;
    font-weight: bold;
}

.answer-button:hover {
    filter: brightness(90%);
    cursor: pointer;

}
</style>

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

        <button type="submit" id="submit">submit</button>
    </form>
    <script>
    // Initialize variables to track the current question and the user's score
    let currentQuestion = 0;
    let score = 0;

    // Select the HTML elements we'll be working with
    const container = document.querySelector('.container');
    const question = document.querySelector('#question');
    const answerButtons = document.querySelectorAll('.answer-button');

    // Define a function to assign random colors to the answer buttons
    function assignButtonColors() {
        // Define an array of color values to choose from
        const colors = ["#27890D", "#D89E02", "#1368CE", "#E21B3C"];
        // Create an empty array to keep track of colors we've already used
        const randomColorChecked = [];
        // Loop through each answer button
        for (let i = 0; i < answerButtons.length; i++) {
            // Filter the available colors by removing any that have already been used
            const availableColors = colors.filter(color => !randomColorChecked.includes(color));
            // Choose a random color from the available colors
            const randomColor = availableColors[Math.floor(Math.random() * availableColors.length)];
            // Apply the random color to the answer button
            answerButtons[i].style.backgroundColor = randomColor;
            // Add the color to the list of checked colors
            randomColorChecked.push(randomColor);
        }
    }
    // Call the assignButtonColors function to apply random colors to the answer buttons
    assignButtonColors();

    // Load the questions data from the JSON file
    fetch("questions.json")
        .then(response => response.json())
        .then(data => {
            // Extract the array of questions from the data object
            let questions = data.questions;
            // Initialize variables to track the current question and the user's score
            let currentQuestionIndex = 0;
            let score = 0;

            // Define a function to display the current question and answer options
            function displayQuestion() {
                // Retrieve the current question object from the questions array
                let currentQuestion = questions[currentQuestionIndex];
                // Update the question text in the HTML
                let questionText = document.getElementById("question");
                questionText.innerText = currentQuestion.question;

                // Loop through each answer button
                let answerButtons = document.getElementsByClassName("answer-button");
                for (let i = 0; i < answerButtons.length; i++) {
                    // Clone the current answer button to create a new button for the current answer option
                    let clonedButton = answerButtons[i].cloneNode(true);
                    // Set the text of the cloned button to the current answer option text
                    clonedButton.innerText = currentQuestion.answers[i];
                    // Replace the original answer button with the cloned button
                    answerButtons[i].parentNode.replaceChild(clonedButton, answerButtons[i]);
                    // Add an event listener to the cloned button to handle the click event
                    clonedButton.addEventListener("click", function() {
                        // If the user's answer is correct, increment the score
                        if (clonedButton.innerText === currentQuestion.correctAnswer) {
                            score++;
                        }
                        // If we've reached the end of the questions array, display the final score and end the quiz
                        if (currentQuestionIndex >= questions.length - 1) {
                            questionText.innerText = `Your score: ${score} out of ${questions.length}`;
                            for (let j = 0; j < answerButtons.length; j++) {
                                answerButtons[j].style.display = "none";
                                document.getElementById('score-input').value = score;
                            }
                            // Otherwise, move on to the next question
                        } else {
                            currentQuestionIndex++;
                            displayQuestion();
                        }
                    });
                }
            }

            // Call the displayQuestion function
            displayQuestion();
        })
        // catch error and console it 
        .catch(error => console.error(error));
    //TODO  add question number and some other thing 
    </script>
</body>

</html>