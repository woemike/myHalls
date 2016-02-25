<?php 
session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[1] . ' ' . $response[2];


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

    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>

     <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
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
   <div class="content-nightsout1">
    <img class="flyers" src="images/factory.jpg" alt="factory flyer">
    <p class="flyer-texttitle">The Factory 251</p>
    
    <div class="flyer-text"><p><br />Factory251 is a popular nightclub in central Manchester. After the space re-opened under the new name in 2010, it has become a staple feature in Manchester's nightlife scene. The club is spread over 3 floors and the rooms are dark 
    and spacious enough to have a few hundred people flooding the dancefloors inside. Despite its large capacity, Factory251 is not a super club, nor does it intend to be.</p><br />
        <a href="http://www.factorymanchester.com/" target="_blank">http://www.factorymanchester.com</a>
    </div>

    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M1+7en&amp;output=embed">
    </iframe>
    <!-- <img class="flyer" src="arkflyer.jpg" alt="factory flyer"> -->
    </div>
  <div class="content-nightsout2">
    <img class="flyers" src="images/ark.jpg" alt="ark flyer">
    <p class="flyer-texttitle">Ark Deansgate</p>
    <div class="flyer-text"><p><br />A stylish and sassy party bar situated on Deansgate Locks, ARK Deansgate is one of the most popular venues on the strip thanks to its heaving weekends and dapper drinks deals.
    Making use of its cool industrial plot and a name inspired by the US state of Montana, the bare brick walls and stylish booth seating in ARK create a sophisticated atmosphere for both day and night.</p><br />
      <a href="http://www.arkmanchester.co.uk/" target="_blank">http://www.arkmanchester.co.uk</a>
    </div>
    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M1+5LH&amp;output=embed">
    </iframe>
    
  </div>
  <div class="content-nightsout3">
    <img class="flyers" src="images/fifth.jpg" alt="fifth flyer">
    <p class="flyer-texttitle">5th Avenue</p>
    
    <div class="flyer-text"><p><br />5th Avenue, self-billed as "Manchester's No.1 Indie experience", is one of the mainstay clubs on the Manchester nightlife scene. If you have been to Manchester, there is a strong chance you will have 
    heard of 5th Avenue. Its massive dance floor space, function one sound system and state of the art lighting are just some of the features that make this club a must visit when out on the town. </p><br />
        <a href="http://www.fifthmanchester.com/" target="_blank">http://www.fifthmanchester.com</a>
    </div>

    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M1+7AG&amp;output=embed">
    </iframe>
  </div>

  <div class="content-nightsout4">
    <img class="flyers" src="images/satans_hollow.jpg" alt="Satans Hollow">
    <p class="flyer-texttitle">Satans Hollow</p>
    <div class="flyer-text"><p><br />Satans caters for Punk/Rock/Metal lovers, part of the reason why it’s so popular amongst the young clubbing crowd of the city. Get your smart-phone out, because this place is a little tricky to find, 
      but once you get there, you’ll be glad you made the effort. With cheap entry  all week, Satans Hollow attracts a young and party hungry crowd waiting to let loose, so don’t expect a quiet glass of vino here.</p><br />
        <a href="http://www.skiddle.com/whats-on/Manchester/Satans-Hollow/" target="_blank">http://www.skiddle.com/whats-on/Manchester/Satans-Hollow/</a>
    </div>
    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M1+6DD&amp;output=embed">
    </iframe>
  </div>

  <div class="content-nightsout5">
    <img class="flyers" src="images/Sankeys.jpg" alt="Sankeys">
    <p class="flyer-texttitle">Sankeys</p>
    <div class="flyer-text"><p><br />TSankeys is an amazing venue full of amazing people, also the music isn't too bad either! Its varied but focused on underground electronic music, from house and techno nights such as Continue and 
      Sankeys Presents, through to trance from Garuda. The club also hosts one-off nights from outside promoters. Generally it isn't a brilliant or bad place to throw up, it all depends on your attitude. </p><br />
        <a href="http://www.sankeys.info/" target="_blank">http://www.sankeys.info/</a>
    </div>
    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M4+6JG&amp;output=embed">
    </iframe>
  </div>

  <div class="content-nightsout6">
    <img class="flyers" src="images/bijou_club.jpg" alt="Bijou Club">
    <p class="flyer-texttitle">Bijou Club</p>
    <div class="flyer-text"><p><br />An infamous celebrity hang-out in Manchester City Center boasting a long list of celebrity party-goers including Ne-Yo,Tulisa, Drake, Rita Ora, The Wanted to name but a few and have hosted all 
      of the biggest after parties to take place in the North West including The Soap Awards. Basically if you want to be a wannabe then this is the place to skulk around outside looking for celebrity hair folicles. </p><br />
        <a href="http://www.bijouclub.co.uk/" target="_blank">http://www.bijouclub.co.uk/</a>
    </div>
    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M3+7NJ&amp;output=embed">
    </iframe>
  </div>

  <div class="content-nightsout7">
    <img class="flyers" src="images/tiger_tiger.jpg" alt="Tiger Tiger">
    <p class="flyer-texttitle">Tiger Tiger</p>
    <div class="flyer-text"><p><br />Our whirlwind of eight uniquely themed rooms is the perfect way to spend your next night out in Manchester. Get into the party spirit with a Cocktail Making Class or lose yourself in music on 
      our array of legendary dance floors. Tiger Tiger Manchester is where the party's at - so get yourself down to the best night out in town. Have a look below at our individual party spaces. Alex says its really bad...</p><br />
        <a href="http://www.tigertiger.co.uk/manchester/" target="_blank">http://www.tigertiger.co.uk/manchester/</a>
    </div>
    <iframe class="map"
      width="275"
      height="220"
      frameborder="0" style="border:0"
      src="https://maps.google.co.uk/maps?q=M4+2BS&amp;output=embed">
    </iframe>
  </div>

  <br>
  <br>
</div>
</body>
</html>
