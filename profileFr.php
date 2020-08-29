<?php


session_start();

$con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet"); 

?>

<!doctype html>
<html>
<head>
<link rel="icon" class="img-circle" type="image/jpg" href="images/user.png" >    
    
<title><?php echo  strtoupper($_SESSION['userName']) ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
    <style>
    
        

    
    body{
        
        
    background-color: #fafafa;    
        
    font-family: "Comic Sans MS";
     
        
    }
    
        .images{
            
        opacity: 0.5;    
            
            
        }
        
        #image{
    
        width: 250px;
        height: 250px;    
        
        }    
        
    
    .comm{
        
    background-color:#daeaea ;
        border-radius: 10px;

        padding: 5px 5px;
        
    }
    
       #thumbnail{
        
        margin-top: 1%;
        background-color:  #fafafa;
        border: none;
        
      
        width: 7%;
        height: 7%;
        
    }  
        
    </style>
    <script>
    
     $(function(){
        
        
    $("#thumbnail").animate({width: "10%"},"slow");    
    $("#thumbnail").animate({height: "10%"},"slow");    
        
    $(".images").animate({opacity:1});     
         
         
            });
    </script>

    
</head>
<body>
    
     <?php

    
   if(isset($_SESSION['userName'])){ 
       
    ?>
   
    
    <nav class="navbar navbar-default container-fluid">
        
        <ul class="nav navbar-nav">
        <li><a href="profile.php"> Management</a> </li>
        <li><a href="home.php">  Home </a></li>
        </ul>
     <ul class="nav navbar-nav navbar-right">
         
            <li><a href="logout.php"><button type="submit" class="btn btn-danger" > Log Out </button></a>  </li> 
             
         </ul>
    
    
    </nav>
    
    <?php 
    
    $reqPr = "select * from user where id = ".$_GET['id'];
       
    $resPr = mysqli_query($con , $reqPr);
       
    if($rowPr = mysqli_fetch_assoc($resPr)){   
    
    ?>
    
    <div id="thumbnail" class="thumbnail">     
    
<a href="profileFr.php?id=<?php echo $rowPr['id'] ?>"><img alt=""  class="img-circle" src="images/<?php echo $rowPr['img_profile'] ?>"> </a>
        
    <div class="caption"> <strong> <?php echo  "<label>". strtoupper($rowPr['username'][0]);  echo  substr ($rowPr['username'] , 1 , 
                                                                                                               
    strlen($rowPr['username']))."</label>" ?></strong> 
 
        
        </div>
 
        
           

    
    </div>
    
    <div class="container-fluid">
    
        <?php  if($rowPr['username'] <> $_SESSION['userName']) { ?>
    
         <p> Send a message to <?php echo $rowPr['username']  ?> </p> 
    
    <form action="sendMsg.php" method="post" >
    
    <textarea class="form-control"cols="40" name="msg" style="resize:none;width:30%;" rows="4" > </textarea>  
        
        <input type="text" name="sender" hidden value="<?php  echo $_SESSION['userId'] ?>">
        
        <input type="text"  name="reciever"  hidden value="<?php  echo $rowPr['id'] ?>">
        
        
        <button class="form-control btn btn-primary" type="submit" style="width:30%" > Send </button>
    
        
        </form>
    </div>
   <?php }} ?> 
    
   <div class="row container-fluid" style="margin-top:70px">
       
    
       
<?php
    

$idFr = $_GET['id'];
    
    
$req = "select * from images i , user u  where i.id_user = u.id and id_user = ".$idFr." and i.image <> '' ORDER BY i.date DESC";
    
$res = mysqli_query($con , $req);
    
    if(mysqli_num_rows($res) > 0){   
       
while($row = mysqli_fetch_assoc($res)){
    
    
    
?>
     
    
        
    
        <div class="col-sm-3">
      <div class='thumbnail images'>
     
        
      <a href="allComments.php?id_img=<?php echo $row['id_img']  ?>"><img alt="" id="image" class="image" src='images/<?php echo $row['image'] ?>' ></a>	
          
           <?php $reqTest = "select * from img_liked where id_user = ". $_SESSION['userId'] . " and id_img = $row[id_img]";

$resTest = mysqli_query($con , $reqTest);

if(mysqli_num_rows($resTest) > 0 ){ 
          
   $image = "like.png";
    
    

}
    
    else{
        
        
        $image = "like1.png";
        
            
            
         } 
          ?>  
          <hr>
          
    <a href="like.php?id_img=<?php echo $row['id_img'] ?>&id_user=<?php echo $row['id_user']?>"> <img  id="like"  src="images/<?php echo $image ?>">  </a>
         
        <hr>  
          
         <?php 
              
               $reqLike = "select * from img_liked where id_img = ".$row['id_img'];
        
            $resLike = mysqli_query($con , $reqLike);
              
              
              
              $reqComm =
          
          "SELECT * from user u , img_comment imgc , images img WHERE u.id = imgc.id_user and img.id_img = imgc.id_img 
          
          and img.id_img = ".$row['id_img'];
          
    
        
        $resComm = mysqli_query($con , $reqComm);
        
        ?>
        
             <h6 style="margin-left:5%"> <?php echo mysqli_num_rows($resLike)." likes "  ?> 
                 
                <a href="allComments.php?id_img=<?php echo $row['id_img']  ?>">  <span style="margin-left:50%"><?php echo 
            
                mysqli_num_rows($resComm)." Comments "  ?></span> </a> </h6>
          <hr>
                        
     <label style="margin-left:5%;"><h6>Add a comment</h6></label>   
        
        <form method="get" action="comment.php" >
        
        <input type="text" hidden  value="<?php echo $row['id_img'] ?>" name="id_img">
            
        <input type="text" hidden value="<?php  echo $_SESSION['userId']  ?>" name="id_user">    
            
        <input type="text" hidden value="home" name="profileFr" >   
            
  <textarea  style="resize:none;" name="comment" id="comment" class="md-textarea form-control" rows="2">  </textarea>
        
           
        <button class="btn btn-link" type="submit" style="font-size:12px; font-weight:bold; margin-left:-10px; "  >  Post </button>
        
       
            </form>
          
          
    
    </div>
                
</div>
            
                <script>
    

        
        
    </script>
       
    <?php    
    
}  
       
  }
    
       
       else echo '<div class="alert alert-info well well-lg" style="text-align:center">No Post Yet </div>';
        
?>   
       
       
      
</div>

    
    
    
       <?php
    
       
    }
    
    else
      header("Location: login.php?trytologin");  
        
    ?>
    
    
    
</body>
</html>