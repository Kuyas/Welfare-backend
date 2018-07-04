<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file
 * 
 */
 //array for JSON response
 $response = array();
 if (isset($_POST['mobile_number']) && isset($_POST['password'])) {   
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    
    if(!preg_match("~^[0-9]{10}$~", $_POST['mobile_number']) || 
        !preg_match("~^[a-zA-Z0-9]{8,16}$~", $_POST['password'])){

        // input does not match the corresponding given data types
        $response["response_code"] = 401;
        echo json_encode($response);
    } else {
        $password = md5($password);


       //connecting to db
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
        $query = "SELECT * FROM TRADING WHERE USER_ID IN (SELECT USER_ID FROM USER WHERE USER_MOBILE='".$mobile_number."' AND USER_PASSWORD='".$password."')";

        $result = mysqli_query($con, $query);


        if($result){
            //Login Successfully
            $response["response_code"] = 200;
            $result = mysqli_fetch_array($result, MYSQLI_NUM);
            $response["firm_name"] = $result[1];
            $response["firm_address"] = $result[2];
            $response["annual_turnover"] = $result[3];
            $response["mtp_branch"] = $result[4];
            $response["mtp_godown"] = $result[5];
            $response["mtp_factory"] = $result[6];
            $response["mtp_others"] = $result[7];
            $response["ownership"] = $result[8];
            $response["capital"] = $result[9];
            $response["gstn"] = $result[10];
            $response["license_num"] = $result[11];
            $response["license_auth"] = $result[12];
            $response["official"] = $result[13];
            echo json_encode($response);
        }else{

            //Login Failed
            $response["response_code"] = 403;
            echo json_encode($response);
        }
    }

 }else{
     //No Values Sent
     $response["response_code"] = 400;
     echo json_encode($response);

 }

?>