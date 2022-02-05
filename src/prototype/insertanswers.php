<?php 
// get db info
    require("../../../db.php");

    ob_start();

    try{

        if(isset($_POST['submit'])){
            // get variables from login 
            session_start();
            $user_id = $_SESSION['user_id'];
            $user_id = intval($user_id);

            $month = $_SESSION['month'];
            $year = $_SESSION['year'];
            $date = date("Y-m-d");
            $q_no = $_POST["questionnaire_no"];

            // get answers for q1,2,3, and 4
            $q1 = $_POST["q1"];
            $q2 = $_POST["q2"];
            $q3 = $_POST["q3"];
            $q4 = $_POST["q4"];

            // if questionnare is 2,3,4, or 6 then set answers 5 and 6 to NULL
            if($q_no == 2 || $q_no == 3 || $q_no == 4 || $q_no == 6){
                $q5 = "NULL";
                $q6 = "NULL";
            }
            elseif($q_no == 5){
                $q5 = $_POST["q5"];
                $q6 = "NULL";
            }
            else{
                $q5 = $_POST["q5"];
                $q6 = $_POST["q6"];
            }

            // insert form into db
            $query = "INSERT INTO questionnaires(user_id,completion_date, questionnaire_no, q1,q2,q3,q4,q5,q6,month,year) 
            VALUES('".$user_id."','".$date."','".$q_no."','".$q1."','".$q2."','".$q3."','".$q4."',$q5,$q6,'".$month."','".$year."')";
            
            if ($myPDO->query($query)) {
                header("Location:../dashboard.php");
                
            } 
            else{
                echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
            }
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }


?>