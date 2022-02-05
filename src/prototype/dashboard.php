<?php
    session_start();
    // get variables from login
    $username = $_SESSION['username'];

    // get db info
    require("../../../db.php");

    // get user id
    $q = $myPDO->prepare("SELECT user_id FROM users WHERE username=:username;");
    $q->execute(['username' => $username]);
    $user_id = $q->fetchColumn();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // get month and year from URL
    $current_month = date('m');
    $month = $_GET["month"];
    $current_year = date('Y');
    $year = $_GET["year"];
    $_SESSION['month'] = $month;
    $_SESSION['year'] = $year;

    // display average for each month
        for($months =1; $months<=12;$months++){
            for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
                // work out the average for each questionnaire for that month
                if(($questionnaire_no >= 2 && $questionnaire_no <=4) || $questionnaire_no ==6){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4))/4 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");

                }else if($questionnaire_no == 5){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");

                }else if($questionnaire_no==1){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5)+avg(q6))/6 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");
                }
                else{
                    echo "error";
                }

            $query->execute(['month'=>$months, 'year'=>$year,'questionnaire_no'=>$questionnaire_no, 'user_id'=>$user_id]);
            $average_results=$query->fetchColumn();

            // if questionnaire has not been completed set average to 0
                if(!$average_results){
                    $average_results =0;
                }

                ${'answer' . $questionnaire_no}=$average_results;


            }
            ${'month' . $months}=($answer1 +$answer2+$answer3+$answer4+$answer5+$answer6)/6;

        }
        // Plot the data points on graph for average answer
        $dataPoints2 = array(
            array("y" => $month1, "label" => "January" ),
            array("y" => $month2, "label" => "February" ),
            array("y" => $month3, "label" => "March" ),
            array("y" => $month4, "label" => "April" ),
            array("y" => $month5, "label" => "May" ),
            array("y" => $month6, "label" => "June" ),
            array("y" => $month7, "label" => "July" ),
            array("y" => $month8, "label" => "August" ),
            array("y" => $month9, "label" => "September" ),
            array("y" => $month10, "label" => "October" ),
            array("y" => $month11, "label" => "November" ),
            array("y" => $month12, "label" => "December" ),
            );

    // for each questionnaire
    // search the questionnaire table to see get that month average
    for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
        // work out the average for each questionnaire for that month
        if(($questionnaire_no >= 2 && $questionnaire_no <=4) || $questionnaire_no ==6){
            $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4))/4 FROM questionnaires
            WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");

        }else if($questionnaire_no == 5){
            $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5 FROM questionnaires
            WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");

        }else if($questionnaire_no==1){
            $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5)+avg(q6))/6 FROM questionnaires
            WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no AND user_id=:user_id");
        }
        else{
            echo "error";
        }

    $query->execute(['month'=>$month, 'year'=>$year,'questionnaire_no'=>$questionnaire_no, 'user_id'=>$user_id]);
    $average_results=$query->fetchColumn();

    // if questionnaire has not been completed set average to 0
        if(!$average_results){
            $average_results =0;
        }else if($average_results >0){
            ${'completed' . $questionnaire_no}=true;
        }

        ${'answer' . $questionnaire_no}=$average_results;


    }

    // Plot the data points on graph for average answer
    $dataPoints = array(
        array("y" => $answer1, "label" => "Questionnaire 1" ),
        array("y" => $answer2, "label" => "Questionnaire 2" ),
        array("y" => $answer3, "label" => "Questionnaire 3" ),
        array("y" => $answer4, "label" => "Questionnaire 4" ),
        array("y" => $answer5, "label" => "Questionnaire 5" ),
        array("y" => $answer6, "label" => "Questionnaire 6" ),
        );


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>NHS || Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="test.css">

    <!-- JavaScript to load in chart-->
    <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            dataPointWidth: 50,
            width: 800,
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Average Questionnaire Answers for Month"
            },
            axisY: {
                title: "Average Anwser Score",
                maximum: 5,
                minimum: 0,
            },
            data: [{
                color:"#005EB8",
                type: "column",
                yValueFormatString: "#,##0.##",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });

        chart.render();

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            dataPointWidth: 50,
            width: 800,
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Average Questionnaire Answers for All Months"
            },
            axisY: {
                title: "Average Anwser Score",
                maximum: 5,
                minimum: 0,
            },
            data: [{
                color:"#005EB8",
                type: "column",
                yValueFormatString: "#,##0.##",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });

        chart2.render();
    }
</script>

