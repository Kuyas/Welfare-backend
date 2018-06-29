<?php
require_once __DIR__. '/db_config.php';
/*
* the app will send id of the user
* following will add trading details of the user to the Trading table
*/

// array for json response
$response = array();


// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['payment_reg_fee']) && isset($_POST['payment_annual_fee']) && isset($_POST['payment_class'])) {

    if (!preg_match("~^[0-9]$~", $_POST['user_id']) ||
        !preg_match("~^[0-9]{1,20}\.[0-9]{2}$~", $_POST['payment_reg_fee']) ||
        !preg_match("~^[0-9]{1,20}\.[0-9]{2}$~", $_POST['payment_annual_fee']) ||
        !preg_match("~^[A-Z]{1,3}$~", $_POST['payment_class'])) {

        // input does not match the corresponding given data types
        $response["response_code"] = -2;

        echo json_encode($response); 
    } else {

    	$user_id = $_POST['user_id'];
    	$payment_reg_fee = $_POST['payment_reg_fee'];
    	$payment_annual_fee = $_POST['payment_annual_fee'];
    	$payment_class = $_POST['payment_class'];


        $user_id = stripslashes($user_id);
        $payment_reg_fee = stripslashes($payment_reg_fee);
        $payment_annual_fee = stripslashes($payment_annual_fee);
        $payment_class = stripslashes($payment_class);


    	// connecting to database
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        $user_id = mysqli_real_escape_string($con, $user_id);
        $payment_reg_fee = mysqli_real_escape_string($con, $payment_reg_fee);
        $payment_annual_fee = mysqli_real_escape_string($con, $payment_annual_fee);
        $payment_class = mysqli_real_escape_string($con, $payment_class);

        $query = "INSERT INTO PAYMENT (USER_ID, PAYMENT_REG_FEE, PAYMENT_ANNUAL_FEE, PAYMENT_CLASS) VALUES ('$user_id', '$payment_reg_fee', '$payment_annual_fee', '$payment_class')";

        $result = mysqli_query($con, $query);

        // check if row inserted or not
        if ($result) {
            // successfully inserted into Payment database
            $result = mysqli_fetch_array($result);
            $response["response_code"] = 1;
            $response["id"] = $result[0];

            echo json_encode($response);
        } else {
            // failed to insert row into Payment database
            $response["response_code"] = 0;

            echo json_encode($response);
        }

    }	

} else {
    // required fields are missing
    $response["response_code"] = -1;

    echo json_encode($response);
}

