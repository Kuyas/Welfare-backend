<?php

require_once __DIR__. '/db_config.php';



 // array for json response
$response = array();
// $x = array


if(!isset($_POST["user_id"])) {
    $response["response_code"] = 400;
    echo json_encode($response);


} else {

    if (!preg_match("~^[0-9]$~", $_POST["user_id"])) {
        $response["resopnse_code"] = 401;
    } else {

        $user_id = $_POST["user_id"];
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        $query = "SELECT * FROM `TRADING` WHERE `USER_ID` = '".$user_id."'";

        $result = mysqli_query($con, $query);
      



        if($result){


            // $response[0] = array('response_code' => 200);
             $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

             $response["response_code"] = 200;
            $response["turnover"] = $row['TRADING_FIRM_ANNUAL_TURNOVER'];
           
            // $response = array_values($response);
            
            // $response["application_type"] = $row[2];
            // $response["status"] = $row[3];
            echo json_encode($response);
        } else {

            $response["response_code"] = 403;
            echo json_encode($response);

        }
    }
}




?>