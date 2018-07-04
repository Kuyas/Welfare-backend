<?php

require_once __DIR__. '/db_config.php';

 // array for json response
$response = array();
// $x = array

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
        $query = "SELECT * FROM FAMILY WHERE USER_ID IN (SELECT USER_ID FROM USER WHERE USER_MOBILE='".$mobile_number."' AND USER_PASSWORD='".$password."')";

        $result = mysqli_query($con, $query);

        if($result){
            $i = 1;
            $response[0] = array('response_code' => 200);
            // $row = mysqli_fetch_array($result, MYSQLI_NUM);

            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){                
                // $response[$i]["application_type"] = $row[2];
                // $response[$i]["status"] = $row[3];
                $response[$i] = array('name' => $row[2], 'age' => $row[3], 'gender' => $row[4],
                    'occupation' => $row[5], 'relationship' => $row[6]);
                $i++;
            }
            $response = array_values($response);
            // $response["application_type"] = $row[2];
            // $response["status"] = $row[3];
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