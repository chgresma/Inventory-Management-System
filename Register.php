<!DOCTYPE html>
<html>
	<head>
		<title> User Registration</title>
		<link rel="stylesheet" type = "text/css" href="css/bootstrap.min.css">
	</head>
	<body>

        <!-- P A R T I A L not yet connected to database-->
        
        <!-- Bootstrap v5.2 is used for styling-->
<div>
	<?php 

		if(isset($_POST['create'])){
			$username 	= $_POST['username'];
			$firstname 	= $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname 	= $_POST['lastname'];
			$password 	= $_POST['password'];
		
			echo $username ." ". $firstname ." ".$middlename ." ". $lastname ." ". $password;
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

				<label for="firstname"><b>First Name</b></label>
				<input class="form-control" type = "text" name = "firstname" required>

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
