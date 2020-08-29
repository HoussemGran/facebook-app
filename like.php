
<?php

session_start();


$id_user = $_GET['id_user'];
$id_img = $_GET['id_img'];

$con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet"); 


$reqTest = "select * from img_liked where id_user = ". $_SESSION['userId'] . " and id_img = $id_img";

$resTest = mysqli_query($con , $reqTest);

if(mysqli_num_rows($resTest) < 1 ){
    
  
    

$reqImgLiked = "insert into img_liked (id_user , id_img) values (".$_SESSION['userId']." , $id_img)";

$resImgLiked = mysqli_query($con , $reqImgLiked);

    }


  $reqfr = "select * from user where id = ".$id_user;
       
    $resfr = mysqli_query($con , $reqfr);   
       

   if($_GET['loc'] == 'home'){
            
        header("Location: home.php");    
            
        }

    else{       

    
    while($rowfr = mysqli_fetch_assoc($resfr)){
        
            
      header("Location: profileFr.php?id=".$rowfr['id']);
        
    }  
    
}

