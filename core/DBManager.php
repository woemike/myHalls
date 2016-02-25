<?php
    
    class DBManager {
        
        private $db;
        private $tableNameFromHall_Posts;
        private $tableNameFromHall_Users;
        private $tableNameFromHall_SocietyRelations;
        private $tableNameFromHall_Societies;
        private $tableNameFromHall_Images;
        private $tableNameFromHall_NightsOut;
        private $tableNameFromHall_SocietyPosts;
        private $tableNameFromHall_GeneralPosts;
        private $tableNameFromHall_Tutors;
        private $tableNameFromHall_Attend;

        //*initialise database
        
        // Constructor - open DB connection
        function __construct() {
            
            //hide php errors
            error_reporting(0);
            
            $servername = "dbhost.cs.man.ac.uk";
            $username = "mbax4ar4";
            $password = "123456789T";
            $dbname = "2014_comp10120_z8";
            
            $this->tableNameFromHall_Posts = "Table_Posts";
            $this->tableNameFromHall_Users = "Table_Users";
            $this->tableNameFromHall_SocietyRelations = "Table_SocietyRelations";
            $this->tableNameFromHall_Societies = "Table_Societies";
            $this->tableNameFromHall_Images = "Table_Images";
            $this->tableNameFromHall_NightsOut = "Table_NightsOut";
            $this->tableNameFromHall_SocietyPosts = "Table_SocietyPosts";
            $this->tableNameFromHall_GeneralPosts = "Table_GeneralPosts";
            $this->tableNameFromHall_Tutors = "Table_Tutors";
	        $this->tableNameFromHall_Attend = "Table_Attend";


            $this->db = new mysqli($servername, $username, $password, $dbname);
            $this->db->autocommit(TRUE);
            
            $this->createTables();
            
        }
        
        // Destructor - close DB connection
        function __destruct() {
            $this->db->close();
        }
        
        //*initialise database
        function getDataForSocieties($societyName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_SocietyPosts WHERE societyName = '$societyName' ORDER BY $this->tableNameFromHall_SocietyPosts.`dateModified` DESC");
            $dbVar->execute();
            
            $dbVar->bind_result($userID, $postID, $postDescription, $dateModified, $societyName);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userID, $postID, $postDescription, $dateModified, $societyName);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllUserSocieties($userID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT societyName FROM $this->tableNameFromHall_SocietyRelations WHERE userID = '$userID'");
            $dbVar->execute();
            
            $dbVar->bind_result($societyName);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $societyName);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function createSocietyPost($userID, $postDescription, $societyName) {
                
                //define return array
                $returnArray = array();
                
                //define the random objectId
                $randomString = bin2hex(openssl_random_pseudo_bytes(4));
                $date = new DateTime();
                $randomString .= date_format($date, '_Y-m-d_H:i:s');
                
                //get the current date
                $now = new DateTime();
                $currentDate = $now->format('Y-m-d H:i:s');
                
                //define database method
                $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_SocietyPosts (userID, postID, postDescription, dateModified, societyName) VALUES ('$userID', '$randomString', '$postDescription', '$currentDate', '$societyName')");
                
                if($dbVar->execute()){
                    $success = true;
                    array_push($returnArray, $success, $randomString);
                    //print 'Post published successfully for post ID : ' .$postID .'<br />';
                }else{
                    $success = false;
                    array_push($returnArray, $success);
                    //die('Error creating post : ('. $dbVar->errno .') '. $dbVar->error);
                }
                
                //return array to initial call controller
                $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        //*general posts

        function createGeneralPost($postUserID, $description, $userHall, $userCourse) {
                
                //define return array
                $returnArray = array();
                
                //define the random objectId
                $randomString = bin2hex(openssl_random_pseudo_bytes(4));
                $date = new DateTime();
                $randomString .= date_format($date, '_Y-m-d_H:i:s');
                
                //get the current date
                $now = new DateTime();
                $currentDate = $now->format('Y-m-d H:i:s');
                
                //define database method
                $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_GeneralPosts (postID, postDescription, userID, userHall, userCourse, dateModified) VALUES ('$randomString', '$description', '$postUserID', '$userHall', '$userCourse', '$currentDate')");
                
                if($dbVar->execute()){
                    $success = true;
                    array_push($returnArray, $success, $randomString);
                    //print 'Post published successfully for post ID : ' .$postID .'<br />';
                }else{
                    $success = false;
                    array_push($returnArray, $success);
                    //die('Error creating post : ('. $dbVar->errno .') '. $dbVar->error);
                }
                
                //return array to initial call controller
                $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getDataForGeneralPostID($postID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_GeneralPosts WHERE postID = '$postID'");
            $dbVar->execute();
            
            $dbVar->bind_result($postID, $description, $userID, $userHall, $userCourse, $dateModified);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID, $description, $userID, $userHall, $userCourse, $dateModified);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllGeneralPosts($userHall, $userCourse) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT postID FROM $this->tableNameFromHall_GeneralPosts WHERE userHall = '$userHall' OR userCourse = '$userCourse' ORDER BY $this->tableNameFromHall_GeneralPosts.`dateModified` DESC");
            $dbVar->execute();
            
            $dbVar->bind_result($postID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
      

        function getAllPostsID() {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT postID FROM $this->tableNameFromHall_Posts");
            $dbVar->execute();
            
            $dbVar->bind_result($postID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllPostsIDFromSociety($societyName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT postID FROM $this->tableNameFromHall_SocietyPosts WHERE societyName = '$societyName'");
            $dbVar->execute();
            
            $dbVar->bind_result($postID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }


        function getAllPostsAttendNumber() {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT numberAttending FROM $this->tableNameFromHall_Posts");
            $dbVar->execute();
            
            $dbVar->bind_result($numberAttending);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $numberAttending);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function attendEvent($postID, $userID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Attend WHERE postID = '$postID' AND userID = '$userID'");
            $dbVar->execute();
            
            $dbVar->bind_result($postID, $userID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID, $userID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function updateNumberAttendingFromPosts($numberAttending, $postID) {
            //define query
            $query = "UPDATE $this->tableNameFromHall_Posts SET ";

            //initial value set
            $boolInitialValueSet = false;

        if ($boolInitialValueSet)
              $query .= ", numberAttending = '$numberAttending'";
            else
              $query .= "numberAttending = '$numberAttending'";

            $boolInitialValueSet = true;

            //end query
            $query .= " WHERE postID = '$postID'";

            //define database method
            $dbVar = $this->db->prepare($query);
            
            //define return array
            $returnArray = array();
            
            //update user
            if($dbVar->execute()){
                array_push($returnArray, true, $numberAttending, $postID);
                //print 'User has been updated with Id : ' .$userID .'<br />';
            }else{
                array_push($returnArray, false);
                //die('Error updating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        function addEventToAttend($postID, $userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_Attend (postID, userID) VALUES ('$postID', '$userID')");
            
            if($dbVar->execute()){
                array_push($returnArray, true, "works");
                //print 'A new user has been created successfully : ' .$userName . " ID: " . $randomString .'<br />';
            }else{
                array_push($returnArray, false, "nop");
                //die('Error creating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }

        function deleteEventToAttend($postID, $userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Attend WHERE postID = '$postID' AND userID = '$userID'");
            
            if($dbVar->execute()){
                array_push($returnArray, true, "works");
                //print 'A new user has been created successfully : ' .$userName . " ID: " . $randomString .'<br />';
            }else{
                array_push($returnArray, false, "nop");
                //die('Error creating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }

        //*general posts


        //*society posts

        function getAllSocietyPostsForSociety($societyName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_SocietyPosts WHERE societyName = '$societyName'");
            $dbVar->execute();
            
            $dbVar->bind_result($postID, $postDescription, $dateModified, $societyName);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postID, $postDescription, $dateModified, $societyName);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        //*society posts



        //*nights out post

        function createNightsOutPost($postUserID, $nightName, $nightDescription, $nightPostcode, $nightFlyer, $websiteURL) {
                
                //define return array
                $returnArray = array();
                
                //define the random objectId
                $randomString = bin2hex(openssl_random_pseudo_bytes(4));
                $date = new DateTime();
                $randomString .= date_format($date, '_Y-m-d_H:i:s');
                
                //get the current date
                $now = new DateTime();
                $currentDate = $now->format('Y-m-d H:i:s');
                
                //define database method
                $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_NightsOut (postUserID, nightName, nightDescription, nightPostcode, nightFlyer, websiteURL, postID) VALUES ('$postUserID', '$nightName', '$nightDescription', '$nightPostcode', '$nightFlyer', '$websiteURL', '$randomString')");
                
                if($dbVar->execute()){
                    array_push($returnArray, true, $randomString);
                }else{
                    array_push($returnArray, false);
                }
                
                //return array to initial call controller
                $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllNightsOutPostObjectIds() {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT postID FROM $this->tableNameFromHall_NightsOut");
            $dbVar->execute();
            $dbVar->bind_result($objectId);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $objectId);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function getDataForNightsOutPostID($postID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_NightsOut WHERE postID = '$postID'");
            $dbVar->execute();
            
            $dbVar->bind_result($postUserID, $nightName, $nightDescription, $nightPostcode, $nightFlyer, $websiteURL, $postID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postUserID, $nightName, $nightDescription, $nightPostcode, $nightFlyer, $websiteURL, $postID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        //*nights out post


        //*post methods
        
        function createPost($postUserID, $eventName, $eventDescription, $eventDate, $eventTime, $hallName, $numberAttending) {
                
                //define return array
                $returnArray = array();
                
                //define the random objectId
                $randomString = bin2hex(openssl_random_pseudo_bytes(4));
                $date = new DateTime();
                $randomString .= date_format($date, '_Y-m-d_H:i:s');
                
                //get the current date
                $now = new DateTime();
                $currentDate = $now->format('Y-m-d H:i:s');
                
                //define database method
                $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_Posts (postUserID, eventName, eventDescription, eventDate, eventTime, postID, dateModified, userHall, numberAttending) VALUES ('$postUserID', '$eventName', '$eventDescription', '$eventDate', '$eventTime', '$randomString', '$currentDate', '$hallName', '$numberAttending')");
                
                if($dbVar->execute()){
                    $success = true;
                    array_push($returnArray, $success, $randomString);
                    //print 'Post published successfully for post ID : ' .$postID .'<br />';
                }else{
                    $success = false;
                    array_push($returnArray, $success);
                    //die('Error creating post : ('. $dbVar->errno .') '. $dbVar->error);
                }
                
                //return array to initial call controller
                $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        
        function getAllPostObjectIdsFromHall($hallName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT postID FROM $this->tableNameFromHall_Posts WHERE userHall = '$hallName' ORDER BY $this->tableNameFromHall_Posts.`dateModified` ASC");
            $dbVar->execute();
            $dbVar->bind_result($objectId);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $objectId);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function deletePostWithId($postID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Posts WHERE postID = '$postID'");
            
            if($dbVar->execute()){
                $success = true;
                //feed array
                array_push($returnArray, $success);
                //print 'Object deleted successfully : ' .$dbVar->insert_id .'<br />';
            }else{
                $success = false;
                //feed array
                array_push($returnArray, $success);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function getDataForPostID($postID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Posts WHERE postID = '$postID'");
            $dbVar->execute();
            
            $dbVar->bind_result($postUserID, $eventName, $eventDescription, $eventDate, $eventTime, $postID, $dateModified, $hallName, $numberAttending);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $postUserID, $eventName, $eventDescription, $eventDate, $eventTime, $postID, $dateModified, $hallName, $numberAttending);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        
        /*function deleteDataForPostID($postID) {
         
         //define return array
         $returnArray = array();
         
         //define database method
         $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Posts WHERE postID = '$postID'");
         
         if($dbVar->execute()){
         $success = true;
         //feed array
         array_push($returnArray, $success);
         //print 'Object deleted successfully : ' .$dbVar->insert_id .'<br />';
         }else{
         $success = false;
         //feed array
         array_push($returnArray, $success);
         //die('Error : ('. $dbVar->errno .') '. $dbVar->error);
         }
         
         //return array to initial call controller
         $this->returnArray = json_encode($returnArray);
         
         $dbVar->close();
         }*/
        
        
        //*post methods
        
        
        
        
        //*user methods
        
        //not creating user using this method (which is not updated for email verification)
        /*function createUser($userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userImagePath, $userCourse, $userHall) {
            
            if (is_null($userName) || is_null($userPassword) || is_null($userEmail) || is_null($userHall)){
                //print 'Missing parameters for user!!';
                //error
            }else{
                
                //define return array
                $returnArray = array();
                
                //define the random objectId
                $randomString = bin2hex(openssl_random_pseudo_bytes(4));
                $date = new DateTime();
                $randomString .= date_format($date, '_Y-m-d_H:i:s');
                
                //define database method
                $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_Users (userName, userFirstName, userLastName, userEmail, userPassword, userImage, userCourse, userHall, userID) VALUES ('$userName', '$userFirstName', '$userLastName', '$userEmail', '$userPassword', LOAD_FILE('$userImagePath'), '$userCourse', '$userHall', '$randomString')");
                
                if($dbVar->execute()){
                    $success = true;
                    array_push($returnArray, $success, $randomString);
                    //print 'A new user has been created successfully : ' .$userName . " ID: " . $randomString .'<br />';
                }else{
                    $success = false;
                    array_push($returnArray, $success);
                    //die('Error creating user : ('. $dbVar->errno .') '. $dbVar->error);
                }
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }*/

        function getUserImageForUserID($userID) {
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userImage FROM $this->tableNameFromHall_Images WHERE userID = '$userID' LIMIT 1");
            $dbVar->execute();
            $dbVar->bind_result($userImage);
            
            while ($dbVar->fetch()) {
                //echo '<img src="data:image/jpeg;base64,'.base64_encode( $userImage ).'" height= "30" width = "30"/>';
                //feed array
                array_push($returnArray, true, base64_encode( $userImage ));
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function assignImageToUserID($userImagePath, $userID) {
            //get image
            $userImage = addslashes(file_get_contents($userImagePath));

            //define return array
            $returnArray = array();

            //define database method
            $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_Images (userID, userImage) VALUES ('$userID', '$userImage')");
            
            //update user
            if($dbVar->execute()){
                array_push($returnArray, true, $userID);
                //print 'User has been updated with Id : ' .$userID .'<br />';
            }else{
                array_push($returnArray, false);
                //die('Error updating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function updateImageForUserID($userImagePath, $userID) {
            //get image
            $userImage = addslashes(file_get_contents($userImagePath));

            //define return array
            $returnArray = array();

            //define database method
            $dbVar = $this->db->prepare("UPDATE $this->tableNameFromHall_Images SET userImage = '$userImage' WHERE userID = '$userID'");
            
            //update user
            if($dbVar->execute()){
                array_push($returnArray, true, $userID);
            }else{
                array_push($returnArray, false);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function updateUserWithUserID($userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID) {
            //define query
            $query = "UPDATE $this->tableNameFromHall_Users SET ";

            //initial value set
            $boolInitialValueSet = false;

            if ($userName != NULL) {
            	$query .= "userName = '$userName'";
            	$boolInitialValueSet = true;
            }

			if ($userFirstName != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userFirstName = '$userFirstName'";
            	else
            		$query .= "userFirstName = '$userFirstName'";

            	$boolInitialValueSet = true;
            }

			if ($userLastName != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userLastName = '$userLastName'";
            	else
            		$query .= "userLastName = '$userLastName'";

            	$boolInitialValueSet = true;
            }

            if ($userEmail != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userEmail = '$userEmail'";
            	else
            		$query .= "userEmail = '$userEmail'";

            	$boolInitialValueSet = true;
            }

            if ($userPassword != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userPassword = '$userPassword'";
            	else
            		$query .= "userPassword = '$userPassword'";

            	$boolInitialValueSet = true;
            }

            if ($userCourse != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userCourse = '$userCourse'";
            	else
            		$query .= "userCourse = '$userCourse'";

            	$boolInitialValueSet = true;
            }

            if ($userHall != NULL) {

				if ($boolInitialValueSet)
            		$query .= ", userHall = '$userHall'";
            	else
            		$query .= "userHall = '$userHall'";

            	$boolInitialValueSet = true;
            }

           	//end query
            $query .= " WHERE userID = '$userID'";

            //define database method
            $dbVar = $this->db->prepare($query);
            
            //define return array
            $returnArray = array();
            
            //update user
            if($dbVar->execute()){
                array_push($returnArray, true, $userID);
                //print 'User has been updated with Id : ' .$userID .'<br />';
            }else{
                array_push($returnArray, false);
                //die('Error updating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function updateUserOnline($userEmail, $userOnline) {
            //define query
            $query = "UPDATE $this->tableNameFromHall_Users SET ";

            //initial value set
            $boolInitialValueSet = false;

            if ($userOnline != NULL) 
            {
        if ($boolInitialValueSet)
              $query .= ", userOnline = '$userOnline'";
            else
              $query .= "userOnline = '$userOnline'";

            $boolInitialValueSet = true;
            }


            //end query
            $query .= " WHERE userEmail = '$userEmail'";

            //define database method
            $dbVar = $this->db->prepare($query);
            
            //define return array
            $returnArray = array();
            
            //update user
            if($dbVar->execute()){
                array_push($returnArray, true, $userEmail);
                //print 'User has been updated with Id : ' .$userID .'<br />';
            }else{
                array_push($returnArray, false);
                //die('Error updating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function getUserWithUserID($userID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Users WHERE userID = '$userID' LIMIT 1");
            $dbVar->execute();
            
            $dbVar->bind_result($userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }


        function getUserWithEmail($userEmail) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Users WHERE userEmail = '$userEmail' LIMIT 1");
            $dbVar->execute();
            
            $dbVar->bind_result($userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        
        function loginWithEmailAndPassword($userEmail, $userPassword) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Users WHERE userEmail = '$userEmail' AND userPassword = '$userPassword' LIMIT 1");
            $dbVar->execute();
            
            $dbVar->bind_result($userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userName, $userFirstName, $userLastName, $userEmail, $userPassword, $userCourse, $userHall, $userID, $emailVerif, $activationCode, $userOnline, $userTutor);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        
        function deleteUserWithUserID($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Users WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function deleteUserWithUserIDFromSociety($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_SocietyRelations WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function deleteUserWithUserIDFromPosts($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Attend WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function deleteUserWithUserIDFromGeneralPosts($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_GeneralPosts WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function deleteUserWithUserIDFromSocietyPosts($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_SocietyPosts WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function deleteUserWithUserIDFromImages($userID) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_Images WHERE userID = '$userID'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $userID);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $userID);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }



        function getAllUserIdsFromHall($hallName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userID FROM $this->tableNameFromHall_Users WHERE userHall = '$hallName'");
            $dbVar->execute();
            $dbVar->bind_result($userID);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllUserNameFromHall($userEmail, $hallName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userEmail, userFirstName, userLastName, userOnline, userID FROM $this->tableNameFromHall_Users WHERE userHall = '$hallName'");
            $dbVar->execute();
            $dbVar->bind_result($userEmail, $userFirstName, $userLastName, $userOnline, $userID);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userEmail, $userFirstName, $userLastName, $userOnline, $userID);
            }

            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }

        function getAllUserNameFromTutors($userName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userName, userEmail FROM $this->tableNameFromHall_Tutors WHERE userName = '$userName'");
            $dbVar->execute();
            $dbVar->bind_result($userName, $userEmail);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userName, $userEmail);
            }

            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }


        function getAllUserNameFromCourse($userEmail, $userCourse) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userEmail, userFirstName, userLastName, userOnline, userID FROM $this->tableNameFromHall_Users WHERE userCourse = '$userCourse'");
            $dbVar->execute();
            $dbVar->bind_result($userEmail, $userFirstName, $userLastName, $userOnline, $userID);
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userEmail, $userFirstName, $userLastName, $userOnline, $userID);
            }

            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        
        //*user methods
        
        
        
        //*society methods
        
        function addSocietyToUserID($userID, $societyName) {
            
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("INSERT INTO $this->tableNameFromHall_SocietyRelations (userID, societyName) VALUES ('$userID', '$societyName')");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $societyName);
                //print 'A new user has been created successfully : ' .$userName . " ID: " . $randomString .'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $societyName);
                //die('Error creating user : ('. $dbVar->errno .') '. $dbVar->error);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }
        
        function removeSocietyFromUserID($userID, $societyName) {
            //define return array
            $returnArray = array();
            
            //define database method
            $dbVar = $this->db->prepare("DELETE FROM $this->tableNameFromHall_SocietyRelations WHERE userID = '$userID' AND societyName = '$societyName'");
            
            if($dbVar->execute()){
                $success = true;
                array_push($returnArray, $success, $societyName);
                //print 'User deleted successfully : ' .$userID.'<br />';
            }else{
                $success = false;
                array_push($returnArray, $success, $societyName);
                //die('Error : ('. $dbVar->errno .') '. $dbVar->error. '<br />');
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        function readSocietyListFromUserID($userID) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT societyName FROM $this->tableNameFromHall_SocietyRelations WHERE userID = '$userID'");
            $dbVar->execute();
            
            $dbVar->bind_result($societyName);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $societyName);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }

        function readAllSocieties() {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT societyName FROM $this->tableNameFromHall_Societies");
            $dbVar->execute();
            
            $dbVar->bind_result($societyName);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $societyName);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }


        function readAllUserIDsForSociety($societyName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT userID FROM $this->tableNameFromHall_SocietyRelations WHERE societyName = '$societyName'");
            $dbVar->execute();
            
            $dbVar->bind_result($userID);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $userID);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            //close connection
            $dbVar->close();
        }

        function getSocietyDataForSocietyName($societyName) {
            
            //define return array
            $returnArray = array();
            
            //search database
            $dbVar = $this->db->prepare("SELECT * FROM $this->tableNameFromHall_Societies WHERE societyName = '$societyName' LIMIT 1");
            $dbVar->execute();
            
            $dbVar->bind_result($societyName, $societyDescription, $societyImage);
            
            while ($dbVar->fetch()) {
                //feed array
                array_push($returnArray, $societyName, $societyDescription, $societyImage);
            }
            
            //return array to initial call controller
            $this->returnArray = json_encode($returnArray);
            
            $dbVar->close();
        }
        
        //*society methods
        
        
        //*general methods

        function createTables() {
            
            $dbVar = $this->db;
            
            //create post table
            $sql_Posts = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_Posts
            (postUserID TEXT, eventName TEXT, eventDescription TEXT, eventDate TEXT, eventTime TEXT,
             postID VARCHAR(60) NOT NULL PRIMARY KEY,
             dateModified TIMESTAMP, userHall TEXT, numberAttending INT)";
            
            if ($dbVar->query($sql_Posts)) {
                //echo "Table $this->tableNameFromHall_Posts created successfully" . '<br />';
            } else {
                //echo "Error creating table posts." . mysqli_error($this->db . '<br />');
            }
            
            
            //create society relations table
            $sql_SocietyRelations = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_SocietyRelations
            (userID TEXT NOT NULL, societyName TEXT NOT NULL)";
            
            if ($dbVar->query($sql_SocietyRelations)) {
               
            } else {
               
            }
            
            
            //create user table
            $sql_Users = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_Users (userName TEXT,
            userFirstName TEXT, userLastName TEXT,
            userEmail VARCHAR(100), userPassword VARCHAR(100), userCourse TEXT,
            userHall TEXT, userID VARCHAR(60) NOT NULL PRIMARY KEY, emailVerif enum('0','1') DEFAULT '0',
            activationCode varchar(60) NOT NULL, userOnline enum('0','1') DEFAULT '0')";
            
            if ($dbVar->query($sql_Users)) {
                
            } else {
            
            }


            //create tutor table
            $sql_Users = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_Tutors (userName TEXT,
            userEmail VARCHAR(100), userID INT(11) NOT NULL )";
            
            if ($dbVar->query($sql_Users)) {
                
            } else {
            
            }


            //create society table
            $sql_Societies = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_Societies
            (societyName VARCHAR(100) NOT NULL PRIMARY KEY,
             societyDescription TEXT, numberOfMembers INT)";
            
            if ($dbVar->query($sql_Societies)) {
              
            } else {
              
            }


            //create images table
            $sql_Images = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_Images
            (userID VARCHAR(100) NOT NULL PRIMARY KEY, userImage MEDIUMBLOB)";
            
            if ($dbVar->query($sql_Images)) {
                
            } else {
               
            }  


            //create night's out table
            $sql_NightsOut = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_NightsOut
            (postUserID TEXT, nightName VARCHAR(100) NOT NULL,
             nightDescription TEXT, nightPostcode TEXT, nightFlyer TEXT, websiteURL VARCHAR(100), postID VARCHAR(60) NOT NULL PRIMARY KEY)";

            if ($dbVar->query($sql_NightsOut)) {
                
            } else {
              
            }


            //create society posts table
            $sql_SocietyPosts = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_SocietyPosts
            (userID TEXT, postID VARCHAR(60) NOT NULL PRIMARY KEY, postDescription TEXT, dateModified TEXT, societyName TEXT)";

            if ($dbVar->query($sql_SocietyPosts)) {
                
            } else {
             
            }


            //create general posts table
            $sql_GeneralPosts = "CREATE TABLE IF NOT EXISTS $this->tableNameFromHall_GeneralPosts
            (postID VARCHAR(60) NOT NULL PRIMARY KEY, postDescription TEXT, userID TEXT, userHall TEXT, userCourse TEXT, dateModified TEXT)";

            if ($dbVar->query($sql_GeneralPosts)) {
              
            } else {
              
            }
            
        }
        
        //*general methods
        
    }
    
    ?>