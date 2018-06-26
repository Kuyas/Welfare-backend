<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file is for logging in
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['mobile_number']) && isset($_POST['password'])){   
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];
    $password = md5($password);

    $mobile_number = stripslashes($mobile_number);
    $password = stripslashes($password);

   //connecting to db
    $database = DB_DATABASE;
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
    $mobile_number = mysqli_real_escape_string($con, $mobile_number);
    $password = mysqli_real_escape_string($con, $password);
    
    $query = "SELECT * FROM USER WHERE user_mobile = '". $mobile_number ."' AND user_password = '". $password."'";
<<<<<<< HEAD
=======
    $response["query"] = $query;
>>>>>>> d77b19f5f0729a80a298d2dd2f30db46d3d309a0
    $result = mysqli_query($con, $query);
    $response["result"] = $result;
  
    // $result is a boolean value
    if($result){
        //Login Successfully
        $result = mysqli_fetch_array($result);
        $response["success"] = 1;
        $response["id"] = $result[0];
       
        echo json_encode($response);
    }else{

        //Login Failed
        // $response["result"] = $result;
        $response["success"] = 0;
        // $response["message"] = $mobile_number;
        // $response["messag1"] = $password;
        echo json_encode($response);
    }

 }else{
     //No Values Sent
     $response["success"] = -1;
     echo json_encode($response);

 }

?>