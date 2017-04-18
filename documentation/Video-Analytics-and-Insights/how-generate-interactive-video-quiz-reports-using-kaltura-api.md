---
layout: page
title: How to Generate Interactive Video Quiz Reports Using the Kaltura API?
weight: 111
---


There are two types of reports you can generate using the Kaltura API:

* Detailed information reports
* Count reports

Each type of report contains sub-reports.
The answer from the server is returned as XML\JSON response.

## Detailed Information Reports  

### QUIZ  

Per each question:

* question_id

Percentage of correct answers

* num_of_correct_answers
* num_of_wrong_answers

### QUIZ_USER_PERCENTAGE

For a list of user\s on a specific quiz:

Per each question:

* question_id

Percentage of correct answers

* num_of_correct_answers
* num_of_wrong_answers

### QUIZ_AGGREGATE_BY_QUESTION

For a specific question:

Percentage of correct answers

* num_of_correct_answers
* num_of_wrong_answers

### QUIZ_USER_AGGREGATE_BY_QUESTION

For a specific question and for a list of users:

Percentage of correct answers

* num_of_correct_answers
* num_of_wrong_answers

## Counts Only Information Reports

### QUIZ

How many questions are in the quiz?

### QUIZ_USER_PERCENTAGE

How many users submitted the quiz?

### QUIZ_USER_AGGREGATE_BY_QUESTION

How many users answered the question on the quiz(quizes).
