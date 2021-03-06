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

 	if (!preg_match("~^[0-9]$~", $_POST['user_id']) || 
 		!preg_match("~^[a-zA-z\ ]{1,100}$~", $_POST['family_name']) || 
 		!preg_match("~^[0-9]{1,3}$~", $_POST['family_age']) || 
		(strcmp($_POST['family_gender'], "MALE") != 0 && strcmp($_POST['family_gender'], "FEMALE") != 0 && 
			strcmp($_POST['family_gender'], "OTHER") != 0) || 
		!preg_match("~^[a-zA-z\ ]{1,50}$~", $_POST['family_occupation']) || 
		!preg_match("~^[a-zA-z\ ]{1,50}$~", $_POST['family_relationship'])) {

		// input does not match the corresponding given data types
		$response["response_code"] = 401;

		echo json_encode($response); 
	} else {

		$user_id = $_POST['user_id'];
		$family_name = $_POST['family_name'];
		$family_age = $_POST['family_age'];
		$family_gender = $_POST['family_gender'];
		$family_occupation = $_POST['family_occupation'];
		$family_relationship = $_POST['family_relationship'];

		// connecting to database
		$database = DB_DATABASE;
		$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

		$query = "INSERT INTO FAMILY (USER_ID, FAMILY_NAME, FAMILY_AGE, FAMILY_GENDER, FAMILY_OCCUPATION, FAMILY_RELATIONSHIP) 
		VALUES ('$user_id', '$family_name', '$family_age', '$family_gender', '$family_occupation', '$family_relationship')";

		$result = mysqli_query($con, $query);

		// check if row inserted or not

		if ($result) {
			// successfully inserted into Family database
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
