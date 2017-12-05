<?php
	require_once '_config.php';
	$query = "SELECT * FROM users";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Phan trang 
	$totalRecords = $stmt->rowCount();
	$recordPerPage = 2;
	$totalPage = ceil($totalRecords/$recordPerPage);
	// Tính $offset
	if(isset($_GET['page'])){
	$currentPage= $_GET['page'];
	} else $currentPage = 1;
	$offset = ($currentPage-1)*$recordPerPage;
	$limit = "LIMIT $offset,$recordPerPage";
	$query = "SELECT * FROM users ".$limit; 
	$result = $conn->prepare($query);
	$result->execute();
	$user = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Basic Screen</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
	<div align="center">
		<a href="login.php" style ="margin-right: 10px;">Login </a>
		<a href="register.php" style ="margin-left: 10px;">Register</a>
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
	<div class="pagination">
  <?php
    // PHẦN HIỂN THỊ PHÂN TRANG
 
    // Button trang trước
    if($currentPage > 1 && $totalPage > 0){
    echo '<a href="./listUsers.php?page='.($currentPage-1).'">&larr;</a>';
    }
    // Danh sách trang
    for($i=1; $i<=$totalPage; $i++){
    	echo "<a href='./listUsers.php?page=$i'>".' '.$i."</a>";
    }
 
    // Button trang kế tiếp
    if($currentPage < $totalPage && $totalPage > 1){
    echo '<a href="./listUsers.php?page='.($currentPage+1).'">&rarr;</a>';
    }
  ?>
</div>
</body>
</html>
