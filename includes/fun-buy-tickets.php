<?php 
function buyTickets($conn, $eventid){
	$validate_vals = array();
	//Get event information from event table using relevent event id.
	$eventinfo = getEventById($conn, $eventid);
	//Get event name from result set.
	$eventtitle = $eventinfo['e_event_title'];

	//Get user id using login session.
	if(isset($_SESSION['login_id'])){
		$userid = $_SESSION['login_id']; 
	}else{
		$userid = 2;
	}
	
	//Get user informatin from user table using relevent user id
	$userinfomation = getUserinfo($conn, $userid);
	//Get user email from result set.
	$useremail = $userinfomation['e_email'];

	//Get Data from buy ticket form using PHP POST method.
	$numberoftickets = $_POST['numberoftickets'];
	$cardnumber = $_POST['cardnumber'];
	$cardexpirydate = $_POST['cardexpirydate'];
	$cvv = $_POST['cvv'];
	$message = $_POST['message'];

	//Validate Number of tickets field
	//if check number of tickets field not empty or not equal zero.
	if(notEmpty($numberoftickets) && $numberoftickets !=0){
		// php sanitize number of tickets data.
		$numberoftickets = inputSanitizer($numberoftickets);
	}else{
		return "Error! Number of tickets field should not be empty";
	}

	//Validate card number field
	//if check card number field not empty or not equal 16.
	if(notEmpty($cardnumber) && strlen($cardnumber)==16){
		// php sanitize card number data.
		$cardnumber = inputSanitizer($cardnumber);
	}else{
		return "Error! Enter valid card number";
	}

	//Validate card expiry date field
	//if check card expiry date field not empty or length equal 4.
	if(notEmpty($cardexpirydate) && strlen($cardexpirydate)==4){
		$m=0;
		$y=0;
		$thisyear = date("Y"); // Get this year
		$yearlast =  substr($thisyear, 0, 2); //Get last two character from this year.
		$month =  substr($cardexpirydate, 0, 2); // Get month from card expiry date field.
		$year = substr($cardexpirydate,2); // Get year from card expiry date field.
		//check input month in correct range using PHP for loop.
		for ($x = 1; $x <= 12; $x++) {
			if($month==$x){
				$m=1;
				break;
			}
		}
		//check input year in correct range using PHP for loop.
		for ($i = $yearlast; $i <= 99; $i++) {
			if($year==$i){
				$y=1;
				break;
			}
		}

		if($m==1 && $y==1){
			// php sanitize card expiry date data.
			$cardexpirydate = inputSanitizer($cardexpirydate);
		}else{
			return "Error! Enter valid expiry date";
		}
	}else{
		return "Error! Expiry date format should be (MMYY)";
	}

	//Validate card cvv field
	//if check cvv field not empty or length equal 3.
	if(notEmpty($cvv) && strlen($cvv)==3){
		// php sanitize cvv data.
		$cvv = inputSanitizer($cvv);
	}else{
		return "Error! Enter valid cvv";
	}

	// php sanitize message data.
	$message = inputSanitizer($message);

	//genarate hash confirmation code using event name and user email address.
	$confirmationcode = hash('sha256', $eventtitle.$useremail);

	// set database fields using $validate_vals array. 
	//$validate_vals['number_of_tickets'] = $numberoftickets;
	//$validate_vals['credit_card_number'] = $cardnumber;
	//$validate_vals['expiry_field'] = $cardexpirydate;
	//$validate_vals['cvv'] = $cvv;
	//$validate_vals['message'] = $message;
	$validate_vals['e_tix_user_login_id'] = $userid;
	$validate_vals['e_tix_event_id'] = $eventid;
	$validate_vals['e_confirmation_code'] = $confirmationcode; 

	//insert data to tickets table
	if(dbInsert($conn, $validate_vals, "e_tickets")){
		//if Payment completed redirect to profile.php page 
		if($userid==2){		
			return "Payment completed! and your confirmation code : ".$confirmationcode;
		}else{
			locationRewrite('profile.php');
		}
		
	}else{
		return "Error! Please try again.";
	}

}


?>