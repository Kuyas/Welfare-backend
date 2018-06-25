<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['user_id']) && isset($_POST['bank_name']) && isset($_POST['bank_account']) && isset($_POST['account_holder_name'])
    && isset($_POST['branch_name']) && isset($_POST['bank_ifsc'])){   
    $user_id = $_POST['user_id'];
    $bank_name = $_POST['bank_name'];
    $bank_account = $_POST['bank_account'];
    $account_holder_name = $_POST['account_holder_name'];
    $branch_name = $_POST['branch_name'];
    $bank_ifsc = $_POST['bank_ifsc'];


   //connecting to db
    $database = DB_DATABASE;
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());
    $query = "INSERT INTO BANKING (USER_ID, BANKING_BANK_NAME, BANKING_ACC_NUMBER, BANKING_ACC_HOLDER_NAME, BANKING_BANK_BRANCH, BANKING_IFSC_CODE) VALUES('".$user_id."', '".$bank_name."', '".$bank_account."', '".$account_holder_name."', '".$branch_name."', '".$bank_ifsc."') ON DUPLICATE KEY UPDATE BANKING_BANK_NAME='".$bank_name."', BANKING_ACC_NUMBER='".$bank_account."', BANKING_ACC_HOLDER_NAME='".$bank_account."', BANKING_BANK_BRANCH='".$branch_name."', BANKING_IFSC_CODE='".$bank_ifsc."'";

    $result = mysqli_query($con, $query);
  

    if($result){
        //Login Successfully
        $response["success"] = 1;
        echo json_encode($response);
    }else{

        //Login Failed
        $response["success"] = 0;
        echo json_encode($response);
    }

 }else{
     //No Values Sent
     $response["success"] = -1;
     echo json_encode($response);

 }

?>