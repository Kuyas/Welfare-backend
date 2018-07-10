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
        $query = "SELECT * FROM OTHER WHERE USER_ID IN (SELECT USER_ID FROM USER WHERE USER_MOBILE='".$mobile_number."' AND USER_PASSWORD='".$password."')";

        $result = mysqli_query($con, $query);


        if($result){
            //Login Successfully
            $response["response_code"] = 200;
            $result = mysqli_fetch_array($result, MYSQLI_NUM);
            $response["emv_main_branch"] = $result[1];
            $response["emv_branch"] = $result[2];
            $response["emv_godown"] = $result[3];
            $response["emv_factory"] = $result[4];
            $response["emv_others"] = $result[5];
            $response["ara_main"] = $result[6];
            $response["ara_branch"] = $result[7];
            $response["ara_godown"] = $result[8];
            $response["ara_factory"] = $result[9];
            $response["ara_other"] = $result[10];
            $response["organisation"] = $result[11];
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