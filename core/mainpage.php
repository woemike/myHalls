<?php 
session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[1] . ' ' . $response[2];
$userID = $_SESSION['userID'];
$postUserID = $response[7];
$userHall = $response[6];
$userCourse = $response[5];

if (isset($_POST['createpost']))
{
  
  $description = $_POST['description'];
  

  $db->createGeneralPost($postUserID, $description, $userHall, $userCourse);
}


$db->getAllGeneralPosts($userHall, $userCourse); 
$postIDs = json_decode($db->returnArray);

$db->getDataForGeneralPostID($postIDs[$_SESSION["generalpostvariable1"]]);
$post1 = json_decode($db->returnArray);

$db->getDataForGeneralPostID($postIDs[$_SESSION["generalpostvariable2"]]);
$post2 = json_decode($db->returnArray);

$db->getDataForGeneralPostID($postIDs[$_SESSION["generalpostvariable3"]]);
$post3 = json_decode($db->returnArray);

$db->getDataForGeneralPostID($postIDs[$_SESSION["generalpostvariable4"]]);
$post4 = json_decode($db->returnArray);


$db->getAllUserSocieties($userID);
$allSocieties = json_decode($db->returnArray);

$db->getDataForSocieties($allSocieties[$_SESSION["societypostvariable1"]]);
$societyPost1 = json_decode($db->returnArray);
$db->getDataForSocieties($allSocieties[$_SESSION["societypostvariable2"]]);
$societyPost2 = json_decode($db->returnArray);
$db->getDataForSocieties($allSocieties[$_SESSION["societypostvariable3"]]);
$societyPost3 = json_decode($db->returnArray);
$db->getDataForSocieties($allSocieties[$_SESSION["societypostvariable4"]]);
$societyPost4 = json_decode($db->returnArray);

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>MyHalls</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

     <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>


