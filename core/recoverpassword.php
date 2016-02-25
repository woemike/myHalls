<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Recover Password myHalls</title>

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

        <form   action="recoverpassword.php" method="post" name="query">
          <fieldset  class="clearfix">

          <p><span class="fontawesome-envelope"></span>
            <input type="text" value="Email" name="email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" required></p> 
          <p><input type="submit" name="resend" value="Recover"></p>
    
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
  $email = $_POST["email"];
  $regex = "/^[a-zA-Z0-9-.]*\@student\.manchester\.ac\.uk$/";

  if (!preg_match($regex, $email)) // Validate email address
  {
     $msg="Invalid email address.";
  }
  else
  { 
     $count = mysqli_query($mysqli,"SELECT userPassword FROM Table_Users WHERE userEmail = '$email'");

    if(mysqli_num_rows($count) == 0)
    {
      $msg="The email is wrong. Try again!";
    }
    elseif(mysqli_num_rows($count) == 1)
    {
     $query = "SELECT userPassword, userEmail FROM Table_Users where userEmail = '$email'";
     $result = mysqli_query($mysqli,$query);
     $password = mysqli_fetch_array($result,MYSQLI_ASSOC);

     // sending email
    include 'Send_Mail.php';
    $to=$email;
    $subject="Password Reset";
    $body='Hi, <br/> <br/> Here is your code to reset your password!<br/> <br/> 
    <b>Your Password:</b> '.$password["userPassword"].'<br/> <br/> Please delete this email after you have read it!';
    Send_Mail($to,$subject,$body);
    header("Location: changePassword.php");
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
