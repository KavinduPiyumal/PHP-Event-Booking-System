<?php 
function login($conn, $ticketid){
	$salt =  salt(12);
	//Get data from login form
	$email = $_POST['email'];
	$password = $_POST['password'];

	//Validate email field
	//if check email field empty
	if(notEmpty($email)){
		// php sanitize email.
		$email = emailSanitizer($email);
	}else{
		return "Error! Enter Email Address";
	}

	//Validate password field
	//if check password field empty
	if(notEmpty($password)){
		// php sanitize password.
		$password = inputSanitizer($password);
		//make password hash
		$salt_password = make($password,$salt);
	}else{
		return "Error! Enter password";
	}

	//check Login details correct or not
	if(rowCounts(mysqli_query($conn, "SELECT * FROM e_login WHERE e_email='$email' AND e_password='$salt_password'"))==1){
		//Get User Information from user and user_login tables
		$query = mysqli_query($conn, "SELECT * FROM e_user,e_login WHERE e_user.e_user_login_id=e_login.e_id AND e_login.e_email='$email' AND e_login.e_password='$salt_password'");
		$reslut = mysqli_fetch_array($query);
		//create login Sessions
		$_SESSION['login_id'] = $reslut['e_id'];
		$_SESSION['user_type'] = $reslut['e_user_type'];
 
		
			//if buy-tickets querystring not set redirect to profile.php page
		if(isset($_GET['buy-tickets'])){
				locationRewrite('event.php?buy-tickets='.$_GET['buy-tickets']);
		}else{
				locationRewrite('profile.php');
		}
			
		
		
		
		
	}else{
		return "Error! Login details incorrect!"; 
	}

}


?>