<?php session_start();
  if (isset($_SESSION["email"]))
    header ("Location: mainpage.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login myHalls</title>

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

        <form method="post" action="myHallsLog.php">

          <fieldset class="clearfix">

            <p><span class="fontawesome-envelope"></span><input type="text" value="Email" name="email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" required></p> 
            <p><span class="fontawesome-lock"></span><input type="password"  value="Password" name="password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>            
            <p><input type="submit" value="Sign In" name="login"></p>

          </fieldset>
        </form>


 <?php
require_once 'DBManager.php';
$db = new DBManager(); 

if(isset($_POST['login']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = md5($password);
  $db->loginWithEmailAndPassword($email, $password);
  $response = json_decode($db->returnArray);
  if((!is_null($response[3])) && ($response[8] == 1))
  {
    header("Location: mainpage.php"); 
    $_SESSION['email'] = $email;
    $_SESSION['userID'] = $response[7];
    $_SESSION["postvariable1"] = 0;
    $_SESSION["postvariable2"] = 1;
    $_SESSION["postvariable3"] = 2;
    $_SESSION["postvariable4"] = 3;
    $_SESSION["generalpostvariable1"] = 0;
    $_SESSION["generalpostvariable2"] = 1;
    $_SESSION["generalpostvariable3"] = 2;
    $_SESSION["generalpostvariable4"] = 3;
    $_SESSION["societypostvariable1"] = 0;
    $_SESSION["societypostvariable2"] = 1;
    $_SESSION["societypostvariable3"] = 2;
    $_SESSION["societypostvariable4"] = 3;
    $_SESSION["a"] = 1;
    $_SESSION["b"] = 2;
    $_SESSION["c"] = 3;
    $_SESSION["d"] = 4;
    
  }
  elseif($response[3] != $email || $response[4] != $password)
  {
    $msg="Invalid email or password!";
  }
  elseif($response[8] == 0)
  {
    header("Location: activation.php");
  }
}


?>
             <div class="msg"><?php echo $msg; ?></div>
           <p>Forgot your password? <a href="recoverpassword.php">Recover!</a>
           <p>Not a member? <a href="myHallsreg.php">Sign up now</a>
         <span class="fontawesome-arrow-right"></span></p>
        </div>
      </div>
    </div>
  </body>
</html>
