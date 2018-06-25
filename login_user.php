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
    $query = "SELECT `user_mobile`, `user_password` FROM `user` WHERE `user_mobile` = '.$mobile_number.' AND `user_password` = '.$password.'";
    
    $result = mysqli_query($con, $query);
  

    if($result){
        //Login Successfully
        $response["success"] = 1;
        echo json_encode($response);
    }else{

        //Login Failed
        $response["result"] = $result;
        $response["success"] = 0;
        $response["message"] = $mobile_number;
        $response["messag1"] = $password;
        echo json_encode($response);
    }

 }else{
     //No Values Sent
     $response["success"] = -1;
     echo json_encode($response);

 }

?>