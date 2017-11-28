<?php
	require_once '_config.php';
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username) || empty($password)){

			$error = "Không được để trống bất kỳ trường nào";
		}
		//Nếu không có lỗi
		if(!isset($error))
		{
			$query = "SELECT id,username,password FROM users WHERE username =:username";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(':username',$username);
			$stmt->execute();
			// Kiểm tra username có tồn tại hay k?
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			// var_dump($user);
			if($stmt->rowCount() > 0)
			{	
				if(md5($password)==$user['password'])
             	{
             		//Lưu tên đăng nhập
             		$_SESSION['username'] = $user['username'];
             		// Lưu id để update
             		$_SESSION['id'] = $user['id'];
                	header('Location:listUsers.php');
             	}
             	else
             	{
                	$error = "Password không đúng";
             	}
			}
			else
			{
				$error ="Username không tồn tại. Vui lòng kiểm tra lại";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Screen</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div align="center">
		<h1>Please Sign In</h1>
		<form action="#" method="post">
		<?php if(isset($error)): ?>
		<span style="color: red">Lỗi! <?php echo $error; ?></span>
		<?php endif ?>
		<table>
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="username">
				</td>

			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			
			<tr >
				<td></td>
				<td colspan="2" >
					<input style="margin-right: 30px;padding: 10px 15px;" type="submit" name="bt_register" value="Login">
					<input style="padding: 10px 20px;" type="reset" name="bt_reset" value="Reset">
				</td>
			</tr>
			<tr>
				<td>Create an account</td>
				<td>
					<a href="register.php">Register</a>
				</td>
			</tr>
			<tr>
				<td>List all Users</td>
				<td>
					<a href="listUsers.php">ListUsers</a>
				</td>
			</tr>
		</table>	
		</form>

	</div>
</body>
</html>