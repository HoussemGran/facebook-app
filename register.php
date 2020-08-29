

<!doctype html>
<html>
<head>
    
<title>  register </title>    

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
        
<form method="post" action="register.php" enctype="multipart/form-data">
    
<label for="username"> Username </label><input type="text" class="form-control" id="username" name="username" ><br>
    
<label for="email"> Email </label><input type="email" class="form-control" id="email" name="email"><br>
    
<label for="password"> Passowrd </label><input type="password" class="form-control" id="password" name="password"><br>
    

    
<label> Choose Your Profile Picture </label>  <input type="file" class="form-control" name="imageProfile"><br>
   
    

    
    
<button type="submit" class="btn btn-primary" name="submit"> Register </button>

<button class="btn btn-danger" type="reset">Reset</button>  
    
    <a href="login.php">LogIn now !  </a>  
    
</form>      
</div>        
<div class="col-sm-4"></div>
</div>    
    
    
<?php
    

    if(isset($_POST['submit'])){
    
      
        
        $con = mysqli_connect("localhost" , "root" ,"houssem0123" , "projet");
        
        
        $image = $_FILES['imageProfile']['name']; 
        
        $target = "images/".basename($image);
    
        $username = $_POST['username'];
        
        $email = $_POST['email'];
        
        $password = $_POST['password'];
    
    
        $req2 = "select * from user where username = '$username'";
        
        $res2 = mysqli_query($con , $req2);
        
    
    if(mysqli_num_rows($res2) == 0){    
    
    
    $req1 = "insert into user (username , email , password , img_profile) values  ('$username' , '$email' , '$password' , '$image')";
        
    $res1 = mysqli_query($con , $req1);
        
        
        move_uploaded_file($_FILES['imageProfile']['tmp_name'], $target);
            
  		
  	
    if($res1)
        header("Location: login.php?register=success");
        
    else
        header("Location: register.php?register=failed");
        
    }
    
       
          
        
    }
    
    
    
        
?>    
    
    
    
</body>
    
    


</html>