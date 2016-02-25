<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
require_once 'DBManager.php';
$db = new DBManager();
   
//call method
$db->updateUserOnline($_SESSION['email'], "0");
   
//response data is an array is the user
$response = json_decode($db->returnArray);

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("location:myHallsLog.php");
?>

</body>
</html> 