<?php

session_start();

$con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet"); 


$msg = $_POST['msg'];

$sender = $_POST['sender'];

$reciever = $_POST['reciever'];

$date = date('Y-m-d H:i:s');

echo $date;

$req = "INSERT INTO messages  VALUES (NULL, '$sender', '$reciever', '$msg','$date')";
    
    mysqli_query($con , $req);
    
    
  header("Location: profileFr.php?id=".$reciever);
