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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Society Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

     <!-- Custom CSS -->
    <style> 
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

 <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
   
</head>
<body>

<?php

if (!empty($_GET)) {
    // no data passed by get
    $soca = $_GET['soca'];
}


    
// returns an array of user societies.

//call method with 1: $userID
$db->readSocietyListFromUserID($userID);
//response data is a an array with all society names
$user_socs = json_decode($db->returnArray);

$db->readAllSocieties();
$all_socs = json_decode($db->returnArray);   
// array of all socs and user socs.
//$all_socs = array("Badminton","Tennis", "Hiking","Computing","Gaming");
//$user_socs = array("Badminton", "Tennis", "Hiking");
$diff_socs = array_diff($all_socs, $user_socs);



	
// array of members in that soc

//call method with 1: $societyName
$db->readAllUserIDsForSociety($soca);
//response data is a an array with all soc user ids.
$soc_userIDs = json_decode($db->returnArray);	
$count1 = 0;

while ($count1 < count($soc_userIDs)){
//call method
$db->getUserWithUserID($soc_userIDs[$count1]); 
//response data is an array is the user
$allUserData = json_decode($db->returnArray);
$soc_members[$count1] = $allUserData[1] . ' ' . $allUserData[2];
$count1 = $count1 + 1;
}



// get hall members array.

//call method with 1: $hallName
$db->getAllUserIdsFromHall($hall);
//response data is a an array with all the userID's for that hall
$hall_userIDs = json_decode($db->returnArray);
$count2 = 0;
while ($count2 < count($hall_userIDs)){
//call method
$db->getUserWithUserID($hall_userIDs[$count2]); 
//response data is an array is the user
$allUserData = json_decode($db->returnArray);
$hall_members[$count2] = $allUserData[1] . ' ' . $allUserData[2];
$count2 = $count2 + 1;
}
	

// array functions to filter soc members.
$same_members = array_intersect($soc_members, $hall_members); 
$diff_members = array_diff($soc_members, $hall_members);

$same_membersID = array_intersect($soc_userIDs, $hall_userIDs); 
$diff_membersID = array_diff($soc_userIDs, $hall_userIDs);
$diff_membersID_count = count($diff_membersID);

if ($soca == "") {
    $description = "We have over 350 societies, ranging from Hiking to Bhangra, Chess to Philosophy, 
    and a huge variety of religious, cultural and political groups. So from Aikido to Zoology, 
    taking in loads of academic subject, hobby, sport, and performance groups on the way, here at the Students' 
    Union there's something for everyone. But if you don't find what you're looking for you can always start your own!
    <br><br>Joining a society is a brilliant way to meet new people who share your interests and enrich your time here in Manchester. 
    It is very easy too. Come along to the Student Fair in September or join online.
    <br>All the info you need to start, run, and join a society is on these pages, so feel free to have a good look around. 
    Come and visit us in the Student Activities Centre or contact us if you have any more questions.";
} else {

    // call method with 1: $societyName
    $db->getSocietyDataForSocietyName($soca);
    // response data is a an array with [0]name and [1]description, [2] image
    $socData = json_decode($db->returnArray);

    $checkUser = 0;
} 
?>

<?php
// php function load and randomlise images.
// code obtained from stack overflow.
// need to switch Badminton with $soca
$imagesDir = "socimages/$soca/";
$images = glob($imagesDir . '*.{jpg,png,gif}', GLOB_BRACE);
$randomImage1 = $images[array_rand($images)];
$randomImage2 = $images[array_rand($images)];
while ($randomImage1 == $randomImage2){
$randomImage2 = $images[array_rand($images)];}
$randomImage3 = $images[array_rand($images)];
while ($randomImage2 == $randomImage3 or $randomImage3 == $randomImage1){
$randomImage3 = $images[array_rand($images)];}
?>