<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
  
  <script type="text/javascript">
  $(document).ready(function(){
 
    // Specify the ZIP/location code and units (f or c)
    var loc = 'UKXX0092'; // or e.g. SPXX0050
    var u = 'c';
 
    var query = "SELECT item.condition FROM weather.forecast WHERE location='" + loc + "' AND u='" + u + "'";
    var cacheBuster = Math.floor((new Date().getTime()) / 1200 / 1000);
    var url = 'https://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(query) + '&format=json&_nocache=' + cacheBuster;
 
    window['wxCallback'] = function(data) {
        var info = data.query.results.channel.item.condition;
        $('#wxIcon').css({
            backgroundPosition: '-' + (61 * info.code) + 'px 0'
        }).attr({
            title: info.text
        });
        $('#wxIcon2').append('<img src="http://l.yimg.com/a/i/us/we/52/' + info.code + '.gif" width="34" height="34" title="' + info.text + '" />');
        $('#wxTemp').html(info.temp + '&deg;' + (u.toUpperCase()));
    };
 
    $.ajax({
        url: url,
        dataType: 'jsonp',
        cache: true,
        jsonpCallback: 'wxCallback'
    });
     
});
  </script>


    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
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
   $postUserImage = json_decode($db->returnArray);
   echo '<img class="profilepic" src="data:image/jpeg;base64,'.$postUserImage[1].'"/>';
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
  <div class="content-left">
  <p><b><center>Favorite Societies</center></b></p>
    <?php 
          $db->getUserImageForUserID($societyPost1[4]);
          $societyImage1 = json_decode($db->returnArray);
          if ($societyImage1 != null)
          {
          echo '<img class="societyPostImage" src="data:image/jpeg;base64,'.$societyImage1[1].'"/>';
          }
          else { echo '<center><a href="societypage.php" class="text-muted">No society events</a></center>';}
          ?>


    <div class="societyName">
      <?php echo '<a class="text-muted" href="societypage.php?soca=' .$societyPost1[4]. '">'.$societyPost1[4].'</a>';
      
      ?>
    </div>
    <br>
    <div class="societyPostUser">
      <?php $db->getUserWithUserID($societyPost1[0]);
      $societyUserName1 = json_decode($db->returnArray);
      print $societyUserName1[1]; echo " ";
      print $societyUserName1[2]; 
      ?>
  </div>
  <br>
  <div class="societyPostDescription">
    <?php 
      print $societyPost1[2];
      ?>
  </div>
  
  <hr>

  <?php 
          $db->getUserImageForUserID($societyPost2[4]);
          $societyImage2 = json_decode($db->returnArray);
          if ($societyImage2 != null)
          {
          echo '<img class="societyPostImage" src="data:image/jpeg;base64,'.$societyImage2[1].'"/>';
          }
          else { echo '<center><a href="societypage.php" class="text-muted">Create a society event yourself</a></center>';}
          ?>


    <div class="societyName">
      <?php echo '<a class="text-muted" href="societypage.php?soca=' .$societyPost2[4]. '">'.$societyPost2[4].'</a>';
      
      ?>
    </div>
    <br>
    <div class="societyPostUser">
      <?php $db->getUserWithUserID($societyPost2[0]);
      $societyUserName2 = json_decode($db->returnArray);
      print $societyUserName2[1]; echo " ";
      print $societyUserName2[2]; 
      ?>
  </div>
  <br>
  <div class="societyPostDescription">
    <?php 
      print $societyPost2[2];
      ?>
  </div>
 
  <hr>

   <?php 
          $db->getUserImageForUserID($societyPost3[4]);
          $societyImage3 = json_decode($db->returnArray);
          if ($societyImage3 != null)
          {
          echo '<img class="societyPostImage" src="data:image/jpeg;base64,'.$societyImage3[1].'"/>';
          }
          else { echo '<center><a href="societypage.php" class="text-muted">Bored? Create a society event!</a></center>';}
          ?>


    <div class="societyName">
      <?php echo '<a class="text-muted" href="societypage.php?soca=' .$societyPost3[4]. '">'.$societyPost3[4].'</a>';
      
      ?>
    </div>
    <br>
    <div class="societyPostUser">
      <?php $db->getUserWithUserID($societyPost3[0]);
      $societyUserName3 = json_decode($db->returnArray);
      print $societyUserName3[1]; echo " ";
      print $societyUserName3[2]; 
      ?>
  </div>
  <br>
  <div class="societyPostDescription">
    <?php 
      print $societyPost3[2];
      ?>
  </div>
  <hr>
   <?php 
          $db->getUserImageForUserID($societyPost4[4]);
          $societyImage4 = json_decode($db->returnArray);
          if ($societyImage4 != null)
          {
          echo '<img class="societyPostImage" src="data:image/jpeg;base64,'.$societyImage4[1].'"/>';
          }
          else { echo '<center><a href="societypage.php" class="text-muted">Find More Societies</a></center>';}
          ?>


    <div class="societyName">
      <?php echo '<a class="text-muted" href="societypage.php?soca=' .$societyPost4[4]. '">'.$societyPost4[4].'</a>';
      
      ?>
    </div>
    <br>
    <div class="societyPostUser">
      <?php $db->getUserWithUserID($societyPost4[0]);
      $societyUserName4 = json_decode($db->returnArray);
      print $societyUserName4[1]; echo " ";
      print $societyUserName4[2]; 
      ?>
  </div>
  <br>
  <div class="societyPostDescription">
    <?php 
      print $societyPost4[2];
      ?>
  </div>
  <hr>
