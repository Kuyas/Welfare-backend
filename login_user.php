<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file is for logging in
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['mobile_number']) && isset($_POST['password'])){  
     
    if(!preg_match("~^[0-9]{10}$~", $_POST['mobile_number']) || !preg_match("~^[a-zA-Z0-9]{8,16}$~", $_POST['password'])){

        $response["success"] = -2;
        echo json_encode($response);

    }else{
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
        
        $query = "SELECT * FROM user WHERE user_mobile = '". $mobile_number ."' AND user_password = '". $password."'" ;
        $result = mysqli_query($con, $query);
    

        if(mysqli_num_rows($result) > 0){
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

    }
}
 else{
     //No Values Sent
     $response["success"] = -1;
     echo json_encode($response);

 }


?>