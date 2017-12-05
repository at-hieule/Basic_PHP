<?php
	require_once ('_config.php');
	//session_start();
	if(isset($_POST['bt_register']))
	{
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(empty($username) || empty($password) || empty($fullname) || empty($email))
		{
			$error = "Please fill out all fields";
		}
		else
		{
			if(strlen($username) < 6){
				$error ="Username must be at least 6 character";
			} 
			
			if(strlen($password) < 6){
				$error ="Password must be at least 6 character";
			} 
		}
		
		if(is_numeric($fullname)){
			$error = "Fullname invalid. Fullname must be character";
		}
		if (!isset($error)) {

			$query = "SELECT username from users WHERE username ='$username'" ; 
			$stmt = $conn->prepare($query);
			$stmt->execute();

			 if($stmt->rowCount()){
			 	$error ="Username does exist. Please try again new username";
			 }
			 else{

			 	$password = md5($password);
			 	$sql = "INSERT INTO users (username,fullname,email,password,avatar) 
			 	VALUES ('$username','$fullname','$email','$password','upload/default.png')";
			 	$stmt = $conn->prepare($sql);
				if ($stmt->execute()){
					header('location:login.php');
				}			
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Screen</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div align="center">
		<h1>Please Sign up</h1>
		

		<form action="" method="POST">
		<?php if(isset($error)): ?>
		<span style="color: red">Error! <?php echo $error; ?></span>
		<?php endif ?>
		<table>
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="username" placeholder="Input username">
				</td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td>
					<input type="text" name="fullname" placeholder="Input fullname">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="email" placeholder="Input email">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password" placeholder="Input password">
				</td>
			</tr>
			
			<tr >
				<td></td>
				<td colspan="2" >
					<input style="margin-right: 30px;padding: 10px 15px;" type="submit" name="bt_register" value="Register">
					<input style="padding: 10px 20px;" type="reset" name="bt_reset" value="Reset">
				</td>
			</tr>
			<tr>
				<td>Already a member?</td>
				<td>
					<a href="login.php">Login</a>
				</td>
			</tr>
		</table>	
		</form>
	</div>
</body>
</html>
