<?php

require_once __DIR__. '/db_config.php';

/*
* the app will send id of the user
* following will add personal details of the user to the Personal table
*/

// array for json response
$response = array();

// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['family_name']) && isset($_POST['family_age'])
 && isset($_POST['family_gender']) && isset($_POST['family_occupation']) && isset($_POST['family_relationship'])) {

	$user_id = $_POST['user_id'];
	$family_name = $_POST['family_name'];
	$family_age = $_POST['family_age'];
	$family_gender = $_POST['family_gender'];
	$family_occupation = $_POST['family_occupation'];
	$family_relationship = $_POST['family_relationship'];

	// connecting to database
	$database = DB_DATABASE;
	$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

	$user_id = mysqli_real_escape_string($con, $user_id);
	$family_name = mysqli_real_escape_string($con, $family_name);
	$family_age = mysqli_real_escape_string($con, $family_age);
	$family_gender = mysqli_real_escape_string($con, $family_gender);
	$family_occupation = mysqli_real_escape_string($con, $family_occupation);
	$family_relationship = mysqli_real_escape_string($con, $family_relationship);

	$query = "INSERT INTO FAMILY (USER_ID, FAMILY_NAME, FAMILY_AGE, FAMILY_GENDER, FAMILY_OCCUPATION, FAMILY_RELATIONSHIP) 
	VALUES ('$user_id', '$family_name', '$family_age', '$family_gender', '$family_occupation', '$family_relationship')";

	$result = mysqli_query($con, $query);

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
