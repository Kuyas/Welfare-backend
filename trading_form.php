<?php
require_once __DIR__. '/db_config.php';
/*
* the app will send id of the user
* following will add trading details of the user to the Trading table
*/

// array for json response
$response = array();

// check for the required fields
if (isset($_POST['user_id']) && isset($_POST['trading_firm_name']) && isset($_POST['trading_firm_address']) && isset($_POST['trading_firm_turnover']) &&  isset($_POST['trading_mtp_branch'])
     && isset($_POST['trading_mtp_godown']) && isset($_POST['trading_mtp_factory']) && isset($_POST['trading_ownership_type'])
     && isset($_POST['trading_capital_contribution']) && isset($_POST['trading_gstn_date'])&& isset($_POST['trading_license_num'])
     && isset($_POST['trading_license_authority']) && isset($_POST['trading_official_name'])) {


    if (!preg_match("~^[0-9]$~", $_POST['user_id']) ||
        !preg_match("~^[a-zA-z0-9\ \-]{1,100}$~", $_POST['trading_firm_name']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,200}$~", $_POST['trading_firm_address']) ||
        !preg_match("~^[0-9]{1,20}(?:\.\d\d)?$~", $_POST['trading_firm_turnover']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,100}$~", $_POST['trading_mtp_branch']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,100}$~", $_POST['trading_mtp_godown']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,100}$~", $_POST['trading_mtp_factory']) ||
        // !preg_match("~^[a-zA-z0-9\-\ \/]{1,100}$~", $_POST['trading_mtp_others']) ||
        !preg_match("~^[a-zA-z]{1,100}$~", $_POST['trading_ownership_type']) ||
        !preg_match("~^[0-9]{1,20}(?:\.\d\d)?$~", $_POST['trading_capital_contribution']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,50}$~", $_POST['trading_gstn_date']) ||
        !preg_match("~^[a-zA-z0-9\-\ ]{1,50}$~", $_POST['trading_license_num']) ||
        !preg_match("~^[a-zA-z0-9\-\ \/]{1,50}$~", $_POST['trading_license_authority']) ||
        !preg_match("~^[a-zA-z\ ]{1,100}$~", $_POST['trading_official_name'])) {

        // input does not match the corresponding given data types
        $response["response_code"] = 401;

        echo json_encode($response); 
    } else {

        if(isset($_POST["trading_mtp_others"])){
            if(!preg_match("~^[a-zA-z0-9\-\ \/]{1,100}$~", $_POST['trading_mtp_others'])){

                 // input does not match the corresponding given data types
                  $response["response_code"] = 401;

                 echo json_encode($response); 

            }

        }



        $user_id = $_POST['user_id'];
        $firm_name = $_POST['trading_firm_name'];
        $firm_address = $_POST['trading_firm_address'];
        $turnover = $_POST['trading_firm_turnover'];
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

        // connecting to database
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        $query = "INSERT INTO TRADING (USER_ID, TRADING_FIRM_NAME, TRADING_FIRM_ADDRESS, TRADING_ANNUAL_TURNOVER, TRADING_MTP_BRANCH, TRADING_MTP_GODOWN, TRADING_MTP_FACTORY, TRADING_MTP_OTHERS, TRADING_OWNERSHIP_TYPE, TRADING_CAPITAL_CONTRIBUTION, TRADING_GSTN_DATE, TRADING_LICENSE_NUM, TRADING_LICENSE_AUTHORITY, TRADING_OFFICIAL_NAME) 
        VALUES ('$user_id', '$firm_name', '$firm_address', '$turnover' , '$mtp_branch', '$mtp_godown', '$mtp_factory', '$mtp_others', '$ownership_type', '$capital_contribution', '$gstn_date', '$license_num', '$license_auth', '$official_name') ON DUPLICATE KEY UPDATE 
        TRADING_FIRM_NAME='".$firm_name."', 
        TRADING_FIRM_ADDRESS='".$firm_address."', 
        TRADING_ANNUAL_TURNOVER='".$trading_firm_turnover."', 
        TRADING_MTP_BRANCH='".$mtp_branch."', 
        TRADING_MTP_GODOWN='".$mtp_godown."', 
        TRADING_MTP_FACTORY='".$mtp_factory."', 
        TRADING_MTP_OTHERS='".$mtp_others."', 
        TRADING_OWNERSHIP_TYPE='".$ownership_type."',
        TRADING_CAPITAL_CONTRIBUTION='".$capital_contribution."',
        TRADING_GSTN_DATE='".$gstn_date."',
        TRADING_LICENSE_NUM='".$license_num."',
        TRADING_LICENSE_AUTHORITY='".$license_auth."',
        TRADING_OFFICIAL_NAME='".$official_name."'";

        $result = mysqli_query($con, $query);
	
        // check if row inserted or not
        if ($result) {
            // successfully inserted into Trading database
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
