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

	if (!preg_match("~^[a-zA-Z\ ]{1,100}$~", $_POST['personal_name']) ||  
		!preg_match("~^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$~", $_POST['personal_dob']) ||
		(strcmp($_POST['personal_gender'], "MALE") != 0 && strcmp($_POST['personal_gender'], "FEMALE") != 0 && 
			strcmp($_POST['personal_gender'], "OTHER") != 0) || 
		!preg_match("~^[a-zA-Z0-9\- /]{1,200}$~", $_POST['personal_address']) || 
		!preg_match("~^[a-zA-z\ ]{1,100}$~", $_POST['personal_place']) || 
		!preg_match("~^[a-zA-z]{1,100}$~", $_POST['personal_district'])) {
	
		// input does not match the corresponding given data types
		$response["response_code"] = 401;

		echo json_encode($response); 

	} else { 

		$user_id = $_POST['user_id'];
		$personal_name = $_POST['personal_name'];
		$personal_dob = $_POST['personal_dob'];
		$personal_gender = $_POST['personal_gender'];
		$personal_address = $_POST['personal_address'];
		$personal_place = $_POST['personal_place'];
		$personal_district = $_POST['personal_district'];

		// connecting to database
		$database = DB_DATABASE;
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

		$personal_dob = strtotime($personal_dob);
		$personal_dob = date('Y-m-d',$personal_dob);
		
		$query = "INSERT INTO PERSONAL (USER_ID, PERSONAL_NAME, PERSONAL_DOB, PERSONAL_GENDER, PERSONAL_ADDRESS, PERSONAL_PLACE, PERSONAL_DISTRICT) VALUES ('$user_id', '$personal_name', '$personal_dob', '$personal_gender', '$personal_address', '$personal_place', '$personal_district')
		ON DUPLICATE KEY UPDATE
		PERSONAL_ADDRESS='".$personal_address."'
		PERSONAL_PLACE='".$personal_place."'
		PERSONAL_DISTRICT='".$personal_district."'";
		$result = mysqli_query($con, $query);

		// check if row inserted or not
		if ($result) {
			// TODO: Document previous error regarding $result in msqli_fetch_array($result) which does not take boolean
			// successfully inserted into Personal database
            $response["response_code"] = 200;
			echo json_encode($response);
		} else {
			// failed to insert row into Personal database
			$response["response_code"] = 403;
			echo json_encode($response);
		}
	}			
} else {
	// required fields are missing
	$response["response_code"] = 400;
	echo json_encode($response);
}


?>  