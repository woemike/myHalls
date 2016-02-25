    <!DOCTYPE html>
    <!--The version of HTML I am using is HTML 5 declered with 
    <!DOCTYPE html-->
    <html>
        
        <head>
            <title>database try</title>
            <meta charset="UTF-8">
            
           <!--The code below declares the language of the website-->
           <html lang="en-UK">
              
            <h1 style="text-align:center">DBManager</h1>

<?php
   //access database
require_once 'DBManager.php';
   $db = new DBManager();

  ?>

    <!-- get all general posts -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getAllGeneralPosts("userHall", "userCourse");
   
   //response is a boolean followed by the postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

  <!-- get all society posts for society name -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getAllSocietyPostsForSociety("society name");
   
   //response is a boolean followed by the postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>


  <!-- get all night's out post id's -->

<?php
  /*///access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getAllNightsOutPostObjectIds();
   
   //response is a boolean followed by the postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

  <!-- get all night's out post id's -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getDataForNightsOutPostID("287f79b7_2015-03-10_18:14:47");
   
   //response is a boolean followed by the postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>


  <!-- create night's out post -->

<?php
  //access database
   /*require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->createNightsOutPost("user ID", "party", "description", "208847", "flyer", "www.google.com");
   
   //response is a boolean followed by the postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

<!-- read image from userID -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getUserImageForUserID("myID");
   
   //response is a boolean followed by the userID
   $response = json_decode($db->returnArray);
   print_r($response);

   echo '<img src="data:image/jpeg;base64,'.$response[1].'" height= "" width = ""/>';*/
  ?>

<!-- assign image to userID -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();

   //call method with 1: $hallName
   $db->assignImageToUserID("/Users/Alex/Desktop/5QFZvRf.png", "SHIT");
   
   //response is a boolean followed by the userID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

  <!-- update image for userID -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();

   //call method with 1: $hallName
   $db->updateImageForUserID("/Users/Alex/Desktop/house-of-card-quotes108.jpg", "56249fff_2015-03-07_18:15:41");
   
   //response is a boolean followed by the userID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>


<!-- get all userID's in hall -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getUserImageForUserID("28160e51_2015-03-07_21:45:37");
   
   //response data is a an array with all the userID's for that hall
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>


<!-- get all userID's in hall -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $hallName
   $db->getAllUserIdsFromHall("hall name");
   
   //response data is a an array with all the userID's for that hall
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

<!-- add society to userID -->

<?php
 /* //access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $userID, 2: $societyName
   $db->addSocietyToUserID("society name");
   
   //response data is a an array with [0]boolean and [1]societyName
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

<?php
  /*//access database
  require_once 'DBManager.php';
  $db = new DBManager();*/
?>

<!-- remove society from userID -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $userID, 2: $societyName
   $db->removeSocietyFromUserID("21f00bc6eeec613e8d596bef9f654d8ccebe9d0c0a3fed70b77ea16afa21", "society name");
   
   //response data is a an array with [0]boolean and [1]societyName
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

<!-- read society list from userID -->

<?php
 /* //access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $userID
   $db->readSocietyListFromUserID("21f00bc6eeec613e8d596bef9f654d8ccebe9d0c0a3fed70b77ea16afa21");
   
   //response data is a an array with all society names
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>

<!-- read society list from userID -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method with 1: $societyName
   $db->readAllUserIDsForSociety("society name");
   
   //response data is a an array with all userID's which are in that society
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>
    
<!-- create new post -->

<?php
	/*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   $db->createPost("post user id", "event name", "event description", "event date", "event time", "hall name", "number attending");
   
   //response data is a an array with [0]boolean and [1]postID
   $response = json_decode($db->returnArray);
   print_r($response);*/
  ?>


<!--delete post-->

<?php
  /*  //access database
    require_once 'DBManager.php';
    $db = new DBManager();
    
    //call method with 1: objectId
    $db->deletePostWithId(@"$postID");
    
    //response data is a bool
    //$response = json_decode($db->returnArray);
    //print_r($response);*/
    ?>


<!-- get data for post id -->

<?php
    /*	//access database
     require_once 'DBManager.php';
     $db = new DBManager();
     
     //call method
     $db->getDataForPostID("post id");
     
     //response data is an array
     $response = json_decode($db->returnArray);
     
     //do whatever you want with the response array e.g. print it
     print_r($response);*/
    ?>


<!-- get all post ids -->

    <?php
	/*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method
   $db->getAllPostObjectIdsFromHall("Opal-Gardens");
   
   //response data is an array
   $response = json_decode($db->returnArray);
   
   //do whatever you want with the response array e.g. print it
   print_r($response);*/
  ?>


<!-- OK create user -->

<?php
	/*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method
   $db->createUser("username!!", "user first name", "user last name", "email", "password", "user image path", "user course", "user hall name");
   
   //response data is an array is a boolean
   $response = json_decode($db->returnArray);
   
   //do whatever you want with the response array e.g. print it
   print_r($response);*/
  ?>


<!-- OK get user with email and password -->

<?php
	/*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method
   $db->loginWithEmailAndPassword("email", "password"); 
   
   //response data is an array is the user
   $response = json_decode($db->returnArray);
   
   //do whatever you want with the response array e.g. print it
   print_r($response);*/
  ?>


<!-- OK get user with id -->

<?php
	/*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method
   $db->getUserWithUserID("28160e51_2015-03-07_14:40:18");
   
   //response data is an array is the user
   $response = json_decode($db->returnArray);

   //do whatever you want with the response array e.g. print it
   print_r($response);*/
  ?>


<!-- update user with user id -->

<?php
  /*//access database
   require_once 'DBManager.php';
   $db = new DBManager();
   
   //call method
   $db->updateUserWithUserID(NULL, NULL, NULL, NULL, NULL, NULL, NULL, "user ID");
   
   //response data is an array is the user
   $response = json_decode($db->returnArray);
   
   //do whatever you want with the response array e.g. print it
   print_r($response);*/
  ?>

<!-- OK delete user -->

<?php
  /*  //access database
    require_once 'DBManager.php';
    $db = new DBManager();
    
    //call method
    $db->deleteUserWithUserID("userID");
    
    //response data is a boolean
    $response = json_decode($db->returnArray);*/
    ?>

        
        </body>
    </html>
