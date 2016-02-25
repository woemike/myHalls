<?php session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Account</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
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
        <form method="post" action="delete-popout.php">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span><input type="text" value="Delete" name="delete1" onBlur="if(this.value == '') this.value = 'Delete'" onFocus="if(this.value == 'Delete') this.value = ''" required></p> 

          </fieldset>
        </form>


 <?php
require_once 'DBManager.php';
$db = new DBManager(); 


$userID = $_SESSION["userID"];
  
  
if (isset($_POST['delete1']) && ($_POST['delete1'] == 'Delete'))
{
  $db->deleteUserWithUserID($userID);
  $db->deleteUserWithUserIDFromSocietyPosts($userID);
  $db->deleteUserWithUserIDFromGeneralPosts($userID);
  $db->deleteUserWithUserIDFromPosts($userID);
  $db->deleteUserWithUserIDFromSociety($userID);
  $db->deleteUserWithUserIDFromImages($userID);
  $db->deletePostWithId($userID);
  header("Location: logout.php");
}

?>
                <div class="msg"><?php echo "Type 'Delete' for completing the process!"; ?></div>
               <p>Changed your mind? <a href="mainpage.php">Go back to fun!</a>
        </div>
      </div>
    </div>
  </body>
</html>
