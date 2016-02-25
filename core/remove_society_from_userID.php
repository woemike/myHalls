<!-- remove society from userID -->
<?php
   $userID = $_GET['userid'];
   $soca = $_GET['soca'];
   //access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $userID, 2: $societyName
   $db->removeSocietyFromUserID($userID, $soca);
   
   //response data is a an array with [0]boolean and [1]societyName
   //$response = json_decode($db->returnArray);
   // print_r($response);
   header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