<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                            
            
            <a class="logo" href="mainpage.php"><img src="images/myHallsLogo.png" alt="myHalls logo" 
             height="30"></a>
             <div class="icons">
          <a class="icon-users" href="profilepage.php"><img src="images/usericon.png" alt="user icon"></a>
          <a class="icon-halls" href="mainpage.php"><img src="images/hallsicon.png" alt="user icon"></a>
          <a class="icon-society" href="societypage.php"><img src="images/societyicon.png" alt="user icon"></a>
          <a class="icon-nightsout" href="nightsout.php"><img src="images/nightsouticon.png" alt="user icon"></a>
            </div>
     
      <div class="user-dropdown">
      
        
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-decoration:none; color: white"
>
            <?php print $username; echo " ";?><span class="caret"></span></a>


          <ul class="dropdown-menu">
            <?php  $db->getUserImageForUserID($response[7]);
      //response is a boolean followed by the userID
   $response3 = json_decode($db->returnArray);
   echo '<img class="profilepic" src="data:image/jpeg;base64,'.$response3[1].'"/>';
     ?>
            <a class="dropdown-text" href="editprofile.php">My Profile</a><br>
            <a class="signout-text" href="logout.php">Sign Out</a>
          </ul>
        </li>

      </ul>
  </div>
    </div>
        </div>
        <!-- /.container -->
    </nav>


  <div class="content-container">
  <div class="society1"><p>
    <?php 
      if ($soca == ""){
        echo "<center><b>Societies @ UoM</b></center>";
        $db->getUserImageForUserID('SocietyDefault');
        $mainsocimage = json_decode($db->returnArray);
       echo '<center><img height="110" width="160" src="data:image/jpeg;base64,'.$mainsocimage[1].'"/></center>';
      } 

      else { 
        echo "<center><b>$soca" . " " . "Society</b></center>"; 
        $db->getUserImageForUserID($soca);
        $mainsocimage = json_decode($db->returnArray);
        echo '<center><img class="soc-main-image" src="data:image/jpeg;base64,'.$mainsocimage[1].'"/></center>';}?>

      <?php if ($soca == ""){
    } else if (array_search($soca, $user_socs) !== false) { 
        echo "<center><a href='remove_society_from_userID.php?soca=$soca&userid=$userID'<button class='load-button' type='button'>Leave</button></a></center>";
        $checkUser = 1;
    } else {       
        echo "<center><a href='insert_user_soc.php?soca=$soca&userid=$userID'<button class='load-button' type='button'>Join</button></a></center>";  
        $checkUser = 0;  
    } ?>


    </div>
  <div class="society2" style="overflow:auto">
    <p><center><b>My Societies <font color="red"><?php echo "<sup>" . count($user_socs) . "</sup>"; ?></font></center></b></p>
    <p><?php if (count($user_socs) == 0){ echo 'You have not joined any societies!'; } ?>
    <p>
    <ul>
    <?php foreach ($user_socs as $user_soc) {
        $db->getUserImageForUserID($user_soc);
        $socimage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$socimage[1].'"/>';
        echo "<li><a href='societypage.php?soca=$user_soc' id='something' class='text-muted'>". $user_soc . "</a></li>";
    } ?>
    </ul>
    <p>
    <hr>
    <p><center><b>Other Societies <font color="red"><?php echo "<sup>" . count($diff_socs) . "</sup>"; ?></font></b></center><p>
    <p>
    <ul>
    <?php foreach ($diff_socs as $other_soc)  {
        $db->getUserImageForUserID($other_soc);
        $socimage1 = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$socimage1[1].'"/>';
        echo "<li><a href='societypage.php?soca=$other_soc' id='something' class='text-muted'>". $other_soc . "</a></li>";  
    } ?><p>

  </div>

  <div class="societyphotos">
	<img class="socphotoeditor" src="<?php echo $randomImage1?>">
	<img class="socphotoeditor" src="<?php echo $randomImage2?>">
	<img class="socphotoeditor" src="<?php echo $randomImage3?>">
  </div>


    <p><?php if ($soca == "") 
             { 
               echo '<div class="society3" style="overflow:auto"><p><center><b>Description</b></center></p>';
               echo $description; 
             }
             elseif(($checkUser == 0) && ($soca != "")) 
             { 
               echo '<div class="society3" style="overflow:auto"><p><center><b>Description</b></center></p>';
               echo $socData[1]; 
             } 
             elseif(($checkUser == 1) && ($soca != ""))
             {
             echo '<div class="society3" style="overflow:auto">';

            if (array_search($soca, $user_socs) !== false) {

              $db->getAllPostsIDFromSociety($soca);
              $response101 = json_decode($db->returnArray);
              $countPostsInSoc = count($response101); 
            
            for($i = 0; $i < ($countPostsInSoc * 5); $i += 5)
            { 
              $db->getDataForSocieties($soca);
              $societyPost = json_decode($db->returnArray);

              $db->getUserImageForUserID($soca);
              $societyImagePost = json_decode($db->returnArray);
              if ($societyImagePost != null)
              {
                echo '<img class="societyPostImage" src="data:image/jpeg;base64,'.$societyImagePost[1].'"/>';
              }
              else { echo "No society events. Be the first one who creates an event!</a></center>";}
              ?>


              <div class="societyName">
               <?php echo $societyPost[$i+4];
        
               ?>
              </div>
             <br>
              <div class="societyPostUser">
               <?php $db->getUserWithUserID($societyPost[$i]);
              $societyUserName = json_decode($db->returnArray);
              print $societyUserName[1]; echo " ";
              print $societyUserName[2]; 
              ?>
             </div>
             <br>
             <div class="societyPostDescription">
             <?php 
             print $societyPost[$i+2];
              ?>
             </div>
             <hr>
             <?php
              }}
              if($societyImagePost != null)
                echo 'No more posts from this society yet. Create one yourself!';
              }
              ?></p>
  </div>


  <div class="society5">

  <center> 
    <form action="createsocietyevent.php" method="post">
    <?php
    $_SESSION['societypost'] = $soca;
    ?>
