<?php 
 session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");?>
<!DOCTYPE html>
<html>
<head>
  <title>Change Password myHalls</title>

    <link rel="stylesheet" href="myHallsLi.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="fontawesome.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="meyerweb-reset.css" media="screen" type="text/css"/>

</head>

<body>
  <div class="header-cont">
      <div class="logo">
         <img src="images/logo-corner.png" alt="myHalls logo" height="30"></a>
        </div>
      <div class="header">
        <div class="logo">
         <img src="images/logo-corner.png" alt="myHalls logo" height="30"></a>
        </div>
      </div>

  </div>
<div class="container-body">
     <img src="images/logo.png" class="imgn"> 

    <div class="container-form">

      <div id="login">

        <form method="post" action="changePassword.php">

          <fieldset class="clearfix">

            <p><span class="fontawesome-envelope"></span><input type="text" value="Code" name="code" onBlur="if(this.value == '') this.value = 'Code'" onFocus="if(this.value == 'Code') this.value = ''" required></p> 
            <p><span class="fontawesome-lock"></span><input type="Password"  name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
            <p><span class="fontawesome-lock"></span><input type="Password"  name="repassword" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
            <p><input type="submit" value="Change Password" name="change"></p>

          </fieldset>
        </form>


 <?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');
// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
// Check for errors before doing anything else
if($mysqli -> connect_error) {
die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}

$msg = "Check your email for the code!";

if(isset($_POST['change']))
{
  $email = $_SESSION["email"];
  $code = $_POST['code'];
  $password= $_POST['password'];
  $repassword = $_POST['repassword'];
  $password = md5($password);
  $repassword = md5($repassword);
  $regex = "/^[a-zA-Z0-9-.]*\@student\.manchester\.ac\.uk$/";

  $c = mysqli_query($mysqli,"SELECT userPassword FROM Table_Users WHERE 
                            userEmail = '$email' AND userPassword = '$code'");

  if(mysqli_num_rows($c) <= 0)
  {
    $msg = "The code is wrong. Please try again!";
  }
  elseif($password != $repassword)
  {
    $msg = "Passwords don't match!";
  }
  elseif(mysqli_num_rows($c) > 0)
  {
    $count = mysqli_query($mysqli,"SELECT userPassword FROM Table_Users WHERE userPassword = '$code' AND userEmail = '$email'");
   
    if(mysqli_num_rows($count) == 1)
    {
      mysqli_query($mysqli,"UPDATE Table_Users SET userPassword = '$password' WHERE userEmail = '$email'");
      header("Location: myHallsLog.php");
      $msg = "Your password has been reset!";
    }
  }
}


?>
             <div class="msg"><?php echo $msg; ?></div>
        </div>
      </div>
    </div>
  </body>
</html>
