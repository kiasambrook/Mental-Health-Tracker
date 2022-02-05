<?php
        require('../../../db.php');
        session_start();

        try{
            // removes backslashes
            $username = $_POST['username'];
            //escapes special characters in a string
            $password = stripslashes($_POST['password']);
            $password = md5($password);
            
            // Find corresponding username and password
            $stmt = $myPDO->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
            $stmt->execute(['username'=>$username, 'password'=>$password]);
            $results = $stmt->fetch();

            // if login is correct and the user has completed personal details and email validation
            if($results){
                $current_year = date('Y');
                header("Location:admindashboard.php?month=-1&year=$current_year");
                $_SESSION['username'] = $username;
            }
            // if login is incorrect
            else if(!$results){
                header("Location:faillogin.html");
                
            }
            else{
                echo "something went wrong";
            }
        }
        catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    ?>