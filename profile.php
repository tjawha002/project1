<?php 
	$email = $_GET['email'];
	$msg = "";
	//Database Connection
	$db = mysqli_connect('localhost','root','root','webClass') or die('Error: can not connect to the database');

	//Check User Info Query
	$sql = mysqli_query($db,"Select * from users where email = '$email' ");
	$row = mysqli_fetch_array($sql);

	$fname = $row['fname'];
	$lname = $row['lname'];
	$ans1 = $row['q1'];
	$ans2 = $row['q2'];

	if(isset($_POST['editProfile'])){
		$fN = $_POST['fname'];
		$lN = $_POST['lname'];
		$q1 = $_POST['ans1'];
		$q2 = $_POST['ans2'];
		$email = $_POST['userEmail'];

		$sql2 = mysqli_query($db,"Update users set fname = '$fN', lname = '$lN', q1 = '$ans1', q2 = '$ans2' where email = '$email' ");
		if($sql2){
			$msg = "Your profile has been updated successfully";
		}
		else{
			$msg = "Error: could not update your profile";
		}

	}

	//Change Password
	if(isset($_POST['changePass'])){
		$old_password = $_POST['oldPass'];
		$new_password = $_POST['newPass'];
		$email = $_POST['passEmail'];

		//First step: check if the old password match the password in the Database
		$sqlCheck = $sql = mysqli_query($db,"Select password from users where email = '$email' ");
		$row2 = mysqli_fetch_array($sqlCheck);
		$db_pass = $row2['password'];
		if(password_verify($old_password,$db_pass)){
			$new_password = password_hash($new_password, PASSWORD_DEFAULT);
			$sql3 = mysqli_query($db,"Update users set password = '$new_password' where email = '$email' ");
			if($sql3){
				$msg = "Your password has been changed successfully";
			}
			else{
				$msg = "Error: could not change your password";
			}
		}
		else{
			$msg = "Error: your old password does not match the saved password";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="col-6 mx-auto">
			<br><br>
			<div class="card">
			  	<h5 class="card-header">
			  		<a href="info.php"> << Back </a>
			  		<?php echo $fname ." ". $lname ." Profile"; ?>
			  			
			  	</h5>
			  	<div class="card-body">
			  		<div align="center"><?php echo $msg; ?></div>
			  		<!-- Change Profile -->
				    <form action="" method="post">
				    	<input type="hidden" name="userEmail" value="<?php echo $email; ?>">
				    	<label>First Name:</label>
				    	<input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" required>
				    	<label>Last Name:</label>
				    	<input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" required>
				    	<label>What is your best friend's name?</label>
				    	<input type="text" name="ans1" value="<?php echo $ans1; ?>" class="form-control" required>
				    	<label>What is the name of the city you was born?</label>
				    	<input type="text" name="ans2" value="<?php echo $ans2; ?>" class="form-control" required><br>
				    	<p>
				    		<button type="submit" name="editProfile" class="btn btn-warning">Edit Profile</button>
				    	</p>
				    </form>
			    	<p>
			    		<a class="btn btn-danger" data-toggle="collapse" href="#password" role="button" aria-expanded="false" aria-controls="password">Change Password</a>
			    		<div class="collapse" id="password">
			    			<!-- Change Password -->
			    			<form action="" method="post">
			    				<input type="hidden" name="passEmail" value="<?php echo $email; ?>">
			    				<div class="row">
							  		<div class="col-lg-6">
							  			<input type="password" name="oldPass" class="form-control" placeholder="Enter your old password" required>
							  		</div>
							  		<div class="col-lg-6">
							  			<input type="password" name="newPass" class="form-control" placeholder="Enter your new password" required>
							  		</div>
							  		<div class="col-12 py-2">
							  			<button class="btn btn-warning" type="submit" name="changePass">Change</button>
							  		</div>
							  	</div>
			    			</form>
						</div>
				    </p>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>