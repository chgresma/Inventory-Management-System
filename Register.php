
<!DOCTYPE html>
<html>
	<head>
		<title> User Registration</title>
		<link rel="stylesheet" type = "text/css" href="css/bootstrap.min.css">
	</head>
	<body>

<div>
	<?php 
		$invalid = 0;
		$norole = 0;
		$con = mysqli_connect("localhost","root", "","inventory_system");
		$result = $con->query("SELECT Rolenames FROM roles");
		if(isset($_POST['create'])){
			$username 	= $_POST['username'];
			$firstname 	= $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname 	= $_POST['lastname'];
			$password 	= $_POST['password'];
			$role       = $_POST['role'];
			$cpassword  = $_POST['cpassword'];
			
			
			
			$errors = array();

			$u = "SELECT userName FROM account WHERE userName = '$username'";
			$uu = mysqli_query($con,$u);

			
			

			if(empty($username)){
				$errors['u'] = "Username Required";
				
			}else if(mysqli_num_rows($uu) > 0)
				$errors['u'] = "Username Exists";
			
			if(count($errors)==0){
				if($password === $cpassword && $role != "0"){

					$query = "INSERT INTO account(userName,firstName,middleName,lastName,passWord,role) VALUES('$username','$firstname','$middlename','$lastname','$password','$role')";
					$result = mysqli_query($con,$query);

					if($result){
						echo "Registered";
						if($role === 'Staff'){
							header("Location: staffDashboard.php");
							$query = "INSERT INTO staff(userName) VALUES('$username')";
							$result = mysqli_query($con,$query);
							exit();
							}

						else if($role === 'Supplier'){
							header("Location: supplierDashboard.php");
							$query = "INSERT INTO supplier(userName) VALUES('$username')";
							$result = mysqli_query($con,$query);
							exit();
						}
						
						
					}
					else{
						echo "Not Registered";
					}


				}else if($password != $cpassword){
					$invalid=1;

				}else if($role == "0"){
					$norole=1;
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

				<label for="cpassword"><b>Confirm password</b></label>
				<input class="form-control" type = "password" name = "cpassword" required>
				<?php if($invalid){
					echo '<div class="alert alert-danger alert-dismissable fade show" >Please reconfirm password</div>';
				} 
				?>


				<label for="role"><b>Roles</b></label><br>

				<select name ="role" id = "role">
				<option value = "0">Please select your role</option>
				<option value = "Staff">Staff</option>
				<option value = "Supplier">Supplier</option>
				</select>
				<?php if($norole){
					echo '<div class="alert alert-danger alert-dismissable fade show" >Please select valid value from dropdown list</div>';
					
				} 
				?>
					
				</select>
				<hr class="mb-3">
				<input class="btn btn-primary " class = "button" type="submit" name="create" value="Register">
			</div>
		</div>
		</div>
	</form>


</div>


</body>
</html>


