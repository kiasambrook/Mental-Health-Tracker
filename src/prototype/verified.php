<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NHS || Verified Email</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <?php
    require("../../../db.php");
    
    // checks to see whether vkey is in URL
    if(isset($_GET['vkey'])){
        // get verification code from URL
        $vkey = $_GET['vkey'];


        // updates the users table to show that the email is validated
        $query = "UPDATE users
                   SET emailval = 'true'
                   WHERE vkey = '".$vkey."'";

        $myPDO->query($query);

        echo "<h1>Your email is now verified!</h1>";
        echo "<p>You can login <a href='enter.html'>here</a>.";

        
    }else{
        die("<h1>Uh oh!</h1>
            <p>Something went wrong!</p>");
    }    
    

    
    ?>
</body>
</html>