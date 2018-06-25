<?php

require_once __DIR__. '/db_config.php'

/*
* the app will send id of the user
* following will add personal details of the user to the Personal table
*/

// array for json response
$response = array();

// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['personal_name']) && isset($_POST['personal_dob']) && isset($_POST['personal_gender'])
	 && isset($_POST['personal_address']) && isset($_POST['personal_place']) && isset($_POST['personal_district'])) {

	$user_id = $POST['user_id'];
	$peronal_name = $POST['personal_name'];
	$peronal_dob = $POST['personal_dob'];
	$peronal_gender = $POST['personal_gender'];
	$peronal_address = $POST['personal_address'];
	$peronal_place = $POST['personal_place'];
	$peronal_district = $POST['personal_district'];



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

	$query = "INSERT INTO PERSONAL (USER_ID, PERSONAL_NAME, PERSONAL_DOB, PERSONAL_GENDER, PERSONAL_ADDRESS, PERSONAL_PLACE, PERSONAL_DISTRICT)
			VALUES ('$user_id', 'personal_name', 'personal_dob', 'personal_gender', 'personal_address', 'personal_place', personal_district)";
	$result = mysqli_qeury($con, $query);
	

	// check if row inserted or not

	if ($result) {
		// successfully inserted into Personal database
		$response["success"] = 1;

		echo json_encode($response);
	} else {
		// failed to insert row into Personal database
		$response["success"] = 0;

		echo json_encode($response);
	}		
} else {
	// required fields are missing
	$response["success"] = -1;

	echo json_encode($response);
}

?>  