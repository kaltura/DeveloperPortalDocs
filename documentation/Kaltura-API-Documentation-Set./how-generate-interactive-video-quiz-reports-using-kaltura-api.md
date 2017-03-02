---
layout: page
title: How to Generate Interactive Video Quiz Reports Using the Kaltura API?
---

<p>
    There are 2 types of reports you can generate using the Kaltura API:
  </p>
  
  <ul>
    <li>
      <a href="#detailed">Detailed Information Reports</a>
    </li>
    <li>
      <a href="#counts">Count Reports</a>
    </li>
  </ul>
  
  <p>
    Each type of report contains 4 reports.
  </p>
  
  <p>
    The answer from the server is returned as XML\JSON response.
  </p>
  
  <h3>
    <a name="detailed"></a>Detailed Information Reports
  </h3>
  
  <p>
    <strong>QUIZ</strong>
  </p>
  
  <p>
    Per each question:
  </p>
  
  <ul>
    <li>
      question_id
    </li>
  </ul>
  
  <p>
    Percentage of correct answers
  </p>
  
  <ul>
    <li>
      num_of_correct_answers
    </li>
    <li>
      num_of_wrong_answers
    </li>
  </ul>
  
  <p>
    <strong>QUIZ_USER_PERCENTAGE</strong>
  </p>
  
  <p>
    For a list of user\s on a specific quiz:
  </p>
  
  <p>
    Per each question:
  </p>
  
  <ul>
    <li>
      question_id
    </li>
  </ul>
  
  <p>
    Percentage of correct answers
  </p>
  
  <ul>
    <li>
      num_of_correct_answers
    </li>
    <li>
      num_of_wrong_answers
    </li>
  </ul>
  
  <p>
    <strong>QUIZ_AGGREGATE_BY_QUESTION</strong>
  </p>
  
  <p>
    For a specific question:
  </p>
  
  <p>
    Percentage of correct answers
  </p>
  
  <ul>
    <li>
      num_of_correct_answers
    </li>
    <li>
      num_of_wrong_answers
    </li>
  </ul>
  
  <p>
    <strong>QUIZ_USER_AGGREGATE_BY_QUESTION</strong>
  </p>
  
  <p>
    For a specific question and for a list of users:
  </p>
  
  <p>
    Percentage of correct answers
  </p>
  
  <ul>
    <li>
      num_of_correct_answers
    </li>
    <li>
      num_of_wrong_answers
    </li>
  </ul>
  
  <h3>
    <a name="counts"></a>Counts Only Information Reports
  </h3>
  
  <p>
    <strong>QUIZ</strong>
  </p>
  
  <p>
    How many questions are in the quiz?
  </p>
  
  <p>
    <strong>QUIZ_USER_PERCENTAGE</strong>
  </p>
  
  <p>
    How many users submitted the quiz?
  </p>
  
  <p>
    <strong>QUIZ_USER_AGGREGATE_BY_QUESTION</strong>
  </p>
  
  <p>
    How many users answered the question on the quiz(quizes).
  </p>
