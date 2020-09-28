<?php
	$name = "";
	$email_msg = "";
	$msg = "";
	$profile = "";

	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		//$password = password_verify($_POST['password'], $hashed_password)

		//Database Connection
		$db = mysqli_connect('localhost','root','root','webClass') or die('Error: can not connect to the database');

		//Check User Info Query
		$sql = mysqli_query($db,"Select * from users where email = '$email' ");
		$row = mysqli_fetch_array($sql);


		if(password_verify($password, $row['password'])){
			$fname =  $row['fname'];
			$lname =  $row['lname'];
			$name = substr($fname, 0, 1) . substr($lname, 0, 1);
			$name = "<div class='login-icon'>$name</div>";
			$email_msg = $row['email'];
			$password = $row['password'];
			$profile = "<a href='profile.php?email=$email_msg'>Profile</a>";
		}
		else{
			$msg = "Wrong Username/Password. Try again";
		}
	}
	
	//Create New Account
	if(isset($_POST['submit2'])){
		$fname = $_POST['fName'];
		$lname = $_POST['lName'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$q1 = $_POST['question1'];
		$q2 = $_POST['question2'];
		//Database Connection
		$db = mysqli_connect('localhost','root','root','webClass') or die('Error: can not connect to the database');

		//Insert New User Query
		$sql = mysqli_query($db, "Insert into users(email, fname, lname, password, q1, q2) Values('$email','$fname','$lname','$password','$q1','$q2')");
		if($sql){
			$msg = "Acount has been created successfully";
		}
		else {
			$msg = "Error: Cannot create the account. Account maybe exist";
		}

	}

	//Reset Password
	if(isset($_POST['forget_password'])){
		$email = $_POST['email'];
		$ans1 = $_POST['answer1'];
		$ans2 = $_POST['answer2'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		//Database Connection
		$db = mysqli_connect('localhost','root','root','webClass') or die('Error: can not connect to the database');

		//Check User Info Query
		$sql = mysqli_query($db,"Select * from users where email = '$email' and q1='$ans1' and q2='$ans2' ");
		if(mysqli_num_rows($sql) == 1){
			$row = mysqli_fetch_array($sql);
			$sql2 = mysqli_query($db,"Update users set password='$password' where email = '$email'");
			if($sql2){
				$msg = "Password has been reset successfully";
			}
			else{
				$msg = "Error: could not reset the password";
			}
		}
		else{
			$msg = "Error: your email or security question answer not correct";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search Engine</title>
	</head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<style type="text/css">
		.login-icon {
			background-color: #0275d8;
			color: white;
			font-weight: bold;
			font-size: 20px;
			padding: 5px;
			text-align: center;
			border-radius: 20px;

		}
	</style>

	<body>
		<div class="row py-5 px-5">
			<div class="col-9">
				<form action="" method="post">
					<div class="row">
						<div class="col-9">
							<input type="search" name="search" class="form-control">
						</div>
						<div class="col-3">
							<button type="submit" class="btn btn-primary">Search</button><br>
						</div>
					</div>
					<br><br>
					<!--<a href="create_account.php">Create New Account</a>-->
					<div class="row">
						<div class="col-lg-5">
							<nav>
							  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
								    <a class="nav-item nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
								    <a class="nav-item nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Create New Account</a>
							  	</div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
							  	<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
							  		<h5 align="center">Login</h5>
							  		<form action="" method="post">
										<input type="email" name="email" placeholder="Enter your email" class="form-control" required><br>
										<input type="password" name="password" placeholder="Enter your password" class="form-control" required><br>
										<button type="submit" class="btn btn-info" name="submit">Login</button>
										<a data-toggle="collapse" href="#forget-password" aria-expanded="false" aria-controls="forget-password">Forget Password</a><br>
									</form>
							  	</div>
							  	<div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
							  		<h5 align="center">Create New Account</h5>
							  		<form action="" method="post">
							  			<div class="row">
							  				<div class="col-lg-6">
							  					<input type="text" name="fName" placeholder="First Name" class="form-control" required>
							  				</div>
							  				<div class="col-lg-6">
							  					<input type="text" name="lName" placeholder="Last Name" class="form-control" required>
							  				</div>
							  			</div>
										
										<input type="email" name="email" placeholder="Enter your email" class="form-control" required>
										<input type="password" name="password" placeholder="Enter your password" class="form-control" required>
										<p>Please answer the following questions and remmeber them to reset your password in the future<br>
										What is your best friend's name?</p>
										<input type="text" name="question1" class="form-control" required>
										<p>What is the name of the city you was born?</p>
										<input type="text" name="question2" class="form-control" required>
										<button type="submit" name="submit2" class="btn btn-success">Create</button>
									</form>
							  	</div>
							</div>
							<span align="center"><?php echo $msg; ?></span>
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-5 collapse" id="forget-password">
							<form action="" method="post">
								<input type="email" name="email" placeholder="Enter your email" class="form-control" required>
								<p>What is your best friend's name?</p>
								<input type="text" name="answer1" class="form-control" required>
								<p>What is the name of the city you was born?</p>
								<input type="text" name="answer2" class="form-control" required><br>
								<input type="password" name="password" placeholder="Enter your new password" class="form-control" required><br>
								<button type="submit" name="forget_password" class="btn btn-success">Reset Password</button>
							</form>
						</div>
					</div>
				</form>
			</div>
			<div class="col-3">
				<div class="row">
					<div class="col-lg-3">
						<?php echo $name; ?>
					</div>
					<div class="col-lg-9">
						<?php echo $profile; ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>