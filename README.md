StudyTemplate
=============
PHP site which uses a list of questions and answers to supply the user with endless amounts of multiple choice questions. Keeps track of correct/incorrect answers using cookies.

Installation
============
Add the files to your server. You'll probably want to create a new 'qas.txt' file with whatever questions you want.

Creating the Questions/Answers
==============================
To create questions and answers, you need to create your own 'qas.txt' file. The format is a modified version of csv, where each line has a question and its answer separated by the '|' character.

Example:
```
Who was the first president of the USA?|George Washington
What atoms make a water molecule?|2 Hydrogen, 1 Oxygen
```

To ask a question, the site pulls 4 random lines from the file (1 for the question and its answer, and the other 3 as the other choices). Therefore, try to avoid having the same answer to two different questions. If you must have questions with the same answers, you'll need to modify the code to make sure you're not displaying two of the same answer.
