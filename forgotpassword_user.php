<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['mobile_number']) && isset($_POST['password'])){   
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $password = md5($password);


   //connecting to db
    $database = DB_DATABASE;
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
    $query = "UPDATE USER SET `USER_PASSWORD`='".$password."', `USER_DATE_MODIFIED`=NOW() WHERE `USER_MOBILE`='".$mobile_number."'";

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

 }else{
     //No Values Sent
     $response["response_code"] = -1;
     echo json_encode($response);

 }

?>