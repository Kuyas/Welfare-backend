<?php

require_once __DIR__. '/db_config.php';


/**
 * STATUS CODES
 * -1 = REJECTED
 * 0 = APPLICATION SUBMITTED
 * 1 = CLEARED BY CLERK
 * 2 = CLEARED BY ACCOUNTING OFFICER
 * 3 = CLEARED BY HIGHER AUTH
 * 4 = WAITING FOR DISPERSAL
 * 5 = ACCEPTED
 */

 // array for json response
$response = array();
// $x = array

if(!isset($_POST["user_id"])) {
    $response["response_code"] = 401;
    echo json_encode($response);


} else{

    $user_id = $_POST["user_id"];
    $database = DB_DATABASE;
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

    $query = "SELECT * FROM `CLAIMS` WHERE `USER_ID` = '".$user_id."'";

    $result = mysqli_query($con, $query);
  


    if($result){

        $i = 1;

        $response[0] = array('response_code' => 200);
        // $row = mysqli_fetch_array($result, MYSQLI_NUM);

        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){

            
            // $response[$i]["application_type"] = $row[2];
            // $response[$i]["status"] = $row[3];
            $response[$i] = array('application_type' => $row[2],
                              'status' => $row[3]);


                              $i++;
        }
        $response = array_values($response);
        
        // $response["application_type"] = $row[2];
        // $response["status"] = $row[3];


        echo json_encode($response);


    } else {

        $response["response_code"] = 400;
        echo json_encode($response);


    }

}


?>