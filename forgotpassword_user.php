<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['user_id']) && isset($_POST['password'])){   
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    
    if (!preg_match("~^[a-zA-Z0-9]{8,16}$~", $_POST['password'])) {

        // input does not match the corresponding given data types
        $response["response_code"] = -2;
        echo json_encode($response);
    } else {
        $password = md5($password);


       //connecting to db
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
        $query = "UPDATE USER SET USER_PASSWORD = '".$password."' WHERE USER_ID = '".$user_id."'";

        $result = mysqli_query($con, $query);
      

        if($result){
            //Login Successfully
            $response["response_code"] = 1;
            echo json_encode($response);
        }else{

            //Login Failed
            $response["response_code"] = 0;
            echo json_encode($response);
        }
    }

 }else{
     //No Values Sent
     $response["response_code"] = -1;
     echo json_encode($response);

 }

?>