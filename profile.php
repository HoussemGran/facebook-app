<?php

session_start();



    
$con = $con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet");    

?>

<!doctype html>
<html>
    
<head><link rel="icon" class="img-circle" type="image/jpg" href="images/user.png">    
    
<title><?php echo strtoupper($_SESSION['userName']) ?></title>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
<style>
    

    #pic{
        
    margin-top: 20px;    
        
    }
        
    body{
        
        
    background-color: #fafafa;    
        
    font-family: "Comic Sans MS";
    
        
    }
    
    
    #friends{
        
    padding-left: 250px;    
        
        
    }
    
    
    #upload{
        
        
    margin-top: 15px;    
        
    }
    
    
    
    #thumbnail{
        
        margin-top: -5%;
        background-color:  #fafafa;
        border: none;
        
      
        width: 20%;
        height: 20%;
        
    }
    
    .btn btn-danger{
        
        position: absolute;
        top: 1px;
        left: 100%;
        
        
    }    
    
    #profile{
        
        margin-top: 10px;
        
    }
  
    
       #img_profile{
        
    width: 30px;
    margin-left: 0px;    
        
    }
    
    #up{
        
    display: none;
        
    }
    
</style>    
          <script>
    
    $(function(){
        
       
    $("#thumbnail").animate({width: "40%"},"slow");    
    $("#thumbnail").animate({height: "40%"},"slow");    
        
    $("#profile").hide();
        
        document.querySelector("#btnup").addEventListener("click",function(){
            
        $("#profile").slideToggle();  
        $("#up").slideToggle();    
            
            
            
        });
        
        
            });
    
    
    </script>
    
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
<div class="container-fluid"> 
    
<div class="row">    
   
    
<div class="col-sm-4">

<?php 
    
$reqImg = "select * from user where id = ".$_SESSION['userId'];
$resImg = mysqli_query($con , $reqImg);            
$enreg = mysqli_fetch_assoc($resImg); 
       
?>  
<div id="thumbnail" class="thumbnail">     
    
<a href="profileFr.php?id=<?php echo $_SESSION['userId'] ?>"><img alt=""  class="img-circle" src="images/<?php echo $enreg['img_profile'] ?>"> </a><button class="btn btn-primary" id="btnup"> Change picture </button>
    
    <form method="post" id="up" action="updateImg.php" enctype="multipart/form-data">
  	     
    
     <input type="file" name="img" id="profile">
  	         
    
  		    <button type="submit" class="btn btn-primary form-control" id="upload" name="upload">Update</button>
    
    </form>
        
    <div class="caption"> <strong> <?php echo  "<label>". strtoupper($_SESSION['userName'][0]);  echo  substr 
        
    ($_SESSION['userName'] , 1 , strlen($_SESSION['userName']))."</label>" ?></strong>  </div>

    </div>
    
                        
</div>
<div class="col-sm-4" id="profile" >
    

    <?php
        
   

    
    if(isset($_POST['upload'])){
        
        if(!empty($_FILES['image']['name'])){  
        
        $date = date('Y-m-d H:i:s');
        
        $image = $_FILES['image']['name']; 
        
        $image_text = $_POST['image_text'];
        
        $target = "images/".basename($image);
        
        $sql = "INSERT INTO images (image, text , id_user , date) VALUES ('$image', '$image_text' ,".$_SESSION['userId']." , '$date')";
        
        mysqli_query($con, $sql);
    
        move_uploaded_file($_FILES['image']['tmp_name'], $target); 
            
  
        }else ?> <script >  document.getElementById('area').placeholder = " Please choose a picture" </script>
        
    <?php
    }
    
    
    
    $reqImg = "SELECT * FROM images where id_user = ".$_SESSION['userId']." ORDER BY images.date DESC";
    
    $result = mysqli_query($con, $reqImg);
    
   

    while ($row = mysqli_fetch_assoc($result)) {
        
             $reqLike = "select * from img_liked where id_img = ".$row['id_img'];
        
            $resLike = mysqli_query($con , $reqLike);
            
            $reqComm =
          
          "SELECT * from user u , img_comment imgc , images img WHERE u.id = imgc.id_user and img.id_img = imgc.id_img 
          
          and img.id_img = ".$row['id_img'];
          
    
        
        $resComm = mysqli_query($con , $reqComm);
        
        ?>
             
             
         
        
    <div id="pic" class='thumbnail'>
        
     <a href="deletePost.php?id=<?php  echo $row['id_img'] ?>"><span  style="color:red" class="glyphicon glyphicon-remove-circle"></a> </span>
        
         <h5><?php echo  "<h6>". substr($row['date'] , 0 , 10)."</h6><hr>" ?> </h5>
        
      	<img alt="" src='images/<?php echo $row['image'] ?>' >
         
         <div class='caption'>
      	
          <?php 
          
          
          if(strlen($row['text']) > 40){
          
            $max = 40;  
              
          for($i = 0 ; $i < strlen($row['text']) ; $i++){
              
            if($i ==  $max){echo "<br>"; $max += 40; }  
              
            echo "<strong>".$row['text'][$i]."</strong>" ;  
                
              
          }
          }
          
          
          
          
    else echo "<strong>".$row['text']."</strong><hr>" ?> 
        
             
           <h6> <?php echo mysqli_num_rows($resLike)." likes "  ?> 
             
               <a href="allComments.php?id_img=<?php echo $row['id_img']  ?>"><span style="margin-left:55%"><?php echo mysqli_num_rows($resComm)." Comments "  ?></span></a>  </h6>
             
            <hr>
             
          
             
             <table>
  
             <?php



             $reqComm =

                 "SELECT * from user u , img_comment imgc , images img WHERE u.id = imgc.id_user and img.id_img = imgc.id_img 

              and img.id_img = ".$row['id_img'];


            
             $resComm = mysqli_query($con , $reqComm);


             while($rowComm = mysqli_fetch_assoc($resComm)){

             $userName = $rowComm['username'];


             ?>


  <tr style="background-color:#f2f3f5;">
    
<td> <img class="img-circle" id="img_profile" src="images/<?php echo $rowComm['img_profile']  ?>"></td>
      
<td><a href="profileFr.php?id=<?php  echo $rowComm['id'] ?>"><?php echo "<strong id='user'>".$rowComm['username']."</strong>" ?> </a></td>
      
      
<td> <?php   echo  "<span style='padding:0px 30px;' >".$rowComm['img_comment']."</span>"  ?> </td>
                 
</tr>

        
    <tr>
                    
<td><a  style="margin-left:10%" href="delComment.php?id_comm=<?php  echo $rowComm['id_comment'] ?>"> delete </a><hr> </td>
                 
                 
     </tr>    
                 
                 <?php
                         
             }

             ?>
             </table>
         </div>
        
         <div>
    
    
    
    </div>
    
</div>
    
 <?php
    }
    
    ?>
    
</div>
    
<!-- <div class="col-sm-4" id="friends">
    
 <?php
       
    $reqfr = "select * from user where id <> ".$_SESSION['userId'];
       
    $resfr = mysqli_query($con , $reqfr);   
       


    
       echo "<h4> Friends :</h4><hr>";
       
    while($rowfr = mysqli_fetch_assoc($resfr)){
        
            
        echo "<h6><a href='profileFr.php?id=".$rowfr['id']."'> <span class='glyphicon glyphicon-user'></span> " .$rowfr['username']. "</a></h6><hr>";
        
    }   
    
       
       
    ?>    
    
</div>    
-->    
</div> 
    <?php
    }
    
    else
      header("Location: login.php?trytologin");  
        
    ?>
</body>
</html>