<?php


session_start();

$con = mysqli_connect("localhost" , "root" , "houssem0123" , "projet");


$postId = $_GET['id'];

$req = "delete images from images where id_img = ".$postId;

$res = mysqli_query($con , $req);

header("Location: profile.php");


