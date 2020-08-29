<?php  

session_start();

include(connection.php);
    
$con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet");    


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title></title>    
    
    
<style>
    
    
    
    body{
        
        
    background-color: #fafafa;    
        
    font-family: "Comic Sans MS";
        
        
    }
    
  
    img{
        
    width: 30px;    
        
        
    }
    
</style>    
    
</head>

<body>
    
<?php  if(isset($_SESSION['userId'])){ ?>    
       
     <nav class="navbar navbar-default container-fluid">
        
        <ul class="nav navbar-nav">
        <li><a href="profile.php"> Management </a> </li>
        <li><a href="home.php">  Home </a></li>
        </ul>
         <ul class="nav navbar-nav navbar-right">
             
        <?php
             
    
    
        $reqMsg = "select * from messages where id_reciever = ".$_SESSION['userId'];
       
       $resMsg = mysqli_query($con , $reqMsg);
       
             
        ?>
             
             
             
             
         <li><a href="showMsg.php?id_reciever=<?php  echo $_SESSION['userId'] ?>">  Messages <span class="badge"> <?php  echo mysqli_num_rows($resMsg) ?> </span> </a></li>
             
            <li><a href="logout.php"><button type="submit" class="btn btn-danger" > Log Out </button></a>  </li> 
             
             
                            
         </ul>
    
    </nav>
    
    <div class="row container-fluid">
        <div class="col-md-4"></div>
    <div class="col-md-4">
    
<table class="table table-bordered">        
<?php
    
    
$req = "select * from messages m , user u where m.id_sender = u.id  and id_reciever = ".$_SESSION['userId'];
    
$res = mysqli_query($con , $req);
    
    
while($row = mysqli_fetch_assoc($res)){
    
?>    
    
<tr><td> <img class="img-circle" src="images/<?php echo $row['img_profile']  ?>"> </td><td> <a href="profileFr.php?id=<?php  echo $row['id']  ?>"><?php  echo $row['username']."  " ?></a> </td> <td> <?php  echo $row['msg_txt'] ?> </td> <td> <?php  echo substr($row['date'] , 0 , 16) ?> </td></tr>   

<?php
    
}    
    
    
?>    
</table>     
   
    <?php }else
    
    header("Location: login.php");
    
    ?>
        </div>
        <div class="col-md-4"></div>
    </div>      
 </body>    
    
    
</html>