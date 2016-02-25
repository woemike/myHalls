<?php session_start();
 if (!$_SESSION["email"])
  header ("Location: myHallsLog.php");
require_once 'DBManager.php';
$db = new DBManager(); 
$db->getUserWithEmail($_SESSION["email"]);
$response = json_decode($db->returnArray);
$username = $response[1] . ' ' . $response[2];
?>
<?php if(!$_SESSION['userID'])
        header('Location: myHallsLog.php') ?>

<?php if(isset($_POST['submit']))
        {
          $tmp_image = $_FILES["image"]["tmp_name"];
          $check = filesize($tmp_image);
          $target_dir = "uploads/";
          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          $userImage = file_get_contents($tmp_image);

          if($check === false) 
            $imageErr = "File is not an image.";

          elseif($check > 16777000) 
            $imageErr = "File is too large.";

       

          else
          {
            $imageErr = "";
            require_once 'DBManager.php';
            $db = new DBManager();
            $db->updateImageForUserID($tmp_image, $_SESSION['userID']);
          }

        }?>

<?php $imageErr = ""; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Edit Profile Page</title>

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

      <div class="content-container">
      <div class="content-middle">
       <div class="center-profile">
            <?php echo $imageErr ?>
            <?php $userID = $_SESSION['userID'];
                  echo "<img src=get.php?id=$userID class='profilepagepic' >";
                  require_once 'DBManager.php';
                  $db = new DBManager(); 
                  $db->getUserImageForUserID($userID);?>
            <br>
            <form action="editprofile.php" method="post" enctype="multipart/form-data">
            <input class="input-form-image-left" type="file" name="image" id="image"> 
            <input class="input-form-image-right"  type="submit" value="Upload Image" name="submit">
            </form>
            <br><br>
           </div>
          <form action="profilepage.php" method="post">
            <center><b>First Name: </b><?php print $response[1];?><br><input type="text" name="firstName" maxlength="10"><br><?php if($firstNameOK = 0) print "No Naughtiness Please" ?>
            <b>Last Name: </b><?php print $response[2]; ?><br><input type="text" name="lastName" maxlength="10"><br><?php if($lastNameOK = 0) print "No Naughtiness Please" ?> <br>
            <b>Halls of Residence: </b>
            <select name="halls">
              <option value="Ashburne Hall">Ashburne Hall</option>
              <option value="Burkhardt House">Burkhardt House</option>
              <option value="Canterbury Court">Canterbury Court</option>
              <option value="Dalton Ellis Hall">Dalton-Ellis Hall</option>
              <option value="Denmark Road">Denmark Road</option>
              <option value="George-Kenyon Hall">George Kenyon Hall</option>
              <option value="Horniman House">Horniman House</option>
              <option value="Hulme Hall">Hulme Hall</option>
              <option value="Oak House">Oak House</option>
              <option value="Opal Gardens">Opal Gardens</option>
              <option value="Opal Hall">Opal Hall</option>
              <option value="Owens Park">Owens Park</option>
              <option value="Richmond Park">Richmond Park</option>
              <option value="Saint Anselm Hall">Saint Anselm Hall</option>
              <option value="Saint Gabriels Hall">Saint Gabriels Hall</option>
              <option value="Sheavyn House">Sheavyn House</option>
              <option value="The Firs Villa">The Firs Villa</option>
              <option value="Victoria Hall">Victoria Hall</option>
              <option value="Weston Hall">Weston Hall</option>
              <option value="Whitworth Park">Whitworth Park</option>
              <option value="Woolton Hall">Woolton Hall</option>
              <option value="Wright Robinson">Wright Robinson</option>
            </select>
            <br><br>
           <b>Course: </b>
            <select name="course">
              <option value="<?php print $response[5]?>"><?php print $response[5]?></option>
	    <option value="Accounting and Finance">Accounting and Finance</option>
	    <option value="Aerospace Engineering">Aerospace Engineering</option>
	    <option value="Anatomical Science">Anatomical Science</option>
	    <option value="Arabic Studies">Arabic Studies</option>
	    <option value="Archaeology">Archaeology</option>
	    <option value="Architecture">Architecture</option>
	    <option value="Art History and Visual Studies">Art History and Visual Studies</option>
	    <option value="Audiology">Audiology</option>
	    <option value="Biochemistry">Biochemistry</option>
	    <option value="Biology">Biology</option>
	    <option value="Biomedical Sciences">Biomedical Sciences</option>
	    <option value="Biotechnology">Biotechnology</option>
	    <option value="Business and Management">Business and Management</option>
	    <option value="Cell Biology">Cell Biology</option>
	    <option value="Chemical Engineering and Analytical Science">Chemical Engineering and Analytical Science</option>
	    <option value="Chemistry">Chemistry</option>
	    <option value="Civil Engineering">Civil Engineering</option>
	    <option value="Classics and Ancient History">Classics and Ancient History</option>
	    <option value="Cognitive Neuroscience and Psychology">Cognitive Neuroscience and Psychology</option>
	    <option value="Computer Science">Computer Science</option>
	    <option value="Criminology">Criminology</option>
	    <option value="Dentistry">Dentistry</option>
	    <option value="Development Studies">Development Studies</option>
	    <option value="Drama">Drama</option>
	    <option value="Earth, Atmospheric and Environmental Sciences">Earth, Atmospheric and Environmental Sciences</option>
	    <option value="East Asian Studies">East Asian Studies</option>
	    <option value="Economics">Economics</option>
	    <option value="Education">Education</option>
	    <option value="Electrical and Electronic Engineering">Electrical and Electronic Engineering</option>
	    <option value="English Literature, American Studies and Creative Writing">English Literature, American Studies and Creative Writing</option>
	    <option value="Environmental Sciences">Environmental Sciences</option>
	    <option value="European Languages and Cultures">European Languages and Cultures</option>
	    <option value="French Studies">French Studies</option>
	    <option value="Genetics">Genetics</option>
	    <option value="Geography">Geography</option>
	    <option value="Geology">Geology</option>
	    <option value="German Studies">German Studies</option>
	    <option value="Government, Politics and International Relations">Government, Politics and International Relations</option>
	    <option value="History">History</option>
	    <option value="Human Resources">Human Resources</option>
	    <option value="Humanitarianism and Conflict Response">Humanitarianism and Conflict Response</option>
	    <option value="Informatics">Informatics</option>
	    <option value="International Development">International Development</option>
	    <option value="Italian Studies">Italian Studies</option>
	    <option value="Law">Law</option>
	    <option value="Leisure">Leisure</option>
	    <option value="Life Sciences">Life Sciences</option>
	    <option value="Linguistics and English Language">Linguistics and English Language</option>
	    <option value="Materials">Materials</option>
	    <option value="Mathematics">Mathematics</option>
	    <option value="Mechanical Engineering">Mechanical Engineering</option>
	    <option value="Medical Biochemistry">Medical Biochemistry</option>
	    <option value="Medicine">Medicine</option>
	    <option value="Microbiology">Microbiology</option>
	    <option value="Middle Eastern Studies">Middle Eastern Studies</option>
	    <option value="Modern Languages and Cultures">Modern Languages and Cultures</option>
	    <option value="Molecular Biology">Molecular Biology</option>
	    <option value="Music">Music</option>
	    <option value="Neuroscience">Neuroscience</option>
	    <option value="Nursing, Midwifery and Social Work">Nursing, Midwifery and Social Work</option>
	    <option value="Optometry">Optometry</option>
	    <option value="Petroleum Engineering">Petroleum Engineering</option>
	    <option value="Pharmacology">Pharmacology</option>
	    <option value="Pharmacy and Pharmaceutical Sciences">Pharmacy and Pharmaceutical Sciences</option>
	    <option value="Philosophy">Philosophy</option>
	    <option value="Physics and Astronomy">Physics and Astronomy</option>
	    <option value="Physiology">Physiology</option>
	    <option value="Planning and Environmental Management">Planning and Environmental Management</option>
	    <option value="Plant Science">Plant Science</option>
	    <option value="Politics">Politics</option>
	    <option value="Psychology">Psychology</option>
	    <option value="Religions and Theology">Religions and Theology</option>
	    <option value="Russian and East European Studies">Russian and East European Studies</option>
	    <option value="Screen Studies">Screen Studies</option>
	    <option value="Social Anthropology">Social Anthropology</option>
	    <option value="Social Sciences">Social Sciences</option>
	    <option value="Social Statistics">Social Statistics</option>
	    <option value="Sociology">Sociology</option>
	    <option value="Spanish, Portuguese and Latin American Studies">Spanish, Portuguese and Latin American Studies</option>
	    <option value="Speech and Language Therapy">Speech and Language Therapy</option>
	    <option value="Sustainable Consumption">Sustainable Consumption</option>
	    <option value="Textiles and Paper Science">Textiles and Paper Science</option>
	    <option value="Zoology">Zoology</option>
            </select><br><br></center>
          <center><input name="save" type="submit" value="Save">
                  <input name="delete" type="submit" value="Delete" class="delete-button"></center>
                 </form>
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