<?php 
	session_start();

	// variable declaration
	$username = "";
	$password  = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('sql207.epizy.com', 'epiz_25468334', 'Wog8pxAxXt', 'epiz_25468334_admindatabase','3306');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$rollno = mysqli_real_escape_string($db, $_POST['rollno']);
		$college = mysqli_real_escape_string($db, $_POST['college']);
		$branch = mysqli_real_escape_string($db, $_POST['branch']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($firstname)) { array_push($errors, "First Name is required"); }
		if (empty($lastname)) { array_push($errors, "Last Name is required"); }
		if (empty($rollno)) { array_push($errors, "Roll Number is required"); }
		if (empty($college)) { array_push($errors, "College Name is required"); }
		if (empty($branch)) { array_push($errors, "Branch Name is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		$query = "SELECT username FROM users WHERE username ='$username'";
		$fire = mysqli_query($db,$query) or die("Can not fire query to select username ".mysqli_query($db));

		if(mysqli_num_rows($fire)>0){
			array_push($errors, "Username is not available. Try another !!");
		}

		$query = "SELECT email FROM users WHERE email ='$email'";
		$fire = mysqli_query($db,$query) or die("Can not fire query to select username ".mysqli_query($db));

		if(mysqli_num_rows($fire)>0){
			array_push($errors, "Email is already Registered");
		}

		
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, firstname, lastname, rollno, college, branch) 
					  VALUES('$username', '$email', '$password', '$firstname','$lastname','$rollno','$college','$branch')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: jobdetails.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		


		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			//$password = md5($password);
			$query = "SELECT * FROM admininfo WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results)) {
				$_SESSION['username'] = $username;
				//$_SESSION['success'] = "You are now logged in";
				header('location: month.php');
			}else {
				array_push($errors, "Wrong username /password combination");
			}
		}
	}

?>