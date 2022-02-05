<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>NHS || Your Details</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
  </head>
  <body>





<?php
    echo "<div class='viewDeS'><h1 style='color:#005EB8;'>Your details</h1> <br />";

    try{
        session_start();
         // get variables from login
         $user_id = $_SESSION['user_id'];
         $username = $_SESSION['username'];

        // get db info
        require("../../../db.php");

        echo "Email address: " . $username . "<br />";

        for($details = 1; $details <=9; $details++){

            // get relevant detail

            switch($details){
                case 1:
                    $detail = "Gender";
                    break;
                case 2:
                    $detail = "Age";
                    break;
                case 3:
                    $detail = "Ethnicity";
                    break;
                case 4:
                    $detail = "Familystatus";
                    break;
                case 5:
                    $detail = "Dependents";
                    break;
                case 6:
                    $detail = "Caring";
                    break;
                case 7:
                    $detail = "Hospital";
                    break;
                case 8:
                    $detail = "Staffrole";
                    break;
                case 9:
                    $detail = "Based";
                    break;
            }

            // get  id
            $q = $myPDO->prepare("SELECT $detail FROM userdetails WHERE user_id=:user_id;");
            $q->execute(['user_id' => $user_id]);
            $results = $q->fetchColumn();

            echo $detail . ": " . $results . " <br />";

        }

        echo "</div>";

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

?>

</body>
</html>
