// Initialize variables to track the current question and the user's score
let currentQuestion = 0;
let score = 0;
let questionsAnswered = 0;

// Select the HTML elements we'll be working with
const container = document.querySelector(".container");
const question = document.querySelector("#question");

// Define a function to assign random colors to the answer buttons
function assignButtonColors() {
  const answerButtons = document.querySelectorAll(".answer-button");
  const colors = ["#27890D", "#D89E02", "#1368CE", "#E21B3C"];
  const randomColorChecked = [];
  for (let i = 0; i < answerButtons.length; i++) {
    const availableColors = colors.filter((color) => !randomColorChecked.includes(color));
    const randomColor = availableColors[Math.floor(Math.random() * availableColors.length)];
    randomColorChecked.push(randomColor);
    answerButtons[i].style.backgroundColor = randomColor;
  }
}
// Call the assignButtonColors function to apply random colors to the answer buttons
assignButtonColors();

// Load the questions data from the JSON file
fetch("script/questions.json")
  .then((response) => response.json())
  .then((data) => {
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
        answerButtons[i].parentNode.replaceChild(
          clonedButton,
          answerButtons[i]
        );
      
        // Add an event listener to the cloned button to handle the click event
        clonedButton.addEventListener("click", function () {
          // If the user's answer is correct, increment the score
          questionsAnswered++;
          if (clonedButton.innerText === currentQuestion.correctAnswer) {
            score++;
          }
          // If we've reached the end of the questions array, display the final score and end the quiz
          if (currentQuestionIndex === questions.length) {
            questionText.innerText = `Your score: ${score} out of ${questions.length}`;
            for (let j = 0; j < answerButtons.length; j++) {
              answerButtons[j].style.display = "none";
              document.getElementById("score-input").value = score;
              document.getElementById("submit").style.display = "block";
              assignButtonColors();
            }
            // Otherwise, move on to the next question
          } else {
            assignButtonColors();
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
  .catch((error) => console.error(error));
