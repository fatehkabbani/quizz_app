let currentQuestion = 0;
let score = 0;
let questionsAnswered = 0;

// choissir les éléments HTML avec lesquels nous allons travailler
const container = document.querySelector(".container");
const question = document.querySelector("#question");

// defnir une fonction pour assigner des couleurs aléatoires aux boutons de réponse
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
// appler la fonction assignButtonColors pour appliquer des couleurs aléatoires aux boutons de réponse
assignButtonColors();

// charger les données des questions depuis le fichier JSON
fetch("script/questions.json")
  .then((response) => response.json())
  .then((data) => {
    // extrait le tableau de questions de l'objet data
    let questions = data.questions;
    // initiailesr les variables pour suivre la question actuelle et le score de l'utilisateur
    let currentQuestionIndex = 0;
    let score = 0;

    // defnir une fonction pour afficher la question actuelle et les options de réponse
    function displayQuestion() {
      // recupérer l'objet de la question actuelle du tableau des questions
      let currentQuestion = questions[currentQuestionIndex];
      // telecharger le texte de la question dans l'élément HTML
      let questionText = document.getElementById("question");
      questionText.innerText = currentQuestion.question;

      // fair une boucle sur chaque bouton de réponse
      let answerButtons = document.getElementsByClassName("answer-button");
      for (let i = 0; i < answerButtons.length; i++) {
        // cloner le bouton de réponse actuel pour créer un nouveau bouton pour l'option de réponse actuelle
        let clonedButton = answerButtons[i].cloneNode(true);
        // ensamble le texte du bouton cloné avec le texte de l'option de réponse actuelle
        clonedButton.innerText = currentQuestion.answers[i];
        // remplacer le bouton de réponse original par le bouton cloné
        answerButtons[i].parentNode.replaceChild(
          clonedButton,
          answerButtons[i]
        );
      
        // ajouter un écouteur d'événements au bouton cloné pour gérer l'événement de clic
        clonedButton.addEventListener("click", function () {
          // si la réponse de l'utilisateur est correcte, incrémentez le score
          questionsAnswered++;
          if (clonedButton.innerText === currentQuestion.correctAnswer) {
            score++;
          }
          // si nous avons atteint la fin du tableau des questions, affichez le score final et terminez le quiz
          if (currentQuestionIndex === questions.length) {
            questionText.innerText = `Your score: ${score} out of ${questions.length}`;
            for (let j = 0; j < answerButtons.length; j++) {
              answerButtons[j].style.display = "none";
              document.getElementById("score-input").value = score;
              document.getElementById("submit").style.display = "block";
              assignButtonColors();
            }
            // autrement, passez à la question suivante
          } else {
            assignButtonColors();
            currentQuestionIndex++;
            displayQuestion();
          }
        });
      }
    }

    // applez la fonction displayQuestion
    displayQuestion();
  })
  // attraper (catch) l'erreur et la fair apparaitre dans la console
  .catch((error) => console.error(error));
