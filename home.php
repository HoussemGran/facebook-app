<?php

session_start();
    
include("connection.php");



?>

<!doctype html>
<html>
    
<head>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
  </script>
    
<link rel="icon" class="img-circle" type="image/jpg" href="images/internet.png" >    
    
<title>HOME</title>

   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
    



    .comm{
        
    background-color:#eaeaea ;
        border-radius: 10px;

        padding: 5px 5px;
        
    }
    
    #img_profile{
        
    width: 40px;
    margin-left: 0px;    
        
    }

</style>    

<script>

$(document).ready(function(){


$("#like").click(function(){

// Ajax

});        



});



</script>


    
      <script>
    
    $(function(){
        
        
    $("#thumbnail").animate({width: "40%"},"slow");    
    $("#thumbnail").animate({height: "40%"},"slow");    
        
        
        
            });
    
    
    </script>
    
</head>    
<body>


<?





?>

<div class="container-fluid"> 
    
<div class="row">    
 
    
<div class="col-sm-4">

<a href="profileFr.php?id=<?php  echo  $_SESSION['userId'] ?>">
    
<div id="thumbnail" class="thumbnail">     
    
<?php 
    
$reqImg = "select * from user where id = ".$_SESSION['userId'];
$resImg = mysqli_query($con , $reqImg);            
$enreg = mysqli_fetch_assoc($resImg); 
       
?>    
    
<img alt="" class="img-circle" src="images/<?php echo $enreg['img_profile'] ?>"> </a>
                                    
    <div class="caption"> <strong> <?php echo  "<label>". strtoupper($_SESSION['userName'][0]);  echo  substr ($_SESSION['userName'] , 1 , strlen($_SESSION['userName']))."</label>" ?></strong>  </div>
  	
</div>
    
   
    
</div>
    
    
<div class="col-sm-4" id="profile" >
    
<form method="POST" action="home.php" enctype="multipart/form-data">
    
  	
  	
  	  <input type="file" class="form-control" name="image">
  	
  	
      <textarea style="resize:none;" id="area" class="form-control" 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="what's on your mind <?php echo $_SESSION['userName'] ?> ..."></textarea>
  	
  	
  		    <button type="submit"  class="btn btn-primary form-control" id="upload" name="upload">Share</button>




  </form>
    
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
                
  }
        
        else ?> <script >  document.getElementById('area').placeholder = " Please choose a picture" </script>
        
    <?php
        
    }
    
    
    
    $reqImg = "SELECT * FROM images i , user u  where i.id_user = u.id order by i.date desc";
    
    $result = mysqli_query($con, $reqImg);
    
   

    while ($row = mysqli_fetch_assoc($result)) {
        
      
        
      ?>
    <div id="pic" class='thumbnail'>
        
     
        
   <a href="profileFr.php?id=<?php  echo $row['id_user'] ?>">  <img class="img-circle" id="img_profile" src="images/<?php echo $row['img_profile']  ?>"> <strong> <?php echo  ($row['username'])."<hr>"   ?> </strong></a>  
        
         <h5><?php  echo  "<h6>". substr($row['date'] , 0 , 10)."</h6><hr>" ?> </h5>
        
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
             
            
             
     <a href="like.php?id_img=<?php echo $row['id_img'] ?>&id_user=<?php echo $row['id_user'] ?>&loc=home">
          
       
             
        <?php $reqTest = "select * from img_liked where id_user = ". $_SESSION['userId'] . " and id_img = $row[id_img]";

$resTest = mysqli_query($con , $reqTest);

if(mysqli_num_rows($resTest) > 0 ){ 
          
   $image = "like.png";
    
    

}
    
    else{
        
        
        $image = "like1.png";
        
                                                                                                                                                
        
         } 
          ?>  
          
          
       <img  id="like"  src="images/<?php echo $image ?>"></a>
                                                       
     
        
           
             
             
        
      <?php  

                                                
            
            $reqLike = "select * from img_liked where id_img = ".$row['id_img'];
        
            $resLike = mysqli_query($con , $reqLike);
              
            $reqComm =
          
          "SELECT * from user u , img_comment imgc , images img WHERE u.id = imgc.id_user and img.id_img = imgc.id_img 
          
          and img.id_img = ".$row['id_img'];
          
    
        
        $resComm = mysqli_query($con , $reqComm);
        
        ?>
        
             <h6 style="margin-left:10%"> <?php echo mysqli_num_rows($resLike)." likes "  ?> 
                 
                 <a href="allComments.php?id_img=<?php echo $row['id_img']  ?>">   <span style="margin-left:50%"><?php echo 
            
                
                mysqli_num_rows($resComm)." Comments "  ?></span> </a> </h6><hr> 
                
        
        <!-- comment  -->
        

       
        
     <label> <strong><h6>Add a comment</h6></strong></label>   
        
         <form method="get" action="comment.php" >

        <input type="text" hidden  value="<?php echo $row['id_img'] ?>" name="id_img">

        <input type="text" hidden value="<?php  echo $_SESSION['userId']  ?>" name="id_user">

        <input type="text" hidden value="home" name="loc" >
            
  <textarea  style="resize:none;"  name="comment" id="comment" class="md-textarea form-control" rows="2">  </textarea>
        
           
        <button class="btn btn-link" id="btnPost"  style="font-size:12px; font-weight:bold; margin-left:-10px; "  >  Post </button>

         <!--   <script>


                $(document).ready(function () {


                    $("#btnPost").click(function () {

                     $.post("comment.php" , {

                        id_img : <?php //echo $row['id_img'] ?>,

                        id_user : <?php  //echo $_SESSION['userId']  ?>,

                        comment : document.querySelector("#comment").value

                    },);



                    });



                });



            </script> -->





      </form>

                 
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
       


    
       echo "<h4> Friends </h4><hr>";
       
    while($rowfr = mysqli_fetch_assoc($resfr)){
        
       
            
 
    echo "<h6><a href='profileFr.php?id=".$rowfr['id']."'> <span class='glyphicon glyphicon-user'></span> " .$rowfr['username']. "</a>
    </h6><hr>";
        
    }   
    
       
       
    ?>    
    
</div>    
-->

</div> 
</body>
</html>