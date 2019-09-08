<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>header</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<?php

include "header.php";

if (isset($_POST['submit'])){

$servername = "localhost";
$username = "root";
$password = "nor0136655";

$name = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$message=" ";


try {
    $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if( empty($_POST['username']) || empty($_POST['email']) || 
        empty($_POST['pass']) || empty($_POST['pass2'])){
          $message="Please fillout all required fields";

        
        }
        else if($_POST['pass'] !== $_POST['pass2']){
          $message="Password doesn't match";
        }
        else {
    $sql = "INSERT INTO users (username, email,password ) values ('$name','$email','$pass')";
    $conn-> exec($sql);
   // echo "Connected successfully"; 
   $message= "create successfully";
        }
    }
catch(PDOException $e)
    {
      $message= "Connection failed: " . $e->getMessage();
    }
  }
  $conn = null;
?>


<form class=" w-50 m-auto" method="post">
<h2 class="text-center">Signup Page</h2>
  <div class="form-group ">
    <label for="exampleInputEmail1">User Name</label>
    <input type="userName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username...." name="username">
    
  </div>
  <div class="form-group ">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email..." name="email">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password..." name="pass">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="verify Password" name="pass2">
  </div>
  
  <button type="submit" class="btn btn-primary " name="submit">Submit</button>
</form>



<div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?> 
</div>



<?php


include "footer.php";
?>

    
</body>
</html>