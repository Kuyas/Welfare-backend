<?php
require_once __DIR__. '/db_config.php';
/*
* the app will send id of the user
* following will add trading details of the user to the Trading table
*/

// array for json response
$response = array();


// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['trading_firm_name']) && isset($_POST['trading_firm_address']) &&  isset($_POST['trading_mtp_branch'])
     && isset($_POST['trading_mtp_godown']) && isset($_POST['trading_mtp_factory']) && isset($_POST['trading_mtp_others'])&& isset($_POST['trading_ownership_type'])
     && isset($_POST['trading_capital_contribution']) && isset($_POST['trading_gstn_date'])&& isset($_POST['trading_license_num'])
     && isset($_POST['trading_license_authority']) && isset($_POST['trading_official_name'])) {


    if (!preg_match("^[0-9]$", $_POST['user_id']) ||
        !preg_match("^[a-zA-z0-9]{1,100}$", $_POST['firm_name']) ||
        !preg_match("^[a-zA-z0-9]{1,200}$", $_POST['firm_address']) ||
        !preg_match("^[a-zA-z0-9]{1,100}$", $_POST['mtp_branch']) ||
        !preg_match("^[a-zA-z0-9]{1,100}$", $_POST['mtp_godown']) ||
        !preg_match("^[a-zA-z0-9]{1,100}$", $_POST['mtp_factory']) ||
        !preg_match("^[a-zA-z0-9]{1,100}$", $_POST['mtp_others']) ||
        !preg_match("^[a-zA-z]{1,100}$", $_POST['ownership_type']) ||
        !preg_match("^[0-9]{1,20}\.[0-9]{2}$", $_POST['capital_contribution'])
        !preg_match("^[a-zA-z0-9\-]{1,50}$", $_POST['gstn_date'])
        !preg_match("^[a-zA-z0-9\-]{1,50}$", $_POST['license_num'])
        !preg_match("^[a-zA-z0-9\-]{1,50}$", $_POST['license_auth'])
        !preg_match("^[a-zA-z]{1,100}$", $_POST['official_name'])) {

        // input does not match the corresponding given data types
        $response["response_code"] = -2;

        echo json_encode($response); 
    } else {


        $user_id = $_POST['user_id'];
        $firm_name = $_POST['trading_firm_name'];
        $firm_address = $_POST['trading_firm_address'];
        $mtp_branch = $_POST['trading_mtp_branch'];
        $mtp_godown = $_POST['trading_mtp_godown'];
        $mtp_factory = $_POST['trading_mtp_factory'];
        $mtp_others = $_POST['trading_mtp_others'];
        $ownership_type = $_POST['trading_ownership_type'];
        $capital_contribution = $_POST['trading_capital_contribution'];
        $gstn_date = $_POST['trading_gstn_date'];
        $license_num = $_POST['trading_license_num'];
        $license_auth = $_POST['trading_license_authority'];
        $official_name = $_POST['trading_official_name'];


        $user_id = stripslashes($user_id);
        $firm_name = stripslashes($firm_name);
        $firm_address = stripslashes($firm_address);
        $mtp_branch = stripslashes($mtp_branch);
        $mtp_godown = stripslashes($mtp_godown);
        $mtp_factory = stripslashes($mtp_factory);
        $mtp_others = stripslashes($mtp_others);
        $ownership_type = stripslashes($ownership_type);
        $capital_contribution = stripslashes($capital_contribution);
        $gstn_date = stripslashes($gstn_date);
        $license_num = stripslashes($license_num);
        $license_auth = stripslashes($license_auth);
        $official_name = stripslashes($official_name);


        // connecting to database
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        $user_id = mysqli_real_escape_string($con, $user_id);
        $firm_name = mysqli_real_escape_string($con, $firm_name);
        $firm_address = mysqli_real_escape_string($con, $firm_address);
        $mtp_branch = mysqli_real_escape_string($con, $mtp_branch);
        $mtp_godown = mysqli_real_escape_string($con, $mtp_godown);
        $mtp_factory = mysqli_real_escape_string($con, $mtp_factory);
        $mtp_others = mysqli_real_escape_string($con, $mtp_others);
        $ownership_type = mysqli_real_escape_string($con, $ownership_type);
        $capital_contribution = mysqli_real_escape_string($con, $capital_contribution);
        $gstn_date = mysqli_real_escape_string($con, $gstn_date);
        $license_num = mysqli_real_escape_string($con, $license_num);
        $license_auth = mysqli_real_escape_string($con, $license_auth);
        $official_name = mysqli_real_escape_string($con, $official_name);

        $query = "INSERT INTO TRADING (USER_ID, TRADING_FIRM_NAME, TRADING_FIRM_ADDRESS, TRADING_MTP_BRANCH, TRADING_MTP_GODOWN, TRADING_MTP_FACTORY, TRADING_MTP_OTHERS, TRADING_OWNERSHIP_TYPE, TRADING_CAPITAL_CONTRIBUTION, TRADING_GSTN_DATE, TRADING_LICENSE_NUM, TRADING_LICENSE_AUTHORITY, TRADING_OFFICIAL_NAME) 
        VALUES ('$user_id', '$firm_name', '$firm_address', '$mtp_branch', '$mtp_godown', '$mtp_factory', '$mtp_others', '$ownership_type', '$capital_contribution', '$gstn_date', '$license_num', '$license_auth', '$official_name')";    

        $result = mysqli_query($con, $query);
	
        // check if row inserted or not
        if ($result) {
            // successfully inserted into Trading database
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
