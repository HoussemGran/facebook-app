<?php


session_start();


$con = mysqli_connect("localhost","root","houssem0123","projet");

$image = $_FILES['img']['name'];

$target = "images/".basename($image);

move_uploaded_file($_FILES['img']['tmp_name'],$target);

$req ="update user set img_profile = '$image' where id = ".$_SESSION['userId'];

$res = mysqli_query($con , $req);

header("Location: home.php");


?>