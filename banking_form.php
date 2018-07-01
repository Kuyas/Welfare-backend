<?php


require_once __DIR__ . '/db_config.php';



/**
 * This php file
 * 
 */
 //array for JSON response
 $response = array();

 if(isset($_POST['user_id']) && isset($_POST['bank_name']) && isset($_POST['bank_account_num']) && isset($_POST['account_holder_name'])
    && isset($_POST['branch_name']) && isset($_POST['bank_ifsc'])){  

    if (!preg_match("~^[0-9]$~", $_POST['user_id']) ||
        !preg_match("~^[a-zA-Z\ ]{1,100}$~", $_POST['bank_name']) ||
        !preg_match("~^[0-9]{11,13}$~", $_POST['bank_account_num']) ||
        !preg_match("~^[a-zA-Z\ ]{1,100}$~", $_POST['account_holder_name']) ||
        !preg_match("~^[a-zA-Z\ ]{1,100}$~", $_POST['branch_name']) ||
        !preg_match("~^[a-zA-Z]{4}[0-9]{7}$~", $_POST['bank_ifsc'])) {

        // input does not match the corresponding given data types
        $response["response_code"] = 401;

        echo json_encode($response);
    } else {


        $user_id = $_POST['user_id'];
        $bank_name = $_POST['bank_name'];
        $bank_account_num = $_POST['bank_account_num'];
        $account_holder_name = $_POST['account_holder_name'];
        $branch_name = $_POST['branch_name'];
        $bank_ifsc = $_POST['bank_ifsc'];


        // $user_id = stripslashes($user_id);
        // $bank_name = stripslashes($bank_name);
        // $bank_account_num = stripslashes($bank_account_num);
        // $account_holder_name = stripslashes($account_holder_name);
        // $branch_name = stripslashes($branch_name);
        // $bank_ifsc = stripslashes($bank_ifsc);


       //connecting to db
        $database = DB_DATABASE;
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE) or die(mysql_error());

        // $user_id = mysqli_real_escape_string($con, $user_id);
        // $bank_name = mysqli_real_escape_string($con, $bank_name);
        // $bank_account_num = mysqli_real_escape_string($con, $bank_account_num);
        // $account_holder_name = mysqli_real_escape_string($con, $account_holder_name);
        // $branch_name = mysqli_real_escape_string($con, $branch_name);
        // $bank_ifsc = mysqli_real_escape_string($con, $bank_ifsc);


        $query = "INSERT INTO BANKING (USER_ID, BANKING_BANK_NAME, BANKING_ACC_NUMBER, BANKING_ACC_HOLDER_NAME, BANKING_BANK_BRANCH, BANKING_IFSC_CODE) VALUES('".$user_id."', '".$bank_name."', '".$bank_account_num."', '".$account_holder_name."', '".$branch_name."', '".$bank_ifsc."') ON DUPLICATE KEY UPDATE BANKING_BANK_NAME='".$bank_name."', BANKING_ACC_NUMBER='".$bank_account_num."', BANKING_ACC_HOLDER_NAME='".$bank_account."', BANKING_BANK_BRANCH='".$branch_name."', BANKING_IFSC_CODE='".$bank_ifsc."'";

        $result = mysqli_query($con, $query);
      

        if($result){
            // successfully inserted into Payment database
            $result = mysqli_fetch_array($result);
            $response["response_code"] = 200;
            $response["id"] = $result[0];

            echo json_encode($response);
        }else{

            //Login Failed
            $response["response_code"] = 403;
            echo json_encode($response);
        }
    }

 } else {
     //No Values Sent
     $response["response_code"] = 400;
     echo json_encode($response);

 }

?>