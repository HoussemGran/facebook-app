<!doctype html>
<html>
<head><title>login</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
    
    <style>
    
        form{
            
        margin-top: 100px;    
            
            
        }
        
            body{
        
        
    background-color: #fafafa;    
        
    }
    
    </style>
    
</head>
<body>    

<div class="row container-fluid">    
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
<form method="post" action="login.php">
    
<label for="username"> Username </label><input type="text" class="form-control" id="username" name="username" ><br>
<label for="password"> Passowrd </label><input type="password" class="form-control" id="password" name="password"><br>
<button type="submit" class="btn btn-primary" name="login"> login </button>
<button class="btn btn-danger" type="reset">Reset</button>   
<a href="register.php">Register now ! </a>    
    
</form>      
</div>        
<div class="col-sm-4"></div>
</div>    
    
<?php

    
if(isset($_POST['login'])){
    
    
    include("connection.php");
    
    $username = $_POST['username'];
    $password = $_POST['password'];    
    
	
    
    $req1 = "select * from user where username = '$username' and password = '$password' ";
    
    $res1 = mysqli_query($con , $req1);
    
    if(mysqli_num_rows($res1) > 0){
        
    session_start();
        

    while($row = mysqli_fetch_assoc($res1)){    
        
     $_SESSION['userName'] = $username;    
     
     $_SESSION['userId']  = $row['id'];   
        
     $_SESSION['profilePic'] = $row['img_profile'];
        
        
        }
        
       header("Location: home.php");     
        
    }
       
    else{
        
    header("Location: login.php?user=notExiste");
       
        
        
    }
    
}    
    
    
?>
    
</body>    
</html>
    