<?php session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[1] . ' ' . $response[2];
$userID = $response[7];
$hall = $response[6];
if (isset($_POST['createsocietyevent']))
{
  
  $postDescription = $_POST['description'];
  $societyName = $_SESSION['societypost'];

  $db->createSocietyPost($userID, $postDescription, $societyName);
}
header( 'Location: mainpage.php'
) ;
?>