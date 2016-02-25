<!DOCTYPE html>
<html>
<head>
  <title>Register myHalls</title>

    <link rel="stylesheet" href="myHallsLi.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="fontawesome.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="meyerweb-reset.css" media="screen" type="text/css" />
</head>

<body>

  <div class="header-cont">

      <div class="header">
        <div class="logo">
         <img src="images/logo-corner.png" alt="myHalls logo" height="30"></a>
        </div>
      </div>

  </div>
<div class="container-body">
     <img src="images/logo.png" class="imgn"> 

    <div class="container-form">

      <div id="login">

        <form   action="myHallsreg.php" method="post" name="query">

          <fieldset  class="clearfix">

            <p><span class="fontawesome-user"></span><input type="text" value="First Name" name="firstname" onBlur="if(this.value == '') this.value = 'First Name'" onFocus="if(this.value == 'First Name') this.value = ''" required></p> 
            <p><span class="fontawesome-user"></span><input type="text" value="Last Name" name="lastname" onBlur="if(this.value == '') this.value = 'Last Name'" onFocus="if(this.value == 'Last Name') this.value = ''" required></p> 
            <p><span class="fontawesome-envelope"></span><input type="text" value="Email" name="email" onBlur="if(this.value == '') this.value = 'Email'" onFocus="if(this.value == 'Email') this.value = ''" required></p> 
            <p><span class="fontawesome-lock"></span><input type="Password"  name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
            <p><span class="fontawesome-lock"></span><input type="Password"  name="repassword" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
 
            <p><span class="fontawesome-heart"></span></p>
            <div class="styled-select" >

            <select name="hall">
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
            </div>

           <p><span class="fontawesome-heart"></span></p>
           <div class="styled-select">

           <select  name="course">
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
	  </select>
	  </div> <br>
          <p><b><center>Tutor</center></b></p><br>
            <p><span class="fontawesome-user"></span></p>
            <div class="styled-select" >
            <select name="coursetutor">
              <option value="David Rydeheard">David Rydeheard</option>
              <option value="John Latham">John Latham</option>
              <option value="Howard Barringer">Howard Barringer</option>
              <option value="Sean Bechhofer">Sean Bechhofer</option>
              <option value="Ke Chen">Ke Chen</option>
              <option value="Suzanne Embury">Suzanne Embury</option>
              <option value="Alvaro Fernandes">Alvaro Fernandes</option>
              <option value="Nicholas Filer">Nicholas Filer</option>
              <option value="Stephen Furber">Stephen Furber</option>
              <option value="Aphrodite Galata">Aphrodite Galata</option>
              <option value="Carole Goble">Carole Goble</option>
              <option value="Simon Harper">Simon Harper</option>
              <option value="Ernie Hill">Ernie Hill</option>
              <option value="Toby Howard">Toby Howard</option>
              <option value="Caroline Jay">Caroline Jay</option>
              <option value="Joshua Knowles">Joshua Knowles</option>
              <option value="Kung-Kiu Lau">Kung-Kiu Lau</option>
              <option value="Pedro Mendes">Pedro Mendes</option>
              <option value="Tim Morris">Tim Morris</option>
              <option value="Goran Nenadic">Goran Nenadic</option>
              <option value="Richard Neville">Richard Neville</option>
              <option value="Paul Nutter">Paul Nutter</option>
              <option value="Gavin Brown">Gavin Brown</option>
            </select>
            </div>
            <div class="styled-select-box" >
                <form action="myHallsreg.php" method="post">
                <center>By pressing the register button you agree with our <a href="legal.txt" target="_blank">terms and conditions! </a></center>
               </form>
            </div>
           <br>
       <p><input type="submit" name="register" value="Register"></p>
    
     </fieldset>
   </form>

 <?php
session_start();
require_once 'DBManager.php';
$db = new DBManager(); 

// Load the configuration file containing your database credentials
require_once('config.inc.php');
// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
// Check for errors before doing anything else
if($mysqli -> connect_error) {
die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}
$msg = "";
if(isset($_POST['register']))
{
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password= $_POST['password'];
  $repassword = $_POST['repassword'];
  $password = md5($password);
  $repassword = md5($repassword);
  $randomString = bin2hex(openssl_random_pseudo_bytes(4));
  $date = new DateTime();
  $randomString .= date_format($date, '_Y-m-d_H:i:s');
  $activationCode = bin2hex(openssl_random_pseudo_bytes(5));
  $var1 = "SELECT * FROM Table_Users WHERE userEmail='$email'";
  $result = $mysqli->query($var1);
  $regex = "/^[a-zA-Z0-9-.]*\@student\.manchester\.ac\.uk$/";

  if($firstname == "First Name" || $lastname == "Last Name" || $password == "Password")
  {
    $msg = "All fields are mandatory!";
  }
  elseif (!preg_match($regex, $email)) // Validate email address
  {
    $msg = "Invalid email address. Please type a valid email!";
  }
  elseif($result->num_rows > 0)
  {
    $msg = "Email already exists!";
  }
  elseif($password != $repassword)
  {
    $msg = "Passwords don't match!";
  }
  else
  { 
    $query = sprintf("INSERT INTO Table_Users (userFirstName, userLastName, userEmail, userPassword, userCourse, userHall, userID, activationCode, userTutor) VALUES 
                                              ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                     mysqli_real_escape_string($mysqli, $firstname),
                     mysqli_real_escape_string($mysqli, $lastname),
                     mysqli_real_escape_string($mysqli, $email),
                     mysqli_real_escape_string($mysqli, $password),
                     mysqli_real_escape_string($mysqli, $_POST['course']),
                     mysqli_real_escape_string($mysqli, $_POST['hall']),
                     mysqli_real_escape_string($mysqli, $randomString),
                     mysqli_real_escape_string($mysqli, $activationCode),
                     mysqli_real_escape_string($mysqli, $_POST['coursetutor']));
  
   $db->assignImageToUserID("default.png", $randomString);
   
   //response is a boolean followed by the userID
   $response = json_decode($db->returnArray);
   
    if (mysqli_query($mysqli, $query) == TRUE)
    {    
      // sending email
      include 'Send_Mail.php';
      $to = $email;
      $subject = "Email verification";
      $body = 'Hi, <br/> <br/> We need to make sure that you are a student. Please verify your email!<br/> <br/> 
      <b>Your Code:</b> '.$activationCode.'';

      Send_Mail($to,$subject,$body);
      header("Location: activation.php");
      $_SESSION["email"] = $email;
     }
 
    }    
 
  }

// Always close your connection to the database cleanly!
$mysqli -> close();

?>
          <div class="msg"><?php echo $msg; ?></div>
        </div>
      </div>
    </div>
  </body>
</html>
