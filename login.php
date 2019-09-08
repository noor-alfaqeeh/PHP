<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>First PHP</title>

</head>
<body>

<?php

 include "header.php";
/*session_start();

$users=array(
     array (
        "name" => "noor",
        "user-name" => "noor",
        "password" => 12345,
        "role" => "admin",
    ),

     array (
        "name" => "rula",
        "user-name" => "rula",
        "password" => 14789,
        "role" => "user"
    ),

     array (
        "name" => "asma",
        "user-name" => "asma",
        "password" => 789654,
        "role" => "user"
    ),

     array (
        "name" => "rana",
        "user-name" => "rana",
        "password" => 78963,
        "role" => "user"
    ));

    $username=$_POST['user'];
    $password=$_POST['password'];
    $role=$_POST['role'];


    foreach($users as $key => $user){
        if ($user['user-name']==$username and $user['password']==$password){
            if ($user['role']=="admin"){
              $_SESSION['username'] = $user['name'];
                header("Location: dashboard.php");
            }
            else if ($user['role']=="user"){
              $_SESSION['username'] = $user['name'];
                header("Location: home.php");
            }
        }
    
     
    } */

?>

<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "nor0136655";
$message=" ";

try {
  $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  if (isset($_POST["login"]))
  {
    if (empty($_POST['username']) || empty($_POST['password']))
    {
       $message = "<label>All fields are required</label>";
    }

    else 
    {
      $query= "SELECT * FROM  users WHERE username =:username AND password = :password";
      $stmt=$conn -> prepare($query);
      $stmt -> execute(
          array (
            'username' => $_POST["username"],
            'password' => $_POST["password"]
          )
      );

      $count = $stmt -> rowCount();
      if ($count >0)
      { 
        $row= $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION["username"] = $_POST["username"];
        $_SESSION["role"] = $row["role"];
        if($_SESSION["role"]=="User"){
        header ("location: home.php");
      }

        else
        {
          header ("location: dashboard.php");
        }
      }
      else 
      {
        $message = "<label>Wrong Data</label>";
      }

    }
  }

  }
catch(PDOException $error)
  {
  $message = $error->getMessage();
  }

?>

    
<div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
</div>

<form class=" w-50 m-auto" method="post" >
<h2 class="text-center">Login Page</h2>
  <div class="form-group ">
    <label for="exampleInputEmail1">User Name</label>
    <input type="userName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="username" name="username">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
                <div class="text-center">
  <p>Don't have an account?  <a href="signup.php">Create Account</a></p> 
  <button type="submit" class="btn btn-primary" name="login" value="login">Submit</button>
                </div>
</form>



<?php


include "footer.php";
?>
    
</body>
</html>