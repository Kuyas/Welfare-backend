<?php

require_once __DIR__. '/db_config.php';

/*
* the app will send id of the user
* following will add personal details of the user to the Personal table
*/

// array for json response
$response = array();

// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['personal_name']) && isset($_POST['personal_dob']) &&  isset($_POST['personal_gender'])
	 && isset($_POST['personal_address']) && isset($_POST['personal_place']) && isset($_POST['personal_district'])) {

	if (!preg_match("~^[a-zA-Z]{1,100}$~", $_POST['personal_name']) ||  
		!preg_match("~^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$~", $_POST['personal_dob']) ||
		(strcmp($_POST['personal_gender'], "MALE") != 0 && strcmp($_POST['personal_gender'], "FEMALE") != 0 && 
			strcmp($_POST['personal_gender'], "OTHER") != 0) || 
		!preg_match("~^[a-zA-Z0-9\-$]{1,200}$~", $_POST['personal_address']) || 
		!preg_match("~^[a-zA-z]{1,100}$~", $_POST['personal_place']) || 
		!preg_match("~^[a-zA-z]{1,100}$~", $_POST['personal_district'])) {
	
		// input does not match the corresponding given data types
		$response["response_code"] = -2;

		echo json_encode($response); 

	} else { 

		$user_id = $_POST['user_id'];
		$personal_name = $_POST['personal_name'];
		$personal_dob = $_POST['personal_dob'];
		$personal_gender = $_POST['personal_gender'];
		$personal_address = $_POST['personal_address'];
		$personal_place = $_POST['personal_place'];
		$personal_district = $_POST['personal_district'];

		$user_id = stripslashes($user_id);
		$personal_name = stripslashes($personal_name);
		$personal_dob = stripslashes($personal_dob);
		$personal_gender = stripslashes($personal_gender);
		$personal_address = stripslashes($personal_address);
		$personal_place = stripslashes($personal_place);
		$personal_district = stripslashes($personal_district);



		// connecting to database
		$database = DB_DATABASE;
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

		$user_id = mysqli_real_escape_string($con, $user_id);
		$personal_name = mysqli_real_escape_string($con, $personal_name);
		$personal_dob = mysqli_real_escape_string($con, $personal_dob);
		$personal_gender = mysqli_real_escape_string($con, $personal_gender);
		$personal_address = mysqli_real_escape_string($con, $personal_address);
		$personal_place = mysqli_real_escape_string($con, $personal_place);
		$personal_district = mysqli_real_escape_string($con, $personal_district);

		$personal_dob = strtotime($personal_dob);
		$personal_dob = date('Y-m-d',$personal_dob);
		
		$query = "INSERT INTO PERSONAL (USER_ID, PERSONAL_NAME, PERSONAL_DOB, PERSONAL_GENDER, PERSONAL_ADDRESS, PERSONAL_PLACE, PERSONAL_DISTRICT)
		VALUES ('$user_id', '$personal_name', '$personal_dob', '$personal_gender', '$personal_address', '$personal_place', '$personal_district')";
		$result = mysqli_query($con, $query);
		

		// check if row inserted or not

		if ($result) {
			// successfully inserted into Personal database
			$result = mysqli_fetch_array($result);
            $response["response_code"] = 1;
            $response["id"] = $result[0];

			echo json_encode($response);
		} else {
			// failed to insert row into Personal database
			$response["response_code"] = 0;
			$response["1"] = $personal_dob;

			echo json_encode($response);
		}
	}			
} else {
	// required fields are missing
	$response["response_code"] = -1;

	echo json_encode($response);
}


?>  