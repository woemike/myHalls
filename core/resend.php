<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Resend myHalls</title>

    <link rel="stylesheet" href="myHallsLi.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="fontawesome.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="meyerweb-reset.css" media="screen" type="text/css" />
</head>

<body>

  <div class="header-cont">

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

        <form   action="resend.php" method="post" name="query">
          <fieldset  class="clearfix">

          <p><span class="fontawesome-envelope"></span>
            <input type="text" value="Email" name="email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" required></p> 
          <p><input type="submit" name="resend" value="Resend Code"></p>
    
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
$msg="";
if(isset($_POST['resend']))
{
  $email = $_POST['email'];
  $activationCode = bin2hex(openssl_random_pseudo_bytes(5));
  $regex = "/^[a-zA-Z0-9-.]*\@student\.manchester\.ac\.uk$/";

  if (!preg_match($regex, $email)) // Validate email address
  {
    $msg="Invalid email address. Please type a valid email!";
  }
  else
  { 
     $count = mysqli_query($mysqli,"SELECT userEmail FROM Table_Users WHERE emailVerif = '0' AND userEmail = '$email'");

    if(mysqli_num_rows($count) == 0)
    {
      $msg="The email is wrong. Try again!";
    }
    elseif(mysqli_num_rows($count) == 1)
    {
      mysqli_query($mysqli,"UPDATE Table_Users SET activationCode = '$activationCode' WHERE userEmail = '$email'");
     // sending email
     include 'Send_Mail.php';
     $to=$email;
     $subject="Email verification";
     $body='Hi, <br/> <br/> Here is your new code! Please verify your email!<br/> <br/> 
     <b>Your Code:</b> '.$activationCode.'';
     Send_Mail($to,$subject,$body);
     header("Location: activation.php");
     $_SESSION["email"] = $email;
    }
  }
 }    

// Always close your connection to the database cleanly!
$mysqli -> close();

?>
          <div class="msg"><?php echo $msg; ?></div>
        </div>
      </div>
    </div>
  </body>
</html>
