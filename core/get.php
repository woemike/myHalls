<?php

  session_start();

  $servername = "dbhost.cs.man.ac.uk";
    $username = "mbax4ar4";
    $password = "123456789T";
    $dbname = "2014_comp10120_z8";
    $imageTable = "Table_Images";

  $link = new mysqli($servername, $username, $password, $dbname);
    if ($link->connect_errno) {
        printf("Connect failed: %s\n",$link->connect_error);
        exit();
    }

    $id = addslashes($_GET['id']);
    $image = $link->query("SELECT userImage FROM $imageTable WHERE userID = '$id'");

    $row = $image->fetch_array(MYSQLI_ASSOC);



    header("Content-Type: image/jpeg");
    

    echo $row['userImage'];


?>