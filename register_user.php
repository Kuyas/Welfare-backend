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

    if (!preg_match("^[0-9]{10}$", $_POST['mobile_number']) ||
        !preg_match("^[a-zA-Z0-9]{8,16}$", $_POST['password'])) {

        // input does not match the corresponding given data types
        $response["success"] = -2;
        echo json_encode($response);
    } else {

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

        $query = "INSERT INTO user(user_mobile, user_password, user_date_created, user_date_modified) VALUES ('$mobile_number','$password', NOW(), NOW())";
        $result = mysqli_query($con, $query);

        //check if row is inserted or not
        if($result){
            //successfully registered
            $result = mysqli_fetch_array($result);
            $response["response_code"] = 1;
            $response["id"] = $result[0];

            //echoing json response
            echo json_encode($response);
        } else {
            //failed to insert row
            $response["response_code"] = 0;

            //echoing json response
            echo json_encode($response);
        }
    }

} else {
    //required fields missing
    $response["response_code"] = -1;

    //echoing json response
    echo json_encode($response);
}


?>