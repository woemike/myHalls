<?php 
session_start();
if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[2];
$firstname = $response[1];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Create Society</title>

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
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
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
            <a class="dropdown-text" href="editprofile.php">My Profile</a><br>
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
    <p>Create Society</p>

  <form action="societypage.php" method="post">
Society Name: <br><input type="text" pattern=".{5,}" required title="5 characters minimum" name="name" placeholder="e.g Expedition Society"><br>
Description: <br><textarea pattern=".{20,}" required title="20 characters minimum" class="text" cols="30" rows ="5" name="description" maxlength="200" 
                placeholder="e.g MUES is the first university-wide Expedition Society

We want to bring Manchester Students together to share experiences, resources and ideas to create incredible student-led expeditions around the world!

We're sure there are people with ideas as amazing as yours; whether it's for research, travel, exploration or pushing your own limits, we want to bring you together."></textarea><br>
<!-- Upload Image for society here -->

<input type="submit" value="Create Society" name="createsociety">
</form>



  </div>




    </div>

  <?php include("footer.php"); ?>  

</body>
</html>
