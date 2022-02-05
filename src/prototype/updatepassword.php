<?php
    try{
            session_start();
            // get variables from login 
            $user_id = $_SESSION['user_id'];

            // get db info
            require("../../../db.php");

            // get the values
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['password'];

            $oldpassword= md5($oldpassword);
            $newpassword = md5($newpassword);

            // check to see if password is correct
           $correctpassword = $myPDO->prepare("SELECT password FROM users WHERE user_id=:user_id AND password=:password");
           $correctpassword->execute(['user_id'=>$user_id, 'password'=>$oldpassword]);
           $password_results = $correctpassword->fetch();

           if($password_results){
               echo "correct password";
               // update user password
            $q = "UPDATE users 
            SET password='".$newpassword."'
            WHERE user_id='".$user_id."'";
            $myPDO->query($q);
            // header("Location:dashboard.php");

            echo "success!";
           }else{
            echo "incorrect password!";

           
           }

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
    ?>
