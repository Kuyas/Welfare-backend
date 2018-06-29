<?php

require_once __DIR__. '/db_config.php';


/**
 * STATUS CODES
 * -1 = REJECTED
 * 0 = CLEARED BY CLERK
 * 1 = CLEARED BY ACCOUNTING OFFICER
 * 2 = CLEARED BY HIGHER AUTH
 * 3 = WAITING FOR DISPERSAL
 * 4 = ACCEPTED
 */

 // array for json response
$response = array();

if(isset($_POST["user_id"]){
    $response["response_code"] = -2;
    echo json_encode($response);


} else{

    $user_id = $_POST["user_id"];
    $database = DB_DATABASE;
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());


    $query = "SELECT * FROM `app_status` WHERE `USER_ID` = '".$user_id."'";

    $result = mysqli_query($con, $result);


    if($result){

        $response["response_code"] = 1;
        echo json_encode($response);


    } else {

        $response["response_code"] = 1;
        echo json_encode($response);


    }

}


?>