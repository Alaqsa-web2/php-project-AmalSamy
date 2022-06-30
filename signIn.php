<?php 
// Amal Samy Abo_Ouda
require 'config.php';


if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = ($_POST['password']);
	$nameimg = $_FILES['img']['name'];
    $temp = $_FILES['img']['tmp_name'];
    $arr = explode('.',$nameimg);
    $ext = end($arr);
    $current = getcwd()."\\image\\$nameimg";
   // echo $current;
   $sql = "SELECT email FROM users WHERE email='$email' AND password = '$password'";
   $result = mysqli_query($conn,$sql);
		if ($result->num_rows ==1) {
			while($row = $result->fetch_assoc()){
				header("Location: login.php");
			}

			}else{
				
				$sql2 = "insert into users (username, email, password , name_img)
				VALUES ('$username', '$email', '$password' , '$nameimg')";
				mysqli_query($conn,$sql2);
				if(move_uploaded_file($temp,$current)){
				$msg = "Image uploaded successfully";	
				}
				if ($result) {
					echo "<script>alert('Wow! User Registration Completed.')</script>";
					$username = "";
					$email = "";
					$password= $_POST['password'] = "";
					$nameimg = "";
					header("Location: login.php");

			}
		
			}
		

		
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form </title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email" enctype="multipart/form-data">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php  $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php $password; ?>" required>
            </div>

			<div class="input-group">
			<input type="file" name="img" require>
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>