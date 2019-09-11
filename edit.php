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

if (isset($_POST['update'])){

$servername = "localhost";
$username = "root";
$password = "nor0136655";


$message=" ";


try {
    $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id = $_GET['ID'];
    $sql = 'SELECT * FROM users WHERE id=:ID';
    $statement = $conn->prepare($sql);
    $statement->execute([':ID' => $id ]);
    $users = $statement->fetch(PDO::FETCH_OBJ);
    if (isset ($_POST['username'])  && isset($_POST['email'])  && isset($_POST['password']) ) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $sql = 'UPDATE users SET username=:username, email=:email, password=:password  WHERE id=:ID';
      $statement = $conn->prepare($sql);
      if ($statement->execute([':name' => $name, ':email' => $email, ':password'=> $password,':id' => $id])) {
        header("Location: dashboard.php");
      }
    }
    
}
catch(PDOException $e)
    {
        $message= "Connection failed: " . $e->getMessage();
    }
  }
  $conn = null;


?>


<div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger text-center">'.$message.'</label>';  
                }  
                ?>  
</div>


			
			<form class=" w-50 m-auto"  method="POST">
            <h3 class="text-center">Edit User</h3> 
				
				<label for="firstname">User Name:</label>
				<input type="text" id="username"  name="username" value="<?=$users->username; ?>" class="form-control"><br>
				<label for="lastname">Email:</label>
				<input type="text"  name="email" id="email" value="<?= $users->email; ?>" class="form-control"><br>
				<label for="address">Password:</label>
				<input type="text"  name="password" id="password" value="<?= $users->password; ?>" class="form-control"><br>
				
				<input type="submit" name="update" class="btn btn-success" value="Update">
                <a type="submit" name="cancle" class="btn btn-danger" value="Cancle" href="dashboard.php" >Cancle</a>
			</form>
		</div>
	</div>
</div>
</div>







<?php


include "footer.php";
?>

    
</body>
</html>