<br>
<center>
<div class="society-button"><a href="societypage.php"><button class="load-button" type="button">More Societies</button></a></a></div>
</center>
</div>

  <div class="content-middle1">
    <?php  
      $db->getUserImageForUserID($post1[2]);      
      $postUserImage1 = json_decode($db->returnArray);
      if ($postUserImage1 != null)
      {
      echo '<img class="generalPostUserImage" src="data:image/jpeg;base64,'.$postUserImage1[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE POSTS';
      }
    ?>
    <div class="generalPostUserName">
      <?php $db->getUserWithUserID($post1[2]);
      $userName1 = json_decode($db->returnArray);
      print $userName1[1]; echo " ";
      print $userName1[2]; 
      ?>
    </div>
<br>
    <div class="generalPostUserInfo">
      <?php 
      print $userName1[6]; echo " - ";
      print $userName1[5];
      ?>
    </div>
    <br>
    <div class="generalPostContent">
      <?php 
      print $post1[1]; echo " ";
      ?>
    </div>
  </div>
  <div class="content-middle2">
    <?php  
      $db->getUserImageForUserID($post2[2]);      
      $postUserImage2 = json_decode($db->returnArray);
      if ($postUserImage2 != null)
      {
      echo '<img class="generalPostUserImage" src="data:image/jpeg;base64,'.$postUserImage2[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE POSTS';
      }
    ?>
    <div class="generalPostUserName">
      <?php $db->getUserWithUserID($post2[2]);
      $userName2 = json_decode($db->returnArray);
      print $userName2[1]; echo " ";
      print $userName2[2]; 
      ?>
    </div>
<br>
    <div class="generalPostUserInfo">
      <?php 
      print $userName2[6]; echo " - ";
      print $userName2[5];
      ?>
    </div>
    <br>
    <div class="generalPostContent">
      <?php 
      print $post2[1]; echo " ";
      ?>
    </div>
  </div>
    <div class="content-middle3">
      <?php  
      $db->getUserImageForUserID($post3[2]);      
      $postUserImage3 = json_decode($db->returnArray);
      if ($postUserImage3 != null)
      {
      echo '<img class="generalPostUserImage" src="data:image/jpeg;base64,'.$postUserImage3[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE POSTS';
      }
    ?>
    <div class="generalPostUserName">
      <?php $db->getUserWithUserID($post3[2]);
      $userName3 = json_decode($db->returnArray);
      print $userName3[1]; echo " ";
      print $userName3[2]; 
      ?>
    </div>
<br>
    <div class="generalPostUserInfo">
      <?php 
      print $userName3[6]; echo " - ";
      print $userName3[5];
      ?>
    </div>
    <br>
    <div class="generalPostContent">
      <?php 
      print $post3[1]; echo " ";
      ?>
    </div>

    </div>
      <div class="content-middle4">
        <?php  
      $db->getUserImageForUserID($post4[2]);      
      $postUserImage4 = json_decode($db->returnArray);
      if ($postUserImage4 != null)
      {
      echo '<img class="generalPostUserImage" src="data:image/jpeg;base64,'.$postUserImage4[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE POSTS';
      }
    ?>
    <div class="generalPostUserName">
      <?php $db->getUserWithUserID($post4[2]);
      $userName4 = json_decode($db->returnArray);
      print $userName4[1]; echo " ";
      print $userName4[2]; 
      ?>
    </div>
<br>
    <div class="generalPostUserInfo">
      <?php 
      print $userName4[6]; echo " - ";
      print $userName4[5];
      ?>
    </div>
    <br>
    <div class="generalPostContent">
      <?php 
      print $post4[1]; echo " ";
      ?>
    </div>
      </div>
      <div class="content-middle6">
        <center>
        <a href="loadoldgeneralposts.php"><button class="load-button" type="button">Newer Posts</button></a></a>
        <a href="createnewpost.php"><button class="load-button" type="button">New Post</button></a>
        <a href="loadnewgeneralposts.php"><button class="load-button" type="button">Older Posts</button></a></a>

      </center>  
      </div>




  

  <div id="content-topright"><div id="wxWrap">
    <span id="wxIntro">
        Manchester, UK 
    </span>
    <span id="wxIcon2"></span>
    <span id="wxTemp"></span></div></div>

  <div class="content-bottomright"><p>Nights Out</p>
    <img class="flyermain" src="images/factory.jpg" alt="factory">
    <img class="flyermain" src="images/ark.jpg" alt="factory">
    <img class="flyermain" src="images/soundcontrol.jpg" alt="factory">
    <img class="flyermain" src="images/fifth.jpg" alt="factory">
    <a href="nightsout.php"><button class="load-button" type="button">Find More</button></a>
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