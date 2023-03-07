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
    "options":["Delhi","Mumbai","something","Chennai"],
    "answer":"Delhi"
},
{
    "number":2,
    "question":"What is the capital of India?",
    "options":["Delhi","Mumbai","something","Chennai"],
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


function checkAnswer(answer) {
    if (answer == obj.question[i].answer) {
        score++;
        scoreElement.innerHTML = score;
        scoreInput.value = score;
        // console.log(score);
    }
    if (i < obj.question.length - 1) {
        i++;
    } else {
        console.log('end');
        const buttons = document.getElementsByClassName("answer-btn");
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].style.display = "none";
        }
        
        question.innerHTML = "Quiz Completed";
    }
    showQuestion();
}
next.addEventListener("click", () => {
    event.preventDefault();
    checkAnswer();
});
