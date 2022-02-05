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
            $stmt = $myPDO->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
            $stmt->execute(['username'=>$username, 'password'=>$password]);
            $results = $stmt->fetch();

            // see if the user is validated
            $emailval = $myPDO->prepare("SELECT * FROM users WHERE username=:username AND emailval='t'");
            $emailval->execute(['username'=>$username]);
            $email_results = $emailval->fetch();

            // see if the user is validated
           $userdetails = $myPDO->prepare("SELECT * FROM users WHERE username=:username AND userdetails='t'");
            $userdetails->execute(['username'=>$username]);
            $userdetails_results = $userdetails->fetch();
            
            // if login is correct and the user has completed personal details and email validation
            if($results && $email_results && $userdetails_results){
                $current_month = date('n');
                $current_year = date('Y');
                header("Location:dashboard.php?month=-1&?year=$current_year");
                $_SESSION['username'] = $username;
            }
            // if login is incorrect
            else if(!$results){
                header("Location:faillogin.html");
                
            }
            // if user has not completed their personal details
           else if($email_results && !$userdetails_results){
                $_SESSION['username'] = $username;
                header("Location:personalDetails.html");
            }
            // if user has not validated their email
            else if(!$email_results){
                $_SESSION['username'] = $username;
                header("Location:verifyEmail.php");
            }
            else{
                echo "something went wrong";
            }
        }
        catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    ?>