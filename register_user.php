<?php

require_once __DIR__ . '/db_config.php';

/**
 * Following code will create a new row - for registering a user
 * 
 */

 //array for JSON response
 $response = array();

 //check for required fields
 if(isset($_POST['mobile_number']) && isset($_POST['password'])){
     $mobile_number = $_POST['mobile_number'];
     $password = $_POST['password'];
     $password = md5($password);



    //connecting to db
     $database = DB_DATABASE;
     $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
     $query = "INSERT INTO user(user_mobile, user_password, user_date_created, user_date_modified) VALUES ('$mobile_number','$password', NOW(), NOW())";
     $result = mysqli_query($con, $query);

     //check if row is inserted or not
     if($result){
         //successfully inserted into db
         $response["response_code"] = 1;

         //echoing json response
         echo json_encode($response);
     }else{
         //failed to insert row
         $response["response_code"] = 0;

         //echoing json response
         echo json_encode($response);
     }
    }else{
         //required fields missing
         $response["response_code"] = -1;

         //echoing json response
         echo json_encode($response);
     }


?>