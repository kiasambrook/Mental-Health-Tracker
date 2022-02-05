<?php
    try{
            session_start();
            // get variables from login 
            $user_id = $_SESSION['user_id'];

            // get db info
            require("../../../db.php");

            // delete user from db
            $delete = "DELETE FROM users WHERE user_id=$user_id";
            $delete2="DELETE FROM userdetails WHERE user_id=$user_id";
            $delete3="DELETE FROM questionnaires WHERE user_id=$user_id";

            $myPDO->query($delete3);
            $myPDO->query($delete2);
            $myPDO->query($delete);

            header("Location:welcome.html");
        
    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    
    ?>
