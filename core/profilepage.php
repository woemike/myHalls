  <?php session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[1] . ' ' . $response[2];
$_SESSION['userID'] = $response[7];
$userID = $_SESSION["userID"];
$email = $_SESSION["email"];


$db->getAllPostObjectIdsFromHall($response[6]);
$postIDs = json_decode($db->returnArray);

$db->getDataForPostID($postIDs[$_SESSION["postvariable1"]]);
$post1 = json_decode($db->returnArray);

$db->getDataForPostID($postIDs[$_SESSION["postvariable2"]]);
$post2 = json_decode($db->returnArray);

$db->getDataForPostID($postIDs[$_SESSION["postvariable3"]]);
$post3 = json_decode($db->returnArray);

$db->getDataForPostID($postIDs[$_SESSION["postvariable4"]]);
$post4 = json_decode($db->returnArray);

$a = $_SESSION["a"];
$b = $_SESSION["b"];
$c = $_SESSION["c"];
$d = $_SESSION["d"];

// variables for increment.

?>


    <?php function clean_input($data) 
          {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }?>
          


    <?php if(isset($_POST['save']))
        {
          $firstName = clean_input($_POST['firstName']);
          $lastName = clean_input($_POST['lastName']);
          $halls = $_POST['halls'];
          $course = $_POST['course'];


          $profanity = array("4r5e", "5h1t", "5hit","a55","anal","anus","ar5e","arrse","arse","ass","ass-fucker","asses","assfucker","assfukka","asshole",
                              "assholes","asswhole","a_s_s","b!tch","b00bs","b17ch","b1tch","ballbag","balls","ballsack","bastard","beastial","beastiality","bellend",
                              "bestial","bestiality","bi+ch","biatch","bitch","bitcher","bitchers","bitches","bitchin","bitching","bloody","blow job","blowjob",
                              "blowjobs","boiolas","bollock","bollok","boner","boob","boobs","booobs","boooobs","booooobs","booooooobs","breasts","buceta","bugger",
                              "bum","bunny fucker","butt","butthole","buttmuch","buttplug","c0ck","c0cksucker","carpet muncher","cawk","chink","cipa","cl1t","clit",
                              "clitoris","clits","cnut","cock","cock-sucker","cockface","cockhead","cockmunch","cockmuncher","cocks","cocksuck","cocksucked",
                              "cocksucker","cocksucking","cocksucks","cocksuka","cocksukka","cok","cokmuncher","coksucka","coon","cox","crap","cum","cummer","cumming",
                              "cums","cumshot","cunilingus","cunillingus","cunnilingus","cunt","cuntlick","cuntlicker","cuntlicking","cunts","cyalis","cyberfuc",
                              "cyberfuck","cyberfucked","cyberfucker","cyberfuckers","cyberfucking","d1ck","damn","dick","dickhead","dildo","dildos","dink","dinks",
                              "dirsa","dlck","dog-fucker","doggin","dogging","donkeyribber","doosh","duche","dyke","ejaculate","ejaculated","ejaculates","ejaculating",
                              "ejaculatings","ejaculation","ejakulate","fuck","fucker","f4nny","fag","fagging","faggitt","faggot","faggs","fagot","fagots",
                              "fags","fanny","fannyflaps","fannyfucker","fanyy","fatass","fcuk","fcuker","fcuking","feck","fecker","felching","fellate","fellatio",
                              "fingerfuck","fingerfucked","fingerfucker","fingerfuckers","fingerfucking","fingerfucks","fistfuck","fistfucked","fistfucker","fistfuckers",
                              "fistfucking","fistfuckings","fistfucks","flange","fook","fooker","fuck","fucka","fucked","fucker","fuckers","fuckhead","fuckheads",
                              "fuckin","fucking","fuckings","fuckingshitmotherfucker","fuckme ","fucks","fuckwhit","fuckwit","fudge packer","fudgepacker","fuk",
                              "fuker","fukker","fukkin","fuks","fukwhit","fukwit","fux","fux0r","f_u_c_k","gangbang","gangbanged","gangbangs","gaylord","gaysex",
                              "goatse","God","god-dam","god-damned","goddamn","goddamned","hardcoresex","hell","heshe","hoar","hoare","hoer","homo","hore","horniest",
                              "horny","hotsex","jack-off","jackoff","jap","jerk-off","jism","jiz","jizm","jizz","kawk","knob","knobead","knobed","knobend","knobhead",
                              "knobjocky","knobjokey","kock","kondum","kondums","kum","kummer","kumming","kums","kunilingus","l3i+ch","l3itch","labia","lmfao","lust",
                              "lusting","m0f0","m0fo","m45terbate","ma5terb8","ma5terbate","masochist","master-bate","masterb8","masterbat*","masterbat3","masterbate",
                              "masterbation","masterbations","masturbate","mo-fo","mof0","mofo","mothafuck","mothafucka","mothafuckas","mothafuckaz","mothafucked",
                              "mothafucker","mothafuckers","mothafuckin","mothafucking","mothafuckings","mothafucks","mother fucker","motherfuck","motherfucked",
                              "motherfucker","motherfuckers","motherfuckin","motherfucking","motherfuckings","motherfuckka","motherfucks","muff","mutha","muthafecker",
                              "muthafuckker","muther","mutherfucker","n1gga","n1gger","nazi","nigg3r","nigg4h","nigga","niggah","niggas","niggaz","nigger","niggers",
                              "nob","nob jokey","nobhead","nobjocky","nobjokey","numbnuts","nutsack","orgasim","orgasims","orgasm","orgasms","p0rn","pawn","pecker",
                              "penis","penisfucker","phonesex","phuck","phuk","phuked","phuking","phukked","phukking","phuks","phuq","pigfucker","pimpis","piss",
                              "pissed","pisser","pissers","pisses","pissflaps","pissin","pissing","pissoff","poop","porn","porno","pornography","pornos","prick",
                              "pricks","pronx","pube","pusse","pussi","pussies","pussy","pussys","rectum","retard","rimjaw","rimming","s hit","s.o.b.","sadist",
                              "schlong","screwing","scroat","scrote","scrotum","semen","sex","sh!+","sh!t","sh1t","shag","shagger","shaggin","shagging","shemale",
                              "shi+","shit","shitdick","shite","shited","shitey","shitfuck","shitfull","shithead","shiting","shitings","shits","shitted","shitter",
                              "shitters","shitting","shittings","shitty","skank","slut","sluts","smegma","smut","snatch","son-of-a-bitch","spac","spunk","s_h_i_t",
                              "t1tt1e5","t1tties","teets","teez","testical","testicle","tit","titfuck","tits","titt","tittie5","tittiefucker","titties","tittyfuck",
                              "tittywank","titwank","tosser","turd","tw4t","twat","twathead","twatty","twunt","twunter","v14gra","v1gra","vagina","viagra","vulva",
                              "w00se","wang","wank","wanker","wanky","whoar","whore","willies","willy","xrated","xxx", "fuck", "Fuck", "kkk");


          if (!preg_match("/^[a-zA-Z ]*$/",$firstName) || !preg_match("/^[a-zA-Z ]*$/", $lastName)) 
            $nameErr = "Name Error: Only letters and white space allowed"; 


          elseif (in_array($firstName, $profanity))
            $nameErr = "Name Error: '".$firstName."'"." is not allowed as a first name";

          elseif (in_array($lastName, $profanity))
            $nameErr = "Name Error: '".$lastName."'"." is not allowed as a last name";
          
          else
          {
            require_once 'DBManager.php';
            $db = new DBManager();
            $db->updateUserWithUserID(NULL, $firstName, $lastName, NULL, NULL, $course, $halls, $_SESSION['userID']);
          }

        }

