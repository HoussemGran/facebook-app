<?php

session_start();



    
$con = $con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet");    

?>

<!doctype html>
<html>
    
<head>

    
<link rel="icon" class="img-circle" type="image/jpg" href="images/internet.png" >    
    
<title>HOME</title>

   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    
    </script>
    
    <style>
    
     body{
        
        
    background-color: #fafafa;    
        
    font-family: "Comic Sans MS";
    
        
    }
    
        #img_profile{
            
            
        width: 30px;    
            
        }
    
    </style>
    
    
    </head>    
    
    <body>
        
           <?php

    
   if(isset($_SESSION['userName'])){ 
       
    ?>
    
         <nav class="navbar navbar-default container-fluid">
        
        <ul class="nav navbar-nav">
        <li><a href="profile.php"> Management </a> </li>
        <li><a href="home.php">  Home </a></li>
        </ul>
         <ul class="nav navbar-nav navbar-right">
         
            <li><a href="logout.php"><button type="submit" class="btn btn-danger" > Log Out </button></a>  </li> 
             
         </ul>
    
    </nav>

        
<?php 
        
 
$req = "select * from images where id_img = ".$_GET['id_img'];
        
$res = mysqli_query($con , $req);
        
        
     
             $reqLike = "select * from img_liked where id_img = ".$_GET['id_img'];
        
             $resLike = mysqli_query($con , $reqLike);   
        
?>        
        
        
<div class="container">
        
        
<div class="row">
    
<div class="col-sm-4">
    

<div class="thumbnail">
    
<?php  while($rowImg = mysqli_fetch_assoc($res)){  ?>
    
<strong> <?php  $reqUser = "select * from user where id = ".$rowImg['id_user'];
    
                $resUser = mysqli_query($con , $reqUser);
                                                 
                if($rowUser = mysqli_fetch_assoc($resUser)){  ?>
    
    
    <a href="profileFr.php?id=<?php  echo $rowImg['id_user']; ?>">  <?php echo  $rowUser['username']; ?> </a><?php }?>
    
    
                </strong>    
    
 <h5><?php  echo  "<h6>". substr($rowImg['date'] , 0 , 10)."</h6><hr>" ?> </h5>
        
      	<img alt="" src='images/<?php echo $rowImg['image'] ?>' >
         
         <div class='caption'>
      	
         <h5><?php echo "<strong>".$rowImg['text']."</strong><hr>" ?> </h5>
             
        <h6><?php  echo mysqli_num_rows($resLike)." likes" ?>  </h6>
        
     
<?php } ?>    
    
</div>    
    
    </div>
    </div>
    
<div class="col-sm-6">

     <table>
        
         
           
        <?php 
        
       
        
            $reqComm =

              "SELECT * from user u , img_comment imgc , images img WHERE u.id = imgc.id_user and img.id_img = imgc.id_img 

              and img.id_img = ".$_GET['id_img'];



            $resComm = mysqli_query($con , $reqComm);
    
        
        while($rowComm = mysqli_fetch_assoc($resComm)){
            
            $userName = $rowComm['username'];
            
            
        ?>    
       

        
           <tr><td><a href="profileFr.php?id=<?php  echo $rowComm['id'] ?>"><img class="img-circle" id="img_profile" src="images/<?php echo $rowComm['img_profile']  ?>"><?php echo "<div class='comm'><strong>".$rowComm['username']."</strong>" ?> </a></td></tr>
           
           <tr><td> <?php   echo  "<div class='comm'>".$rowComm['img_comment']."</div><hr>"  ?> </td> </tr>    
        
        
       
        
            
            
        <?php
    
        }  
        
        ?>
    
       </table>
        

    
    </div>    
         
        
        </div>
        
        </div>  
    
            <?php
    
       
    }
    
    else
      header("Location: login.php?trytologin");  
        
    ?>
    
        
    </body>
    
    
    
</html>

 

