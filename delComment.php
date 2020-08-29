<?php



session_start();




$con  = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet");



$req = "delete img_comment from img_comment where id_comment = ".$_GET['id_comm'];   
    
$res = mysqli_query($con , $req);

header("Location: profile.php");


?>