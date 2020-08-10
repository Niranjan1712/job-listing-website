<?php 
	session_start();

	// variable declaration
	$deptname = "";
	$jobname = "";


	$date1 = "";
	$date2 = "";
	$date3 = "";
	$date4 = "";
	
	$linkname1 = "";
	$linkname2 = "";
	$linkname3 = "";
	$linkname4 = "";
	

	$linkvalue1 = "";
	$linkvalue2 = "";
	$linkvalue3 = "";
	$linkvalue4 = "";


	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'may2020');

	// REGISTER USER
	if (isset($_POST['submit'])) {
		// receive all input values from the form

		$deptname = mysqli_real_escape_string($db, $_POST['deptname']);
		$jobname  = mysqli_real_escape_string($db, $_POST['jobname']);

		

		$date1 = mysqli_real_escape_string($db, $_POST['date1']);
		$date2 = mysqli_real_escape_string($db, $_POST['date2']);
		$date3 = mysqli_real_escape_string($db, $_POST['date3']);
		$date4 = mysqli_real_escape_string($db, $_POST['date4']);
		

		

		

		

		


		$linkname1 = mysqli_real_escape_string($db, $_POST['linkname1']);
		$linkname2 = mysqli_real_escape_string($db, $_POST['linkname2']);
		$linkname3 = mysqli_real_escape_string($db, $_POST['linkname3']);
		$linkname4 = mysqli_real_escape_string($db, $_POST['linkname4']);
	
		


		$linkvalue1 = mysqli_real_escape_string($db, urldecode($_POST['linkvalue1']));
		$linkvalue2 = mysqli_real_escape_string($db, urldecode($_POST['linkvalue2']));
		$linkvalue3 = mysqli_real_escape_string($db, urldecode($_POST['linkvalue3']));
		$linkvalue4 = mysqli_real_escape_string($db, urldecode($_POST['linkvalue4']));
		

		

		

/*
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
		}*/

		
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			//$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO answerkeys (deptname, jobname, date1, date2, date3, date4, linkname1, linkname2, linkname3, linkname4, linkvalue1, linkvalue2, linkvalue3, linkvalue4) 
					  VALUES('$deptname', '$jobname', '$date1', '$date2', '$date3', '$date4','$linkname1', '$linkname2', '$linkname3', '$linkname4', '$linkvalue1', '$linkvalue2', '$linkvalue3', '$linkvalue4')";

			

			mysqli_query($db, $query);


			echo "<br/><br/><span>Data Inserted successfully...!!</span>";

			//$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			//header('location: index.php');
		
		}
		else{
				echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
			}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				//$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>