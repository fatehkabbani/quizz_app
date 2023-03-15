# Quiz App with PHP and Database
This is a simple quiz app built with PHP and a database to store user scores. It consists of three main files:

- `name_login.php` :   This file allows the user to enter their name and store it in the database to be used later in the quiz.
- `quiz.php` : This file displays the quiz questions and allows the user to answer them. It also updates the user's score and stores it in the database.
- `res.php` :This file displays the user's score and a leader board of the top scores. there is a  play again button.

# requirements
- PHP
- MySQL database

## in order to run this app, you need to create a database and a table in it. The table should have the following columns:

- `id` : This is the primary key and should be set to auto increment.
- `name` : This column should be set to accept strings of 50 characters.
- `score` : This column should be set to accept integers.

# How to Use 

1. enter your name in the name field and click submit.
2. Answer the questions and click submit.
3. click `submit score` to submit your score and view the leader board.

# how to clone
- clone the repository using the command `git clone 
- open the folder in your code editor.
- open the `database.php` file and change the database credentials to match your database.

