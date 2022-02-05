<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css" type="text/css">
    <title>NHS || Questionnaire 3</title>
  </head>
  <body>

  <?php
      include 'insertanswers.php';
    ?>

<div class="container">
  <div class="nav"><h2 style="font-size: 30px;font-weight:500;line-height:1.1;margin-top: 20px;margin-bottom: 10px;">Monthly Mental Health Survey</h2>
        <div class="navRight">
          <div class="left"> <a style="color:#fff;  margin-top: 20px;
          margin-bottom: 10px;" href="../dashboard.php">Home</a> </div>
          <div class="left"> <a style="color:#fff; margin-top: 20px;
          margin-bottom: 10px;" href="../dashboard.php">Help</a> </div>
          <div class="left"> <a style="color:#fff; margin-top: 20px;
          margin-bottom: 10px;" href="../logout.php">Logout</a> </div> </div>
    </div>
<div class="content" style="margin-top:20px;">
    <h1>Questionnaire 3 - Leader Support</h1>
    <p style="margin-bottom:100px;">The following questions deal with your working relationship with your immediate supervisor, that is, the person
      who most immediately supervises you and to whom you are responsible for your work. </p>

      <p>How much does your immediate superior: </p>

    <form id="questionnaire3" method="POST" action="insertanswers.php">
      <!--questionnaire no-->
      <input
        id="questionnaire_no"
        name="questionnaire_no"
        type="hidden"
        value="3"
      />

      <!--Question 1-->
      <section id="question1">
        <p>1. Encourage you to give your best effort?</p>

        <input type="radio" id="q1_1" name="q1" value="1" style="width:auto; display:inline-block;"/>
        <label for="q1_1">1</label>

        <input type="radio" id="q1_2" name="q1" value="2" style="width:auto; display:inline-block;"/>
        <label for="q1_2">2</label>

        <input type="radio" id="q1_3" name="q1" value="3" style="width:auto; display:inline-block;"/>
        <label for="q1_3">3</label>

        <input type="radio" id="q1_4" name="q1" value="4" style="width:auto; display:inline-block;"/>
        <label for="q1_4">4</label>

        <input type="radio" id="q1_5" name="q1" value="5" style="width:auto; display:inline-block;"/>
        <label for="q1_5">5</label>
      </section>

      <!--Question 2-->
      <section id="question2">
        <p>2. Set an example by working hard him/herself? </p>

        <input type="radio" id="q2_1" name="q2" value="1" style="width:auto; display:inline-block;"/>
        <label for="q2_1">1</label>

        <input type="radio" id="q2_2" name="q2" value="2" style="width:auto; display:inline-block;"/>
        <label for="q2_2">2</label>

        <input type="radio" id="q2_3" name="q2" value="3" style="width:auto; display:inline-block;"/>
        <label for="q2_3">3</label>

        <input type="radio" id="q2_4" name="q2" value="4" style="width:auto; display:inline-block;"/>
        <label for="q2_4">4</label>

        <input type="radio" id="q2_5" name="q2" value="5" style="width:auto; display:inline-block;"/>
        <label for="q2_5">5</label>
      </section>

      <!--Question 3-->
      <section id="question3">
        <p>3. Offer new ideas for solving job-related problems? </p>

        <input type="radio" id="q3_1" name="q3" value="1" style="width:auto; display:inline-block;"/>
        <label for="q3_1">1</label>

        <input type="radio" id="q3_2" name="q3" value="2" style="width:auto; display:inline-block;"/>
        <label for="q3_2">2</label>

        <input type="radio" id="q3_3" name="q3" value="3" style="width:auto; display:inline-block;"/>
        <label for="q3_3">3</label>

        <input type="radio" id="q3_4" name="q3" value="4" style="width:auto; display:inline-block;"/>
        <label for="q3_4">4</label>

        <input type="radio" id="q3_5" name="q3" value="5" style="width:auto; display:inline-block;"/>
        <label for="q3_5">5</label>
      </section>

      <!--Question 4-->
      <section id="question4">
        <p>4. Encourage those who work for him/her to work as a team? </p>

        <input type="radio" id="q4_1" name="q4" value="1" style="width:auto; display:inline-block;"/>
        <label for="q4_1">1</label>

        <input type="radio" id="q4_2" name="q4" value="2" style="width:auto; display:inline-block;"/>
        <label for="q4_2">2</label>

        <input type="radio" id="q4_3" name="q4" value="3" style="width:auto; display:inline-block;"/>
        <label for="q4_3">3</label>

        <input type="radio" id="q4_4" name="q4" value="4" style="width:auto; display:inline-block;"/>
        <label for="q4_4">4</label>

        <input type="radio" id="q4_5" name="q4" value="5" style="width:auto; display:inline-block;"/>
        <label for="q4_5">5</label>
      </section>

      <br />
      <input type="submit" name="submit" style="margin-top: 30px;
      text-transform: uppercase;
      text-decoration: none;
      background-color: #005EB8;
      color: #fff;
      font-size: 18px;
      letter-spacing: 1px;
      border-radius: 40px;
      border-color: #005EB8;
      border-style: solid;
      padding: 12px 36px;
      cursor: pointer;
      display:inline;"/>
      <br>
      <p>Response scale: 1 = not at all, 2 = just a little, 3 = moderate amount, 4 = quite a lot, 5 = a great deal</p>
    </form></div>  <div class="footer">

      </div>
</div>
  </body>
</html>
