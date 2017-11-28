<?php
	session_start();
	require_once '_config.php';
	$query = "SELECT * FROM users";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($user);
?>
<!DOCTYPE html>
<html>
<head>
	<title>List Users Screen</title>
	<style type="text/css">
		h3 {
			display: inline;
			color: green;
			margin: 20px 40px;
		}
		h1{
			padding: 20px 20px;
		}
		.account{
			display: inline;
			/*margin-right: 800px;*/
		}
		h3 a {
			display: inline;
			color: green;
			text-decoration: none;
			margin: 15px;
		}
		table, th, td {
    	border: 1px solid black;
    	border-collapse: collapse;
    	padding: 10px 20px;
	}
	</style>

</head>
<body>
	<h3>
		 
			<?php 
				if (isset($_SESSION['username'])){
					echo "Welcome ".$_SESSION['username'];
					?>
					<div class="account" style="margin-left: 700px;">
						<?php
					echo "<a href='logout.php'>Logout</a>";
					echo "<a href='updateProfile.php'>Update Profile</a>";
				}
				
			?>
					</div>
					

		</h3>

	<div align="center">
		
		<h1 >DANH SÁCH CÁC TÀI KHOẢN</h1>
		<table>
			<tr>
					<th>Id</th>
					<th>Avatar</th>
					<th>Username</th>
					<th>Fullname</th>
					<th>Email</th>
			</tr>
			 <?php foreach ($user as $users) {
			  ?>
			<tr>
				<td><?php echo($users['id']) ?></td>
				<td> <img src="<?php echo ($users['avatar']) ?>" width="150px" height="150px"></td>
				<td><?php echo ($users['username']) ?></td>
				<td><?php echo ($users['fullname']) ?></td>
				<td><?php echo ($users['email']) ?></td>
			</tr>
			 <?php } ?>
		</table>
		
	</div>
</body>
</html>