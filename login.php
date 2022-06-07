<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start(); 

	$sname= "localhost";
	$username= "root";
	$password = "";
	$db_name = "inventory_system";

	$conn = mysqli_connect($sname, $username, $password, $db_name);

	if (!$conn) {
		echo "Connection failed!";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<style>
		body {
			background: #e3f2ff;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			flex-direction: column;
		}

		*{
			font-family: 'Courier New', Courier, monospace;
			box-sizing: border-box;
		}

		form {
			width: 500px;
			border: 2px solid #ccc;
			padding: 30px;
			background: #fff;
			border-radius: 15px;
		}

		h1 {
			text-align: center;
			margin-bottom: 40px;
		}

		input {
			display: block;
			border: 2px solid #ccc;
			width: 95%;
			padding: 10px;
			margin: 10px auto;
			border-radius: 5px;
		}
		label {
			color: #888;
			font-size: 18px;
			padding: 10px;
		}

		button {
			float: right;
			background: #5f9cd2;
			padding: 10px 15px;
			color: #fff;
			border-radius: 5px;
			margin-right: 10px;
			border: none;
		}
		button:hover{
			opacity: .7;
		}
		.error {
			background: #F2DEDE;
			color: #A94442;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		.success{
			background: #DFF0D8;
			color: #3C763D;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		h2 {
			text-align: center;
			color: #fff;
		}

		.extra-buttons{
			display: flex;
			flex-direction: column;
		}

		.extra-buttons a {
			margin-top: 15px;
		}
	</style>
	<h1>INVENTORY SYSTEM</h1>
</head>
<body>
																	 <!-- check to display none or block if GET Response is set -->
	<form action="" method="post" id="loginForm" style="display: <?= isset($_GET['forgot_password_error']) ? 'none' : 'block'; ?>">
		<h1>LOGIN</h1>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
			<p class="success"><?php echo $_GET['success']; ?></p>
		<?php } ?>
		<label>Username</label>
		<input type="text" name="username" placeholder="Username"><br>
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>
			
		<button type="submit">Login</button>
		<div class="extra-buttons">
			<a href="">Create Account</a>
			<a href="" id="forgotPasswordBtn">Forgot Password</a>
		</div>
	</form>

																			<!-- check to display none or block if GET Response is set -->
	<form action="" method="post" id="forgotPasswordForm" style="display: <?= isset($_GET['forgot_password_error']) ? 'block' : 'none'; ?>">
		<h1>Forgot Password</h1>
		<?php if (isset($_GET['forgot_password_error'])) { ?>
			<p class="error"><?php echo $_GET['forgot_password_error']; ?></p>
		<?php } ?>
		<label>Username</label>
		<input type="text" name="username" placeholder="Username"><br>
		<label>Old Password</label>
		<input type="password" name="old_password" placeholder="Old Password"><br>
		<label>New Password</label>
		<input type="password" name="new_password" placeholder="New Password"><br>
			
		<button type="submit">Change Password</button>
		<div class="extra-buttons">
			<a href="">Create Account</a>
			<a href="" id="backBtn"><- Back</a>
		</div>
	</form>

	<script type="text/javascript">
		// for interactive Ui change forms
		var loginForm = document.getElementById('loginForm');
		var forgotPasswordForm = document.getElementById('forgotPasswordForm');

		document.getElementById('forgotPasswordBtn').onclick = function(e) {
			e.preventDefault(); // prevent refreshing page on click of forgot password button
			loginForm.style.display = 'none';
			forgotPasswordForm.style.display = 'block';
		}

		document.getElementById('backBtn').onclick = function(e) {
			e.preventDefault(); // prevent refreshing page on click of back button
			loginForm.style.display = 'block';
			forgotPasswordForm.style.display = 'none';
		}
	</script>
</body>
</html>

