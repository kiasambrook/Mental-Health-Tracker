<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>NHS || Questionnaire 1</title>
  </head>
  <body>
    <?php 
      include 'insertanswers.php';
    ?>

<div class="container">
  <div class="nav"><h2 style="font-size: 30px;font-weight:500;line-height:1.1;margin-top: 20px;margin-bottom: 10px;">Monthly Mental Health Survey</h2>
        <div class="navRight">
        <div class="left"> <a style="color:#fff;  margin-top: 20px;
        margin-bottom: 10px;" href="dashboard.php">Home</a> </div>
        <div class="left"> <a style="color:#fff; margin-top: 20px;
        margin-bottom: 10px;" href="dashboard.php">Help</a> </div>
        <div class="left"> <a style="color:#fff; margin-top: 20px;
        margin-bottom: 10px;" href="logout.php">Logout</a> </div> </div>
    </div>

    <h1>Questionnaire 1 - Autonomy and Control</h1>
    <p>The following questions concern the amount of choice you have in your job. </p>
    <p>To what extent do you: </p>

    <form id="questionnaire1" method="POST" action="insertanswers.php">
      <!--questionnaire no-->
      <input
        id="questionnaire_no"
        name="questionnaire_no"
        type="hidden"
        value="1"
      />

      <!--Question 1-->
      <section id="question1">
        <p>1. Determine the methods and procedures you use in your work?</p>

        <input type="radio" id="q1_1" name="q1" value="1" required/>
        <label for="q1_1">1</label>

        <input type="radio" id="q1_2" name="q1" value="2" />
        <label for="q1_2">2</label>

        <input type="radio" id="q1_3" name="q1" value="3" />
        <label for="q1_3">3</label>

        <input type="radio" id="q1_4" name="q1" value="4" />
        <label for="q1_4">4</label>

        <input type="radio" id="q1_5" name="q1" value="5" />
        <label for="q1_5">5</label>
      </section>

      <!--Question 2-->
      <section id="question2">
        <p>2. Choose what work you will carry out?</p>

        <input type="radio" id="q2_1" name="q2" value="1" required />
        <label for="q2_1">1</label>

        <input type="radio" id="q2_2" name="q2" value="2" />
        <label for="q2_2">2</label>

        <input type="radio" id="q2_3" name="q2" value="3" />
        <label for="q2_3">3</label>

        <input type="radio" id="q2_4" name="q2" value="4" />
        <label for="q2_4">4</label>

        <input type="radio" id="q2_5" name="q2" value="5" />
        <label for="q2_5">5</label>
      </section>

      <!--Question 3-->
      <section id="question3">
        <p>3. Decide when to take a break?</p>

        <input type="radio" id="q3_1" name="q3" value="1" required />
        <label for="q3_1">1</label>

        <input type="radio" id="q3_2" name="q3" value="2" />
        <label for="q3_2">2</label>

        <input type="radio" id="q3_3" name="q3" value="3" />
        <label for="q3_3">3</label>

        <input type="radio" id="q3_4" name="q3" value="4" />
        <label for="q3_4">4</label>

        <input type="radio" id="q3_5" name="q3" value="5" />
        <label for="q3_5">5</label>
      </section>

      <!--Question 4-->
      <section id="question4">
        <p>4. Vary how you do your work?</p>

        <input type="radio" id="q4_1" name="q4" value="1" required />
        <label for="q4_1">1</label>

        <input type="radio" id="q4_2" name="q4" value="2" />
        <label for="q4_2">2</label>

        <input type="radio" id="q4_3" name="q4" value="3" />
        <label for="q4_3">3</label>

        <input type="radio" id="q4_4" name="q4" value="4" />
        <label for="q4_4">4</label>

        <input type="radio" id="q4_5" name="q4" value="5" />
        <label for="q4_5">5</label>
      </section>

      <!--Question 5-->
      <section id="question5">
        <p>5. Plan your own work?</p>

        <input type="radio" id="q5_1" name="q5" value="1" required />
        <label for="q5_1">1</label>

        <input type="radio" id="q5_2" name="q5" value="2" />
        <label for="q5_2">2</label>

        <input type="radio" id="q5_3" name="q5" value="3" />
        <label for="q5_3">3</label>

        <input type="radio" id="q5_4" name="q5" value="4" />
        <label for="q5_4">4</label>

        <input type="radio" id="q5_5" name="q5" value="5" />
        <label for="q5_5">5</label>
      </section>

      <!--Question 6-->
      <section id="question6">
        <p>6. Carry out your work in the way you think best?</p>

        <input type="radio" id="q6_1" name="q6" value="1" required/>
        <label for="q6_1">1</label>

        <input type="radio" id="q6_2" name="q6" value="2" />
        <label for="q6_2">2</label>

        <input type="radio" id="q6_3" name="q6" value="3" />
        <label for="q6_3">3</label>

        <input type="radio" id="q6_4" name="q6" value="4" />
        <label for="q6_4">4</label>

        <input type="radio" id="q6_5" name="q6" value="5" />
        <label for="q6_5">5</label>
      </section>

      <br />
      <input type="submit" name="submit"/>
      <br>
      <p>Response scale: 1 = not at all, 2 = just a little, 3 = moderate amount, 4 = quite a lot, 5 = a great deal</p>
    </form>

</div>
  </body>
</html>
