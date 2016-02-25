<?php 
session_start();
if ($_SESSION["generalpostvariable1"] != 0) # needs to be number of posts
{
    $_SESSION["generalpostvariable1"]-= 4;
    $_SESSION["generalpostvariable2"]-= 4;
    $_SESSION["generalpostvariable3"]-= 4;
    $_SESSION["generalpostvariable4"]-= 4;
  }
header( 'Location: mainpage.php'
) ;

?>