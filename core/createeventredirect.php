<?php 
session_start();
if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);

if (isset($_POST['create']))
{
  $postUserID = $response[7];
  $eventName = $_POST['name'];
  $eventDescription = $_POST['description'];
  $eventDate = $_POST['date'];
  $eventTime = $_POST['time'];
  $userHall = $response[6];

  $db->createPost($postUserID, $eventName, $eventDescription, $eventDate, $eventTime, $userHall);
}
header( 'Location: profilepage.php'
) ;

?>