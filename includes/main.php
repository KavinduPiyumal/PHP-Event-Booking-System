<?php 
// start Session
function controlSession(){
	ob_start();
	if(!isset($_SESSION)){ session_start(); }  
}
//php Sanitizers
function emailSanitizer($value){
	return filter_var($value, FILTER_SANITIZE_EMAIL);
}

function numberSanitizer($value){
	return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
}
	
function inputSanitizer($value){
	return filter_var($value, FILTER_SANITIZE_STRING);
}


function notEmpty($string){
	if(!empty($string)){
			return $string;
	}else{
			
	}
}

//password validation using PHP regex 
function validatePassword($password){
	if(strlen($password) < 17){
		if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=\S{8,})(?=.*(_|[^\w])).+$/', $password)){
			return $password;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

//pasword hash code genarate
function make($string, $salt = ''){
	    return hash('md5', $string.$salt);
}
		
function salt($length){
	        $rand = '';      
	        if(($length % 2) == 1){
	            $new_length = ($length - 1) / 2;
	            $rand = rand(0,9);
	        }
	        else{
	            $new_length = $length / 2;
	        }
	        return bin2hex($new_length) . $rand ;
	        
}

//SQL Database Insert

function dbInsert($conn, $query, $table){		
			foreach($query as $key => $db_feilds){
				$db_filds_list .= $key.",";	
				$db_values .= "'$db_feilds'".",";
			}
		
			$db_filds_list = rtrim($db_filds_list, ',');
			$db_values = rtrim($db_values, ',');
			$insert_query = "INSERT INTO $table (
				$db_filds_list
			) VALUES (
				$db_values
			)";
			$qry = mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
			if($qry){				
				return true;
			}else{
				return false;
			}
}
function rowCounts($query){		
		return mysqli_num_rows($query);
}
//PHP redirect
function locationRewrite($page) {		
		if(!empty($page)){
			return header("Location: {$page}");
		}
}
//Get User Information From table
function getUserinfo($conn, $userid){
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM e_user,e_login WHERE e_user.e_user_login_id =e_login.e_id AND e_user.e_user_login_id ='$userid'"));
	return $result;
}
//Get Event Information From table
function getAllEvents($conn){
	$result = mysqli_query($conn, "SELECT * FROM e_events");
	return $result;
}
// Get specific event infomation using event id
function getEventById($conn, $eventid){
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM e_events WHERE e_event_id='$eventid'"));
	return $result;
}

function getEventByIdempty($conn, $eventid){
	$result = mysqli_query($conn, "SELECT * FROM e_events WHERE e_event_id='$eventid'");
	return $result;
}
// Get specific tickets infomation using user id
function getTicketsByUserId($conn, $userid){
	$result = mysqli_query($conn, "SELECT * FROM e_tickets,e_events WHERE e_tickets.e_tix_event_id=e_events.e_event_id  AND e_tickets.e_tix_user_login_id ='$userid'");
	return $result;
}

//Get Random Events
function getTenEvents($conn){
	$result = mysqli_query($conn, "SELECT * FROM e_events ORDER BY RAND() LIMIT 10");
	return $result;
}


?>