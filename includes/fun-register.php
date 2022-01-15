<?php 
function register($conn){
	$salt =  salt(12);
	$validate_vals = array(); // array create for user table data
	$validate_login_vals = array(); // array create for login table data

	//Get data from registration form using PHP post method.
	$utype = $_POST['utype'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	//Validate user type field
	//if check user type field not empty.
	if(notEmpty($utype)){
		// php sanitize user type.
		$utype = inputSanitizer($utype);
	}else{
		return "Error! Select User Type";
	}

	//Validate first name field
	//if check first name field not empty.
	if(notEmpty($fname)){
		// php sanitize user first name.
		$fname = inputSanitizer($fname);
	}else{
		return "Error! Enter First Name";
	}

	//Validate last name field
	//if check last name field not empty.
	if(notEmpty($lname)){
		// php sanitize user last name.
		$lname = inputSanitizer($lname);
	}else{
		return "Error! Enter Last Name";
	}

	//Validate email field
	//if check email address field not empty.
	if(notEmpty($email)){
		// php sanitize user email address.
		$email = emailSanitizer($email);
	}else{
		return "Error! Enter Email Address";
	}

	//Validate password field
	//if check password field not empty.
	if(notEmpty($password)){
		// php sanitize user password.
		$password = inputSanitizer($password);
		//validate password using PHP regex
		if(validatePassword($password)){
			$password = $password;
		}else{
			return "Error! Password should be at least 1 upper case letter, at least 1 lower case letter, at least 1 number, at least 1 special character, (Min=8 characters and Max=16 characters)";
		}
	}else{
		return "Error! Enter password";
	}

	//Validate confirm password field
	//if check onfirm password field not empty.
	if(notEmpty($cpassword)){
		// php sanitize user confirm password.
		$cpassword = inputSanitizer($cpassword);
		//validate password using PHP regex
		if(validatePassword($cpassword)){
			$cpassword = $cpassword;
		}else{
			return "Error! Confirm password should be at least 1 upper case letter, at least 1 lower case letter, at least 1 number, at least 1 special character, (Min=8 characters and Max=16 characters)";
		}
	}else{
		return "Error! Enter confirm password";
	}
	
	//if check password and confirm password match or not
	if($password == $cpassword){
		//if check Email address already registered or not
		if(rowCounts(mysqli_query($conn, "SELECT * from e_login WHERE e_email='$email'"))==0){
			//make password hash
					$salt_password = make($cpassword,$salt);
					$validate_login_vals['e_email'] = $email;
					$validate_login_vals['e_password'] = $salt_password;
			//insert data to user table
				if(dbInsert($conn, $validate_login_vals, "e_login")){
					$validate_vals['e_user_login_id'] = $conn->insert_id;
					$validate_vals['e_user_fname'] = $fname;
					$validate_vals['e_user_lname'] = $lname;
					$validate_vals['e_user_type'] = $utype;
				//insert data to user login table	
				if(dbInsert($conn, $validate_vals, "e_user")){
					//if registration completed then redirect to index.php login form
					locationRewrite('index.php?action=login');
				}else{
					return "Error! Please try again."; 
				}
			}else{
				return "Error! Please try again."; 
			}
		}else{
			return "Email address already registered in database! Please use another email address to register";
		}
	}else{
		return "Error! Password miss matched! please try again.";
	}



}



?>