<?php
    try{
            session_start();
            // get variables from login
            $user_id = $_SESSION['user_id'];

            // get db info
            require("../../../db.php");

            // get the values
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $ethnicity = $_POST['ethnicity'];
            $familystatus = $_POST['familystatus'];
            $dependents = $_POST['dependents'];
            $caring = $_POST['caring'];
            $hospital = $_POST['hospital'];
            $staffrole = $_POST['staffrole'];
            $based = $_POST['based'];

            // update user details
            $q = "UPDATE userdetails
            SET gender='".$gender."', age='".$age."', ethnicity='".$ethnicity."', familystatus='".$familystatus."', dependents='".$dependents."',caring='".$caring."',hospital='".$hospital."', staffrole='".$staffrole."',based='".$based."'
            WHERE user_id='".$user_id."'";
            $myPDO->query($q);

            header("Location:dashboard.php");

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    ?>
