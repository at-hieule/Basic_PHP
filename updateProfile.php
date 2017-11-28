<?php 
	session_start();
	require_once '_config.php';

	if (isset($_SESSION['username'])){
    	//thực hiện việc lấy thông tin user
		$id = $_SESSION['id'];
    	$query = "SELECT * FROM users WHERE id = :id";
		$stmt = $conn->prepare($query);
		$stmt->bindValue(':id',$id);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
    	// var_dump($user);

    	// Nhận dữ liệu từ form khi nhấn bt Uapdate	
    	if(isset($_POST['bt_update'])){

    		$target_dir = __DIR__."/upload/";
			$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    		$username = $_POST['username'];
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
  			// upload file
  			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
    		$error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				}
					move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
			$query = "UPDATE users set username ='$username',fullname='$fullname',email='$email',password ='$password',avatar = '$target_file' WHERE id =:id" ; 
			$stmt = $conn->prepare($query);
			$stmt->bindValue(':id',$id);
			$user = $stmt->execute();
			if($user)
			{
				$error = "Success! Your data has been update";

			}
			else {
				echo "Error uodating data, please try again";
			}
    	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update profile Screen</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	
<body>
	<div align="center">
		
	<h1>Update Profile</h1>
	<form action="#" method="POST" enctype="multipart/form-data">
		<?php if(isset($error)): ?>
		<span style="color: green"><?php echo $error; ?></span>
		<?php endif ?>
	<table>
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="username" value="<?php echo ($user['username']) ?>" >
				</td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td>
					<input type="text" name="fullname" value="<?php echo ($user['fullname']) ?>"  >
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="email" value="<?php echo ($user['email']) ?>" >
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td>Upload Avatar</td>
				<td>
					<input type="file" name="avatar">
				</td>
			</tr>
			<tr >
				<td></td>
				<td colspan="2" > 

					<!-- thực hiện update -->
					<input style="margin-right: 30px;padding: 10px 15px;" type="submit" name="bt_update" value="Update">

					<!-- Hủy bỏ update,quay lại trang list all users -->
					<?php if(!isset($_POST['bt_update'])): ?>
					<input style="padding: 10px 20px;" type="button" onclick="location.href='http://domain1.dev/listUsers.php';" name="bt_cancel" value="Cancel">
					<?php endif ?>
					<!-- Update thành công quay lại trang đăng nhập -->
					<?php if(isset($error)): ?>

					<input style="padding: 10px 20px;" type="button" onclick="location.href='login.php';" name="bt_cancel" value="Back">
					<?php endif ?>
				</td>
			</tr>
			
		</table>	
		</form>
		</div>
</body>
</html>
