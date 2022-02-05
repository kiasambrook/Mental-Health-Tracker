<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>NHS Register || Verify Email</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>

    <?php
    session_start();
    require_once("register.php");
    
    // get variables from register form
    $username = $_SESSION['username'];

    // get db info
    require("../../../db.php");

    // get verification key
    $q = $myPDO->prepare("SELECT vkey FROM users WHERE username=:username;");
    $q->execute(['username' => $username]);
    $vkey = $q->fetchColumn();


    // send verification email with link
    $to  = "$username";
    $subject = 'Verify Your Email';
    $message = 'Thank you for registering with us, to verify your email please click <a href="https://users.aber.ac.uk/kjs15/CS22220/prototype/verified.php?vkey=' .$vkey. '">here</a>';
    
    // set mail parameters
    $headers = 'From: no-reply@cs22220group1.com' . "\r\n" .
    'Reply-To: cs22220group1@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to, $subject, $message, $headers);
    
    
    // display page
    echo "<h1>Thanks for registering!</h1>";
    echo "<p>To continue with login, you will need to verify your account. To do this click the link that we have now sent to your email inbox at <strong>$username</strong>. If you cannot find the email check your junk box.</p>";
    echo "<p>Once you have verified your account, you can <a href='enter.html'>login</a>.</p>";
    
    session_destroy();

    ?>
</body>

</html>
