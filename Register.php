<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<title> User Registration</title>
		<link rel="stylesheet" type = "text/css" href="css/bootstrap.min.css">
	</head>
	<body>

<div>
	<?php 
	
		$con = mysqli_connect("localhost","root", "","inventory_system");
		if(isset($_POST['create'])){
			$username 	= $_POST['username'];
			$firstname 	= $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname 	= $_POST['lastname'];
			$password 	= $_POST['password'];
			
			$errors = array();

			$u = "SELECT userName FROM account WHERE userName = '$username'";
			$uu = mysqli_query($con,$u);
			

			if(empty($username)){
				$errors['u'] = "Username Required";
				
			}else if(mysqli_num_rows($uu) > 0)
				$errors['u'] = "Username Exists";
			

			
			
			if(count($errors)==0){
				
				$query = "INSERT INTO account(userName,firstName,middleName,lastName,passWord) VALUES('$username','$firstname','$middlename','$lastname','$password')";
				$result = mysqli_query($con,$query);

				if($result){
					echo "very nice";
				}
				else{
					echo "not very nice";
				}
			}

		}
	?>
</div>

<div>
	<form action ="Register.php" method="post">
		<div class="container">

		<div class="row">
			<div class="col-sm-3">
			<h1>Registration</h1>
			<p>Please Fill up</p>
			<hr class="mb-3"> 
				<label for="username"><b>Username</b></label>
				<input class="form-control" type = "text" name = "username" required>
				<p class="text-danger">	<?php if(isset($errors['u'])) echo $errors['u'];?>	</p>

				<label for="firstname"><b>First Name</b></label>
				<input class="form-control" type = "text" name = "firstname" requiredv>

				<label for="middlename"><b>Middle Name</b></label>
				<input class="form-control" type = "text" name = "middlename" required>

				<label for="lastname"><b>Last Name</b></label>
				<input class="form-control" type = "text" name = "lastname" required>

				<label for="password"><b>Password</b></label>
				<input class="form-control" type = "password" name = "password" required>
				<hr class="mb-3">
				<input class="btn btn-primary "type="submit" name="create" value="Register">
			</div>
		</div>
		</div>
	</form>
</div>


</body>
</html>