<?php
	// this function will sanitize the input
	function filterInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// if only the forgot password form is submitted
	if(isset($_POST['username']) && isset($_POST['old_password']) && isset($_POST['new_password'])){
		$username = filterInput($_POST['username']);
		$old_password = filterInput($_POST['old_password']);
		$new_password = filterInput($_POST['new_password']);

		try {
			// SQL query to check if the username and old_password is correct
			$sql = "SELECT * FROM account_old_passwords WHERE userName = '$username' AND old_password = '$old_password'";
			$result = mysqli_query($conn, $sql);
			// if the username and old_password is correct
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result); // fetch the row
				// update the two tables with new password
				$sql = "UPDATE account_old_passwords AP, account A  SET AP.old_password = '$new_password', A.passWord ='$new_password' WHERE AP.userName = A.userName AND AP.userName = '$username'";
				$result = mysqli_query($conn, $sql);
				// if the update is successful
				if($result){
					// delete the old password from the old_passwords table
					$sqlDelete = "DELETE FROM authentication_attempts WHERE userName = '$username'";
					$resultDelete = mysqli_query($conn, $sqlDelete);
					
					// redirect to login page with success message
					header("Location: ?success=Sucessfully changed password");
					exit();
				}
				
			} else {
				// if the username and old_password is not correct
				header("Location: ?forgot_password_error=Wrong old password");
				exit();
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	// if only the login form is submitted
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = filterInput($_POST['username']);
		$password = filterInput($_POST['password']);

		// if the username is emtpy
		if (empty($username)) {
			// redirect to login page with error message
			header("Location: login.php?error=Username is required");
			exit();
		}else if(empty($password)){ // if the password is empty
			// redirect to login page with error message
			header("Location: login.php?error=Password is required");
			exit();
		}else{
			try {
				// SQL query to check if the username and password is correct
				$sql = "SELECT userName, role FROM account WHERE userName='$username' AND passWord='$password'";
				$result = mysqli_query($conn, $sql);

				// inner join to get the role of the user from the account table and check if the username is correlated
				$attemptSql = "SELECT COUNT(AA.userName) as total_attempts, A.role FROM authentication_attempts AA INNER JOIN account A ON A.userName = AA.userName WHERE A.userName='$username'";
				$attempResult = mysqli_fetch_assoc(mysqli_query($conn, $attemptSql)); // fetch the row

				// count the number of attempts
				if($attempResult['total_attempts'] >= 2){
					// if the number of attempts is greater than 2
					header("Location: ?error={$attempResult['role']} System: You have exceeded the maximum number of attempts to unknown user please redirect to the forgot password page");
					exit();
				} else {
					// if the number of attempts is less than 2
					if (mysqli_num_rows($result) === 1) {
						$row = mysqli_fetch_assoc($result);
						// identify the role type for page destination
						if($row['role'] === 'Staff'){
							echo "Logged in as Staff!";
							$_SESSION['username'] = $row['userName'];
							$_SESSION['role'] = $row['role'];
							
							// change the location to the identified role page
							header("Location: staffDashboard.php"); // the home.php is just an example of the redirecting page
							exit();
						} else {
							echo "Logged in as Supplier!";
							$_SESSION['username'] = $row['userName'];
							$_SESSION['role'] = $row['role'];
	
							// change the location to the identified role page
							header("Location: supplierDashboard.php"); // the home.php is just an example of the redirecting page
							exit();
						}
					} else { // if error to login in the account requested by the user then create record the log in attempt
						try{
							$dateNow = date('Y-m-d H:i:s');
							$sql = "INSERT INTO authentication_attempts (userName, date_attempt) VALUES ('$username', '$dateNow')";
							$result = mysqli_query($conn, $sql);
						} catch (Exception $e) {
							echo "Error: " . $e->getMessage();
						}
						header("Location: ?error=Incorect Username or Password");
						exit();
					}
				}
				
			} catch (Exception $e) {
				echo "Error: ".$e->getMessage();
			}
		}
		
	}else{
		exit();
	}
?>
