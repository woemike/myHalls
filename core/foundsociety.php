<?php 
session_start();
if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$lastname = $response[2];
$firstname = $response[1];
$username = $response[1] . ' ' . $response[2];
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Found Society</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

     <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>


  <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
</head>
<body>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                            
            
            <a class="logo" href="mainpage.php"><img src="images/myHallsLogo.png" alt="myHalls logo" 
             height="30"></a>
             <div class="icons">
          <a class="icon-users" href="profilepage.php"><img src="images/usericon.png" alt="user icon"></a>
          <a class="icon-halls" href="mainpage.php"><img src="images/hallsicon.png" alt="user icon"></a>
          <a class="icon-society" href="societypage.php"><img src="images/societyicon.png" alt="user icon"></a>
          <a class="icon-nightsout" href="nightsoutpage.php"><img src="images/nightsouticon.png" alt="user icon"></a>
            </div>
     
      <div class="user-dropdown">
      
        
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-decoration:none; color: white"
>
            <?php print $username; echo " ";?><span class="caret"></span></a>


          <ul class="dropdown-menu">
            <img class="profilepic" src="images/profilepicture.jpg" alt="profile picture">
            <a class="dropdown-text" href="editprofile.php">My Profile</a>
            <a class="signout-text" href="#">Sign Out</a>
          </ul>
        </li>

      </ul>
  </div>
    </div>
        </div>
        <!-- /.container -->
    </nav>

  <div class="content-container">
  <div class="content-middle">
  <p><b><center>Request to create a society</center></b></p>

  <form action="foundsociety.php" method="post">
<center><b>Society Name: </b><br><input type="text" pattern=".{5,}" required title="5 characters minimum" name="nameSociety"><br></center><br>
<center><b>Description: </b><br><textarea pattern=".{20,}"  class="text" cols="50" rows ="14" name="description" maxlength="1000" 
                placeholder="Write a description about what this society will  provide for UoM students. Briefly explain your plan for the future."></textarea></center><br>
<center><input type="submit" value="Send" name="send"></center>
</form>

<?php
if(isset($_POST['send']))
{
    $email = $_SESSION["email"];
    $nameSociety = $_POST['nameSociety'];
    $reason = $_POST['reason'];
    $description = $_POST["description"];
    $break = '<br/>';

    include 'Send_Mail.php';
    $to = "myhallsactivation@gmail.com";
    $subject = "Request Society";
    $body = '<br/>Society request from <b>'.$username.'</b> <br/><br/>The name of the society is: <b>'.$nameSociety.'</b> <br/> <br/><b>The description is:</b><i> '.$description.'</i>
    <br/> <br/>Respond to: '.$email.'';

    Send_Mail($to,$subject,$body);
    header("Location: mainpage.php");
    $_SESSION["email"] = $email;
}
?>

  </div>
    </div>
    <footer class="footer">
      <div class="containerfooter">
        <center>
        <p class="text-muted">Copyright © 2015 myHalls. All rights reserved. <a href="contactus.php" class="text-muted">Contact Us</a></p></center>
      </div>
    </footer>

</body>
</html>
