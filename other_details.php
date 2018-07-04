<?php
require_once __DIR__. '/db_config.php';
/*
* the app will send id of the user
* following will add trading details of the user to the Trading table
*/

// array for json response
$response = array();


// check for the required fields
if (isset($_POST['user_id'])) {


    if (!preg_match("~^[0-9]$~", $_POST['user_id'])
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['emv_main_branch']) ||
        // // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['emv_branch']) ||
        // // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['emv_godown']) ||
        // // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['emv_factory']) ||
        // // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['emv_others']) ||
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['ara_main_branch'])
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['ara_branch']) ||
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['ara_godown']) ||
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['ara_factory']) ||
        // !preg_match("~^[0-9\ ]{1,20}(?:\.\d\d)?$~", $_POST['ara_other']) ||   
        // !preg_match("~^[a-zA-z0-9\ \-]{1,100}$~", $_POST['organisation_name'])
        ) {

        // input does not match the corresponding given data types
        $response["response_code"] = 401;

        echo json_encode($response); 
    } else {


        $user_id = $_POST['user_id'];
        $emv_main_branch = $_POST['emv_main_branch'];
        $emv_branch = $_POST['emv_branch'];
        $emv_godown = $_POST['emv_godown'];
        $emv_factory = $_POST['emv_factory'];
        $emv_others = $_POST['emv_others'];
        $ara_main_branch = $_POST['ara_main_branch'];
        $ara_branch = $_POST['ara_branch'];
        $ara_godown = $_POST['ara_godown'];
        $ara_factory = $_POST['ara_factory'];
        $ara_other = $_POST['ara_other'];
        $organization_name = $_POST['organisation_name'];
       

    
        // echo $user_id;
        // echo $ara_branch;


        // connecting to database
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        $query = "INSERT INTO OTHER (USER_ID, OTHER_EMV_MAIN_BRANCH, OTHER_EMV_BRANCH, OTHER_EMV_GODOWN, OTHER_EMV_FACTORY,
        OTHER_EMV_OTHERS, ARA_MAIN_BRANCH, ARA_BRANCH, ARA_GODOWN, ARA_FACTORY, ARA_OTHER, OTHER_ORGANISATION_NAME)
        VALUES ('$user_id', '$emv_main_branch', '$emv_branch', '$emv_godown', '$emv_factory', '$emv_others', '$ara_main_branch',
        '$ara_branch', '$ara_godown', '$ara_factory', '$ara_other', '$organization_name')";


        $result = mysqli_query($con, $query);
       
        // check if row inserted or not
        if ($result) {
            // successfully inserted into Others database
            $response["response_code"] = 200;
            echo json_encode($response);
        } else {
            // failed to insert row into Others database
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
