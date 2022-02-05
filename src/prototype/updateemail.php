<?php
    try{
            session_start();
            // get variables from login 
            $user_id = $_SESSION['user_id'];

            // get db info
            require("../../../db.php");

            // get the values
            $newemail = $_POST['newemail'];

            // check to see if email already exists
           $existingemail = $myPDO->prepare("SELECT username FROM users WHERE username=:username");
           $existingemail->execute(['username'=>$newemail]);
           $email_results = $existingemail->fetch();

           if($email_results){
               echo "Email already exists, please try again!";
           }else{
            // update user details
            $q = "UPDATE users 
            SET username='".$newemail."'
            WHERE user_id='".$user_id."'";
            $myPDO->query($q);


            header("Location:enter.html");
           }

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
    ?>
