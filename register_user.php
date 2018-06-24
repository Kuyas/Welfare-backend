<?php

require_once __DIR__ . '/db_config.php';

/**
 * Following code will create a new row
 * All product details are read from HTTP Post Request
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
     $query = "INSERT INTO users(mobile_number, password, created_at, updated_at) VALUES ('$mobile_number','$password', NOW(), NOW())";
     $result = mysqli_query($con, $query);

     //check if row is inserted or not
     if($result){
         //successfully inserted into db
         $response["success"] = 1;

         //echoing json response
         echo json_encode($response);
     }else{
         //failed to insert row
         $response["success"] = 0;

         //echoing json response
         echo json_encode($response);
     }
    }else{
         //required fields missing
         $response["success"] = -1;

         //echoing json response
         echo json_encode($response);
     }


?>