</head>
<body>
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

    <div class="allContent">

    <div class="dashTitle">
      <h1>Dashboard</h1>
      <div class="dashP" style="
    ">
      <p>On this page you can access survey questionnaires, you can also review your average scores for each month, you can change email, password and your personal details.</p>

      <div class="updateButtons">
        <a href="#" class="viewD buttonStyle" data-toggle='modal' data-target='#viewDe'>View Details</a><br>
        <a href="#" class="updateE buttonStyle" data-toggle='modal' data-target='#updateEm'>Update Email</a><br>
        <a href="#" class="updateP buttonStyle" data-toggle='modal' data-target='#updatePa'>Update Password</a><br>
        <a href="#" class="updateD buttonStyle" data-toggle='modal' data-target='#updateDe'>Update Personal Details</a><br>
        <a href="#" class="withdraw buttonStyleRed" data-toggle='modal' data-target='#withDraw'>Withdraw from Study</a>
      </div>


    </div>
    </div>

    <div class="contetDash">

      <!-- Display chart-->
      <div id="chartContainer" style="height: 370px; width: 50%;"></div>
      <div id="chartContainer2" style="height: 370px; width: 50%;"></div>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


    </div>

    <div class="contentD">

      <div class="monthsGrid">
        <!--List of the months of the year w/ their month and year in the URL-->
        <a href="?month=<?php echo 1?>&year=<?php echo date('Y')?>" class="monthsGridButton">January</a>
        <a href="?month=<?php echo 2?>&year=<?php echo date('Y')?>" class="monthsGridButton">February</a>
        <a href="?month=<?php echo 3?>&year=<?php echo date('Y')?>"class="monthsGridButton">March</a>
        <a href="?month=<?php echo 4?>&year=<?php echo date('Y')?>"class="monthsGridButton">April</a>
        <a href="?month=<?php echo 5?>&year=<?php echo date('Y')?>"class="monthsGridButton">May</a>
        <a href="?month=<?php echo 6?>&year=<?php echo date('Y')?>"class="monthsGridButton">June</a>
        <a href="?month=<?php echo 7?>&year=<?php echo date('Y')?>"class="monthsGridButton">July</a>
        <a href="?month=<?php echo 8?>&year=<?php echo date('Y')?>"class="monthsGridButton">August</a>
        <a href="?month=<?php echo 9?>&year=<?php echo date('Y')?>"class="monthsGridButton">September</a>
        <a href="?month=<?php echo 10?>&year=<?php echo date('Y')?>"class="monthsGridButton">October</a>
        <a href="?month=<?php echo 11?>&year=<?php echo date('Y')?>"class="monthsGridButton">November</a>
        <a href="?month=<?php echo 12?>&year=<?php echo date('Y')?>"class="monthsGridButton">December</a>
      </div>

      <?php
          // allow december questionnaires to been shown if current month is January
          if(($current_month-1) == 0){
              $december = true;
              $current_year-= 1;
          }

          // display questionnaire links for the apporiate months if selected
          if(($current_month == $month && $current_year == $year) || $december || ((($current_month-3) == $month || ($current_month-2) == $month || ($current_month-1) == $month)) && $current_year == $year){
              echo '<ul>
                      <a href="questionnaire1.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed1) echo
                      'deactived';echo'">Questionnaire 1</a>

                      <a href="questionnaire2.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed2) echo
                      'deactived';echo'">Questionnaire 2</a>

                      <a href="questionnaire3.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed3) echo
                      'deactived';echo'">Questionnaire 3</a>

                      <a href="questionnaire4.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed4) echo
                      'deactived';echo'">Questionnaire 4</a>

                      <a href="questionnaire5.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed5) echo
                      'deactived';echo'">Questionnaire 5</a>

                      <a href="questionnaire6.php/?month='.$month.'&year='.$year.'"class="buttonStyle '; if($completed6) echo
                      'deactived';echo'">Questionnaire 6</a>
                  </ul>';
              }
              // all other months
              else if($month >=1 && $month <=12){
                  echo '<br>The questionnaires for this month are currently unavailable!';
              }
      ?>

    </div>

  </div>   <div class="footer">

    </div>

  </div>





        <!-- Modals -->
        <div class='modal fade' id='viewDe'> </div>
        <div class='modal fade' id='updateEm'> </div>
        <div class='modal fade' id='updatePa'> </div>
        <div class='modal fade' id='updateDe'> </div>
        <div class='modal fade' id='withDraw'> </div>

        <!-- Modal script -->
        <script>
          $(document).on('click','a.viewD',function(){
              $('#viewDe').load('viewdetails.php');
          });
          $(document).on('click','a.updateE',function(){
              $('#updateEm').load('updateemail.html');
          });
          $(document).on('click','a.updateP',function(){
              $('#updatePa').load('updatepassword.html');
          });
          $(document).on('click','a.updateD',function(){
              $('#updateDe').load('updatedetails.html');
          });
          $(document).on('click','a.withdraw',function(){
              $('#withDraw').load('withdraw.html');
          });
        </script>

</body>
</html>