$userID = $_SESSION["userID"];
$email = $_SESSION["email"];

  if (isset($_POST["delete"]))
  {
    header("Location: delete-popout.php");
    $_SESSION["email"] = $email;
    $_SESSION["userID"] = $userID;
  }

?>
  <?php
      //$_SESSION['userID'] = "TEST3";
      // $_SESSION['userID'] = "6c1d265c_2015-03-10_00:23:12";
      //$_SESSION['userID'] = "56249fff_2015-03-07_18:15:41";
      require_once 'DBManager.php';
      $db = new DBManager();

      // Get user info
      $db->getUserWithUserID($_SESSION['userID']);
      $userInfo = json_decode($db->returnArray);

      $nameErr = "";

      // Get all users in same halls
      //$db->getAllUserIdsFromHall($userInfo[6]);
      //$hallsMembers = json_decode($db->returnArray);

      // Get all socs for user
      //$db->readSocietyListFromUserID($_SESSION['userID']);
      //$userSocs = json_decode($db->returnArray);

      // Get all members in soc
      //$db->readAllUserIDsForSociety("society name");
      //$socMembers = json_decode($db->returnArray);


    ?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Profile Page</title>

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

     <div class="container">
      <div class="content-container">

        <div class="content-left">
          <div class="center-profile">
            
            <?php 
            $db->getUserImageForUserID($response[7]);
            //response is a boolean followed by the userID
            $profilepageimage = json_decode($db->returnArray);
            echo '<img class="profilepagepic" src="data:image/jpeg;base64,'.$profilepageimage[1].'"/>'; 
            
            //$db->getUserImageForUserID($userID);?>

            <center>
            <br><p class="profilepagetext">First Name:  <?php print $userInfo[1];?>
            <br>Last Name:  <?php print $userInfo[2];?> 
            <br>Course:  <?php print $userInfo[5];?> 
            <br>Halls: <?php print $userInfo[6];?><br></p>
          </center>
            <div style="text-align:center;">
            <a href="editprofile.php" class="button1 edit">Edit</a>
          </div>
            <?php print $nameErr;?>
          </div>
          
        </div>

        <div class="content-middle1">
      
      <div>
      <?php  
      $userID = $_SESSION["userID"];

      $db->getUserImageForUserID($post1[0]);
      //response is a boolean followed by the userID
      $postUserImage1 = json_decode($db->returnArray);
      if ($postUserImage1 != null)
      {
      echo '<img class="postUserImage" src="data:image/jpeg;base64,'.$postUserImage1[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE EVENTS';
        echo $break;
        echo $break;
        echo '<div class="fb-share-button" data-href="https://web.cs.manchester.ac.uk/mbax4em3/myhalls/FullWebsite/mainpage.php" data-layout="button_count"></div>';
      }

        ?>
      
     </div>
    <div class="postUser"> 
      <?php $db->getUserWithUserID($post1[0]);
      $userName1 = json_decode($db->returnArray);
      print $userName1[1]; echo " ";
      print $userName1[2]; 
      ?>

     </div>
    <div class="postName">
      <?php 
      print $post1[1]; echo " ";
      ?>
     </div>
     <br>
     
    <div class="postDescription">
      <?php 
      print $post1[2]; echo " ";
      ?>
     </div>
     <br>
    <div class="postDate">
      <?php 
      if ($postUserImage1 != null)
      {
      print $post1[3]; echo " "; echo " @ "; echo " ";
      }
      ?>
     </div>
     <br>
    <div class="postTime">
      <?php 
        
       print $post1[4]; echo " ";
      ?>
     </div>
     <br>
    <div class="attend">
      <?php 
      if ($postUserImage1 != null)
      {  
        $userID = $_SESSION["userID"];
        $db->getAllPostsID();
        $resp = json_decode($db->returnArray);
        $postID = $resp[$_SESSION["postvariable1"]];
        $db->getAllPostsAttendNumber();
        $resp1 = json_decode($db->returnArray);
        ${'count'.$a} = $resp1[$_SESSION["postvariable1"]];
        $db->attendEvent($postID, $userID);
        $respond = json_decode($db->returnArray);
        $postIDAttend = $respond[0];
        $userIDAttend = $respond[1];

        if(($userID != $userIDAttend) && ($postID != $postIDAttend))
        {  
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$a}.'</span>
	             <input type="submit" value="Attend" class="share__btn" name="attend'.$a.'"></form></div>';
          echo $button;
          if(isset($_POST["attend".$a.""]))
          {
            ob_end_clean();
            $db->addEventToAttend($postID, $userID);
            ${'count'.$a} = ${'count'.$a} + 1;
            $db->updateNumberAttendingFromPosts(${'count'.$a}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$a}.'</span>
	               <input type="submit" value="Unattend" class="share__btn" name="unattend'.$a.'"></form></div>';
            echo $button;
           }
         }
         
        if(($userID == $userIDAttend) && ($postID == $postIDAttend))
        {
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$a}.'</span>
	             <input type="submit" value="Unattend" class="share__btn" name="unattend'.$a.'"></form></div>';
          echo $button;
 
          if(isset($_POST["unattend".$a.""]))
          {
            ob_end_clean();
            $db->deleteEventToAttend($postID, $userID);
            ${'count'.$a} = ${'count'.$a} - 1;
            $db->updateNumberAttendingFromPosts(${'count'.$a}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$a}.'</span>
	               <input type="submit" value="Attend" class="share__btn" name="attend'.$a.'"></form></div>';
            echo $button;
          }
        }
      }
      ?>
    </div>
    
    


  </div>
  <div class="content-middle2">
    <div>
      
       <?php  $db->getUserImageForUserID($post2[0]);
      //response is a boolean followed by the userID
      $postUserImage2 = json_decode($db->returnArray);
      if ($postUserImage2 != null)
      {
      echo '<img class="postUserImage" src="data:image/jpeg;base64,'.$postUserImage2[1].'"/>';
      }
      else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE EVENTS';
      }
      ?>
   
     </div>
    <div class="postUser"> 
      <?php $db->getUserWithUserID($post2[0]);
      $userName2 = json_decode($db->returnArray);
      print $userName2[1]; echo " ";
      print $userName2[2]; 
      ?>

     </div>
    <div class="postName">
      <?php 
      print $post2[1]; echo " ";
      ?>
     </div>
     
    <div class="postDescription">
      <?php 
      print $post2[2]; echo " ";
      ?>
     </div>
     <br>
    <div class="postDate">
      <?php 
      if ($postUserImage2 != null)
      {
      print $post2[3]; echo " "; echo " @ "; echo " ";
    }
      ?>
     </div>
     <br>
    <div class="postTime">
      <?php 
        
       print $post2[4]; echo " ";
      ?>
     </div>
     <br>
    <div class="attend">
      <?php
      if ($postUserImage2 != null)
      {
        $userID = $_SESSION["userID"];
        $db->getAllPostsID();
        $resp = json_decode($db->returnArray);
        $postID = $resp[$_SESSION["postvariable2"]];
        $db->getAllPostsAttendNumber();
        $resp2 = json_decode($db->returnArray);
        ${'count'.$b} = $resp2[$_SESSION["postvariable2"]];
        $db->attendEvent($postID, $userID);
        $respond = json_decode($db->returnArray);
        $postIDAttend = $respond[0];
        $userIDAttend = $respond[1];

        if(($userID != $userIDAttend) && ($postID != $postIDAttend))
        {  
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$b}.'</span>
	             <input type="submit" value="Attend" class="share__btn" name="attend'.$b.'"></form></div>';
          echo $button;
          if(isset($_POST["attend".$b.""]))
          {
            ob_end_clean();
            $db->addEventToAttend($postID, $userID);
            ${'count'.$b} = ${'count'.$b} + 1;
            $db->updateNumberAttendingFromPosts(${'count'.$b}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$b}.'</span>
	               <input type="submit" value="Unattend" class="share__btn" name="unattend'.$b.'"></form></div>';
            echo $button;
           }
         }
         
        if(($userID == $userIDAttend) && ($postID == $postIDAttend))
        {
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$b}.'</span>
	             <input type="submit" value="Unattend" class="share__btn" name="unattend'.$b.'"></form></div>';
          echo $button;
 
          if(isset($_POST["unattend".$b.""]))
          {
            ob_end_clean();
            $db->deleteEventToAttend($postID, $userID);
            ${'count'.$b} = ${'count'.$b} - 1;
            $db->updateNumberAttendingFromPosts(${'count'.$b}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$b}.'</span>
	               <input type="submit" value="Attend" class="share__btn" name="attend'.$b.'"></form></div>';
            echo $button;
          }
        }
      }
        ?>
    </div>


  </div>

    <div class="content-middle3">
      <div>
      
       <?php  $db->getUserImageForUserID($post3[0]);
       //response is a boolean followed by the userID
       $postUserImage3 = json_decode($db->returnArray);
       if ($postUserImage3 != null) {
       echo '<img class="postUserImage" src="data:image/jpeg;base64,'.$postUserImage3[1].'"/>'; }
       else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE EVENTS';
      }
       ?>
   
     </div>
    <div class="postUser"> 
      <?php 


      $db->getUserWithUserID($post3[0]);
      $userName3 = json_decode($db->returnArray);
      print $userName3[1]; echo " ";
      print $userName3[2]; 
      ?>

     </div>
    <div class="postName">
      <?php 
      print $post3[1]; echo " ";
      ?>
     </div>
     
    <div class="postDescription">
      <?php 
      print $post3[2]; echo " ";
      ?>
     </div>
     <br>
    <div class="postDate">
      <?php   
      if ($postUserImage3 != null) {

      print $post3[3]; echo " "; echo " @ "; echo " "; }
      ?>
     </div>
     <br>
    <div class="postTime">
      <?php 
        
       print $post3[4]; echo " ";
      ?>
     </div>
     <br>
    <div class="attend">
      <?php 
      if ($postUserImage3 != null) 
      {
        $userID = $_SESSION["userID"];
        $db->getAllPostsID();
        $resp = json_decode($db->returnArray);
        $postID = $resp[$_SESSION["postvariable3"]];
        $db->getAllPostsAttendNumber();
        $resp3 = json_decode($db->returnArray);
        ${'count'.$c} = $resp3[$_SESSION["postvariable3"]];
        $db->attendEvent($postID, $userID);
        $respond = json_decode($db->returnArray);
        $postIDAttend = $respond[0];
        $userIDAttend = $respond[1];

        if(($userID != $userIDAttend) && ($postID != $postIDAttend))
        {  
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$c}.'</span>
	             <input type="submit" value="Attend" class="share__btn" name="attend'.$c.'"></form></div>';
          echo $button;
          if(isset($_POST["attend".$c.""]))
          {
            ob_end_clean();
            $db->addEventToAttend($postID, $userID);
            ${'count'.$c} = ${'count'.$c} + 1;
            $db->updateNumberAttendingFromPosts(${'count'.$c}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$c}.'</span>
	               <input type="submit" value="Unattend" class="share__btn" name="unattend'.$c.'"></form></div>';
            echo $button;
           }
         }
         
        if(($userID == $userIDAttend) && ($postID == $postIDAttend))
        {
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$c}.'</span>
	             <input type="submit" value="Unattend" class="share__btn" name="unattend'.$c.'"></form></div>';
          echo $button;
 
          if(isset($_POST["unattend".$c.""]))
          {
            ob_end_clean();
            $db->deleteEventToAttend($postID, $userID);
            ${'count'.$c} = ${'count'.$c} - 1;
            $db->updateNumberAttendingFromPosts(${'count'.$c}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$c}.'</span>
	               <input type="submit" value="Attend" class="share__btn" name="attend'.$c.'"></form></div>';
            echo $button;
          }
        }
      }
      ?>
    </div>

    </div>
      <div class="content-middle4">
        <div>
      
       <?php  $db->getUserImageForUserID($post4[0]);
       //response is a boolean followed by the userID
       $postUserImage4 = json_decode($db->returnArray);
       if ($postUserImage4 != null) {
       echo '<img class="postUserImage" src="data:image/jpeg;base64,'.$postUserImage4[1].'"/>'; }
       else
      {
        echo 'TELL YOUR FRIENDS ABOUT MYHALLS FOR MORE EVENTS';
      }
       ?>
     
     </div>
    <div class="postUser"> 
      <?php $db->getUserWithUserID($post4[0]);
      $userName4 = json_decode($db->returnArray);
      print $userName4[1]; echo " ";
      print $userName4[2]; 
      ?>

     </div>
    <div class="postName">
      <?php 
      print $post4[1]; echo " ";
      ?>
     </div>
     
    <div class="postDescription">
      <?php 
      print $post4[2]; echo " ";
      ?>
     </div>
     <br>
    <div class="postDate">
      <?php 
      if ($postUserImage4 != null) {

      print $post4[3]; echo " "; echo " @ "; echo " "; }
      ?>
     </div>
     <br>
    <div class="postTime">
      <?php 
        
       print $post4[4]; echo " ";
      ?>
     </div>
     <br>
    <div class="attend">
      <?php if ($postUserImage4 != null) 
            {
        $userID = $_SESSION["userID"];
        $db->getAllPostsID();
        $resp = json_decode($db->returnArray);
        $postID = $resp[$_SESSION["postvariable4"]];
        $db->getAllPostsAttendNumber();
        $resp4 = json_decode($db->returnArray);
        ${'count'.$d} = $resp4[$_SESSION["postvariable4"]];
        $db->attendEvent($postID, $userID);
        $respond = json_decode($db->returnArray);
        $postIDAttend = $respond[0];
        $userIDAttend = $respond[1];

        if(($userID != $userIDAttend) && ($postID != $postIDAttend))
        {  
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$d}.'</span>
	             <input type="submit" value="Attend" class="share__btn" name="attend'.$d.'"></form></div>';
          echo $button;
          if(isset($_POST["attend".$d.""]))
          {
            ob_end_clean();
            $db->addEventToAttend($postID, $userID);
            ${'count'.$d} = ${'count'.$d} + 1;
            $db->updateNumberAttendingFromPosts(${'count'.$d}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$d}.'</span>
	               <input type="submit" value="Unattend" class="share__btn" name="unattend'.$d.'"></form></div>';
            echo $button;
           }
         }
         
        if(($userID == $userIDAttend) && ($postID == $postIDAttend))
        {
          ob_start();
          $button = '<div class="share share_type_gplus">
                     <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	             <span class="share__count">'.${'count'.$d}.'</span>
	             <input type="submit" value="Unattend" class="share__btn" name="unattend'.$d.'"></form></div>';
          echo $button;
 
          if(isset($_POST["unattend".$d.""]))
          {
            ob_end_clean();
            $db->deleteEventToAttend($postID, $userID);
            ${'count'.$d} = ${'count'.$d} - 1;
            $db->updateNumberAttendingFromPosts(${'count'.$d}, $postID);
            $button = '<div class="share share_type_gplus">
                       <form  action="profilepage.php" method="post" name="query" class="share share_type_gplus">
	               <span class="share__count">'.${'count'.$d}.'</span>
	               <input type="submit" value="Attend" class="share__btn" name="attend'.$d.'"></form></div>';
            echo $button;
          }
        }
      }
      ?>
    </div>
      </div>
      <div class="content-middle6">
        <center>
        <a href="loadnewposts.php"><button class="load-button" type="button">New Events</button></a>
        <a href="createhallevent.php"><button class="load-button" type="button">New Event</button></a></a>
        <a href="loadoldpost.php"><button class="load-button" type="button">Old Events</button></a></a>
      </center>
      </div>        

        <div class="content-right" style="overflow:auto">
        <p><b><center>Course Tutor</center></b></p>
<?php
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$tutor = $response[11];

$db->getAllUserNameFromTutors($tutor);
$response2 = json_decode($db->returnArray);
$tutorName = $response2[0];

$break = '<br/>';

$db->getUserImageForUserID($tutorName);
$UserImage = json_decode($db->returnArray);
echo '<img class="UserImageOnline" src="data:image/jpeg;base64,'.$UserImage[1].'"/>';
printf ("%s\n", $tutorName);
$db->getUserImageForUserID("email");
$UserImage = json_decode($db->returnArray);
echo '<a href="tutormail.php"><img class="EmailDot" src="data:image/jpeg;base64,'.$UserImage[1].'"/></a>';
echo $break;

?>

        <p><b><center>Course Friends</center></b></p>

<?php
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$email = $response[3];
$course = $response[5];

$db->getAllUserNameFromCourse($email, $course);
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

        <p><b><center>Hall Friends</center></b></p>
<?php
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