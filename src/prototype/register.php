<?php

    session_start();

    // get db creditials
    require("../../../db.php");

    try{
        
        if (isset($_POST['submit'])){
        
        // get current date/time
        $date = date('Y-m-d H:i:s'); 
        // encrypt the password
        $password = stripslashes($_POST["password2"]);
        $password = pg_escape_string($password);
        $epass = md5($password); 
        // get username
        $username = pg_escape_string ($_POST["username"]);
        $username = stripslashes($username);
        // set email verification code
        $vkey = md5(time().$username);

        // insert data into database
        $query = "INSERT INTO users(username,password,trn_date,vkey) VALUES('".$username."','".$epass."','".$date."','".$vkey."')";
        
        // if sucessful move onto the next part of registration
        if ($myPDO->query($query)) {
            $_SESSION['username'] = $username;
            $_SESSION['vkey'] = $vkey;
            
            header("Location:verifyEmail.php");
            
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
