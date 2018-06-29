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
 		!preg_match("~^[a-zA-z]{1,100}$~", $_POST['family_name']) || 
 		!preg_match("~^[0-9]{1,3}$~", $_POST['family_age']) || 
		(strcmp($_POST['family_gender'], "MALE") != 0 && strcmp($_POST['family_gender'], "FEMALE") != 0 && 
			strcmp($_POST['family_gender'], "OTHER") != 0) || 
		!preg_match("~^[a-zA-z]{1,50}$~", $_POST['family_occupation']) || 
		!preg_match("~^a-zA-z]{1,50}$~", $_POST['family_relationship'])) {

		// input does not match the corresponding given data types
		$response["response_code"] = -2;

		echo json_encode($response); 
	} else {

		$user_id = $_POST['user_id'];
		$family_name = $_POST['family_name'];
		$family_age = $_POST['family_age'];
		$family_gender = $_POST['family_gender'];
		$family_occupation = $_POST['family_occupation'];
		$family_relationship = $_POST['family_relationship'];


		$user_id = stripslashes($user_id);
		$family_name = stripslashes($family_name);
		$family_age = stripslashes($family_age);
		$family_gender = stripslashes($family_gender);
		$family_occupation = stripslashes($family_occupation);
		$family_relationship = stripslashes($family_relationship);


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
			// successfully inserted into Family database
			$result = mysqli_fetch_array($result);
            $response["response_code"] = 1;
            $response["id"] = $result[0];

			echo json_encode($response);
		} else {
			// failed to insert row into Personal database
			$response["response_code"] = 0;

			echo json_encode($response);
		}
	}		
} else {
	// required fields are missing
	$response["response_code"] = -1;

	echo json_encode($response);
}

?>  
