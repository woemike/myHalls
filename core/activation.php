<!DOCTYPE html>
<html>
<head>
  <title>Activation myHalls</title>

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

        <form method="post" action="activation.php">

          <fieldset class="clearfix">
            <p><span class="fontawesome-envelope"></span><input type="text" value="Code" name='code' onBlur="if(this.value == '') this.value = 'Code'" onFocus="if(this.value == 'Code') this.value = ''" required></p> 
            <p><input type="submit" value="Activate" name="activate"></p>

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

 $msg="Please activate your email.";

if(isset($_POST['activate']))
{
  $code = $_POST['code'];
  $c = mysqli_query($mysqli,"SELECT userEmail FROM Table_Users WHERE activationCode = '$code'");

  if(mysqli_num_rows($c) > 0)
  {
    $count=mysqli_query($mysqli,"SELECT userEmail FROM Table_Users WHERE activationCode = '$code' and emailVerif = '0'");

    if(mysqli_num_rows($count) == 1)
    {
      mysqli_query($mysqli,"UPDATE Table_Users SET emailVerif = '1' WHERE activationCode = '$code'");
      header("Location:logout.php");
      $_SESSION["email"] = $email;
      $msg = "Your email has been activated!";
    }
    else
      $msg ="Your account is already activated!";
  }
  else
    $msg ="Please insert a valid code.";

  if($code == "Code")
  {
    $msg="Please insert the code from the e-mail!";
  }
}
?>
             <div class="msg"><?php echo $msg; ?></div>
           <p>Having trouble? <a href="resend.php">Resend Code</a>
         <span class="fontawesome-arrow-right"></span></p>
        </div>
      </div>
    </div>
  </body>
</html>
