<?php 
session_start();
if ($_SESSION["postvariable1"] != 0) # needs to be number of posts
{
    $_SESSION["postvariable1"]-= 4;
    $_SESSION["postvariable2"]-= 4;
    $_SESSION["postvariable3"]-= 4;
    $_SESSION["postvariable4"]-= 4;

    $_SESSION["a"] -= 4;
    $_SESSION["b"] -= 4;
    $_SESSION["c"] -= 4;
    $_SESSION["d"] -= 4;
  }
header( 'Location: profilepage.php'
) ;

?>