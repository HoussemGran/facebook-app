<?php

session_start();

include("connection.php");

?>

<!DOCTYPE html>
<html>
<head>
<title></title>
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
          
     <?php
          
     $reqMsg = "select * from messages where id_reciever = ".$_SESSION['userId'];
    
    $resMsg = mysqli_query($con , $reqMsg);
    
          
     ?>
          
          
          
          
      <li>
      <a href="showMsg.php?id_reciever=

      <?php  echo $_SESSION['userId'] ?>">Messages <span class="badge">
      <?php  echo mysqli_num_rows($resMsg) ?> </span>
      
        </a>
        </li>
          
         <li><a href="logout.php"><button type="submit" class="btn btn-danger" > Log Out </button></a>  </li> 
          
          
                         
      </ul>
 
 </nav>

<?php

}
    else
          header("Location: login.php?trytologin");  

      ?>
</body>

</html>