<?php   
   if(empty($_GET))
   {
     echo "<center><a href='foundsociety.php'<button class='request-society' type='button'>Found a society </button></a></center>";
   }
   elseif(!empty($_GET) && (!(array_search($soca, $user_socs) !== false)))
   {
     echo '<div class="text-not-society"> Press the join button if you are intersted in this society! Keep in mind that the first 4 that you will join, it will appear on your society feed on your homepage!
           Please bear in mind that joining societies is optional!</div>';
   }
   else
   {
    echo '<center><b>Post for '.$soca.':</b><center><textarea pattern=".{20,}" required title="20 characters minimum" 
    class="text" cols="30" rows ="5" name="description" maxlength="80"></textarea><br>
    <input type="submit" value="Create Society Event" name="createsocietyevent">';
   } ?>
 </p>  </center>

  </div>
     <?php if (!empty($_GET)) { echo '<div class="society4" style="overflow:auto"><p><center><b>Society Members<font color="red"><sup>' . count($soc_members) . '</sup></b></center></font><p><hr>';}
           else
                              {  echo '<div class="society4" style="overflow:auto"><p><b><center>Hall Friends <font color="red"><sup>' . count($hall_members) . '</sup></font></center></b></p>';}
     ?>
<?php
if ($soca == ""){
  $db->getUserWithEmail($_SESSION["email"]);
  $response = json_decode($db->returnArray);
  $hall = $response[6];
  $email = $response[3];

  $db->getAllUserNameFromHall($email, $hall);
  $response2 = json_decode($db->returnArray);

  $db->updateUserOnline($email, "1");   

  $break = '<br/>';
  $result = count($response2);

  if($result == 5)
    echo "No friends yet";
  else
    for($i = 1; $i <= $result; $i = $i + 5)
    {
      if($response2[$i-1] == $email)
        echo"";
      elseif(($response2[$i+2] == 1) && ($response2[$i-1] != $email))
      {
        $db->getUserImageForUserID($response2[$i+3]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s %s\n", $response2[$i+1], $response2[$i]);
        $db->getUserImageForUserID("ONLINEDOT");
        $UserImage = json_decode($db->returnArray);
        echo '<img class="OnlineDot" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        echo $break;
      }
      else
      { 
        $db->getUserImageForUserID($response2[$i+3]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s %s\n", $response2[$i+1], $response2[$i]);
        echo $break;
      }  
    }
?>
    <?php  } else { ?>
    <?php if ((count($same_members) == 1 and array_search($soca, $user_socs) !== false) or count($same_members) == 0){
    echo '<p><center><b>No Hall Friends Found!</b></center><p>';
    } else {
    echo '<p><center><b>Mutual Friends</b></center></p>'; } ?>
    <p><?php 
        $break = '<br/>';
        $count3 = $diff_membersID_count;
        foreach ($same_members as $same_member) {
        if ($username != $same_member) {
        $db->getUserWithUserID($same_membersID[$count3]);
        $response_online = json_decode($db->returnArray);
        if($response_online[10] == 1)
        {
        $db->getUserImageForUserID($same_membersID[$count3]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s\n", $same_member);
        $db->getUserImageForUserID("ONLINEDOT");
        $UserImage = json_decode($db->returnArray);
        echo '<img class="OnlineDot" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        echo $break;
        }
        else
        { 
        $db->getUserImageForUserID($same_membersID[$count3]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s\n", $same_member);
        echo $break;
        } 
       }
        $count3 = $count3 + 1;
       }}?></p><hr>
    <?php if (empty($_GET)){
    echo '';
    } else {
    echo '<p><center><b>Other Members</b></center></p>'; } ?>
    <p><?php 
       $break = '<br/>';
       $count4 = 0;
       foreach ($diff_members as $diff_member) {
         if ($username != $diff_member) {
        $db->getUserWithUserID($diff_membersID[$count4]);
        $response_online = json_decode($db->returnArray);
        if($response_online[10] == 1)
        {
        $db->getUserImageForUserID($diff_membersID[$count4]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s\n", $diff_member);
        $db->getUserImageForUserID("ONLINEDOT");
        $UserImage = json_decode($db->returnArray);
        echo '<img class="OnlineDot" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        echo $break;
        }
        else
        { 
        $db->getUserImageForUserID($diff_membersID[$count4]);
        $UserImage = json_decode($db->returnArray);
        echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
        printf ("%s\n", $diff_member);
        echo $break;
        } 
       }
        $count4 = $count4 + 1;
      }?></p>

  </div>


  </div>
</div>
<footer class="footer">
      <div class="containerfooter">
        <center>
        <p class="text-muted">Copyright © 2015 myHalls. All rights reserved. <a href="contactus.php" class="text-muted">Contact Us</a></p></center>
      </div>
    </footer>
</body>
</html>
