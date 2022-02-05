<?php

    // get db info
    require("../../../db.php");

    session_start();
    // get variables from login 
    $username = $_SESSION['username'];

    // get user id
    $q = $myPDO->prepare("SELECT user_id FROM users WHERE username=:username;");
    $q->execute(['username' => $username]);
    $user_id = $q->fetchColumn();

    try{
        // insert form to database alongside user's id
        $query = "INSERT INTO userdetails(gender,age,ethnicity,familystatus,dependents,caring,hospital,staffrole,based,user_id) 
        VALUES('".$_POST["gender"]."','".$_POST["age"]."','".$_POST["ethnicity"]."','".$_POST["familystatus"]."','".$_POST["dependents"]."','".$_POST["caring"]."','".$_POST["hospital"]."','".$_POST["staffrole"]."','".$_POST["based"]."','$user_id')";
        
        if ($myPDO->query($query)) {
            $update_query = "UPDATE users
                            SET userdetails ='true'
                            WHERE user_id=$user_id";

            $myPDO->query($update_query);



            header("Location:dashboard.php");
        } 
        else{
            echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
        }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }


?>