<?php
            // get db info
            require("../../../db.php");

            // get month and year from URL
            $current_month = date('m');
            $month = $_GET["month"];
            $current_year = date('Y');
            $year = $_GET["year"];
            $completed1 = true;
            $_SESSION['month'] = $month;
            $_SESSION['year'] = $year;

            // view average results for full year
            if($month ==-1){
                for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
                    // work out the average for each questionnaire for that month
                    if(($questionnaire_no >= 2 && $questionnaire_no <=4) || $questionnaire_no ==6){
                        $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4))/4 FROM questionnaires
                        WHERE year=:year AND questionnaire_no=:questionnaire_no");
    
                    }else if($questionnaire_no == 5){
                        $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5 FROM questionnaires
                        WHERE year=:year AND questionnaire_no=:questionnaire_no");
    
                    }else if($questionnaire_no==1){
                        $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5)+avg(q6))/6 FROM questionnaires
                        WHERE year=:year AND questionnaire_no=:questionnaire_no");
                    }
                    else{
                        echo "error";
                    }
    
                $query->execute(['year'=>$current_year,'questionnaire_no'=>$questionnaire_no]);
                $average_results=$query->fetchColumn();
    
                // if questionnaire has not been completed set average to 0
                    if(!$average_results){
                        $average_results =0;
                    }
    
                    ${'answer' . $questionnaire_no}=$average_results;

                    $peoplecountquery = $myPDO->prepare("SELECT COUNT(*) FROM questionnaires
                    WHERE year=:year AND questionnaire_no=:questionnaire_no");
                    $peoplecountquery->execute(['year'=>$year,'questionnaire_no'=>$questionnaire_no]);
                    $people_results=$peoplecountquery->fetchColumn();
                    ${'completed_users' . $questionnaire_no}=$people_results;
                }
                
            }else{
            // for each questionnaire
            // search the questionnaire table to see get that month average
            for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
                // work out the average for each questionnaire for that month
                if(($questionnaire_no >= 2 && $questionnaire_no <=4) || $questionnaire_no ==6){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4))/4 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no");

                }else if($questionnaire_no == 5){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5))/5 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no");

                }else if($questionnaire_no==1){
                    $query = $myPDO->prepare("SELECT (avg(q1)+avg(q2)+avg(q3)+avg(q4)+avg(q5)+avg(q6))/6 FROM questionnaires
                    WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no");
                }
                else{
                    echo "error";
                }

            $query->execute(['month'=>$month, 'year'=>$year,'questionnaire_no'=>$questionnaire_no]);
            $average_results=$query->fetchColumn();

            // if questionnaire has not been completed set average to 0
                if(!$average_results){
                    $average_results =0;
                }

                ${'answer' . $questionnaire_no}=$average_results;

                $peoplecountquery = $myPDO->prepare("SELECT COUNT(*) FROM questionnaires
                WHERE month=:month AND year=:year AND questionnaire_no=:questionnaire_no");
                $peoplecountquery->execute(['month'=>$month, 'year'=>$year,'questionnaire_no'=>$questionnaire_no]);
                $people_results=$peoplecountquery->fetchColumn();
                ${'completed_users' . $questionnaire_no}=$people_results;
            }
        }

    // Plot the data points
    $dataPoints = array( 
        array("y" => $answer1, "label" => "Questionnaire 1" ),
        array("y" => $answer2, "label" => "Questionnaire 2" ),
        array("y" => $answer3, "label" => "Questionnaire 3" ),
        array("y" => $answer4, "label" => "Questionnaire 4" ),
        array("y" => $answer5, "label" => "Questionnaire 5" ),
        array("y" => $answer6, "label" => "Questionnaire 6" ),
    );

    $dataPoints2 = array( 
        array("y" => $completed_users1, "label" => "Questionnaire 1" ),
        array("y" => $completed_users2, "label" => "Questionnaire 2" ),
        array("y" => $completed_users3, "label" => "Questionnaire 3" ),
        array("y" => $completed_users4, "label" => "Questionnaire 4" ),
        array("y" => $completed_users5, "label" => "Questionnaire 5" ),
        array("y" => $completed_users6, "label" => "Questionnaire 6" ),
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>NHS || Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" />    


    <!-- JavaScript to load in chart-->
    <script>
        window.onload = function() {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            dataPointWidth: 50,
            width: 800,
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Average Questionnaire Answers"
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

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            dataPointWidth: 50,
            width: 800,
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Number of Users Completed Questionnaire"
            },
            axisY: {
                title: "User Count"
            },
            data: [{
                color:"#005EB8",
                type: "column",
                yValueFormatString: "#,##0.##",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
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
        margin-bottom: 10px;" href="logout.php">Logout</a> </div> </div>
    </div>

    <div class="allContent">

    <div class="dashTitle">
      <h1>Admin Dashboard</h1>
      <p>On this page you can access survey results, which can be reviewed for each month or for the whole year.</p>
    </div>

    <!-- Display chart-->
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <?php
        for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
        echo 'Average Questionnaire Results ' .$questionnaire_no . ': ' . round(${'answer' . $questionnaire_no},1) . '<br />'; 
        }
    ?>
    <br>

    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <?php
        for($questionnaire_no = 1; $questionnaire_no<=6; $questionnaire_no++){
        echo 'Number of users who completed questionnaire ' .$questionnaire_no . ': ' . ${'completed_users' . $questionnaire_no} . '<br />'; 
        }
    ?> 
    <br>


<div class="contentD">
<div class="monthsGrid">
    <!--List of the months of the year w/ their month and year in the URL-->
        <a href="?month=<?php echo -1?>&year=<?php echo date('Y')?>"class="monthsGridButton">All Months</a>
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
    <br>
    </div>
    </div>
    </div>
    </div>

</body>
</html>