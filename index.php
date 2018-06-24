<?php
    
    require_once 'user.php';
    
    $mobileNumber = "";
    
    $password = "";
    
    // $email = "";
    
    if(isset($_POST['username'])){
        
        $mobileNumber = $_POST['username'];
        
    }
    
    if(isset($_POST['password'])){
        
        $password = $_POST['password'];
        
    }
    
    // if(isset($_POST['email'])){
        
    //     $email = $_POST['email'];
        
    // }
    
    
    
    $userObject = new User();


    if(!empty($mobileNumber) && !empty($password)){
        
        $hashed_password = md5($password);
        
        $json_array = $userObject->loginUsers($mobileNumber, $hashed_password);
        
        echo json_encode($json_array);
    }
    
    // Registration
    
    if(!empty($mobileNumber) && !empty($password)){
        
        $hashed_password = md5($password);
        
        $json_registration = $userObject->createNewRegisterUser($mobileNumber, $hashed_password);
        
        echo json_encode($json_registration);
        
    }
    
    // Login
    
    if(!empty($mobileNumber) && !empty($password)){
        
        $hashed_password = md5($password);
        
        $json_array = $userObject->loginUsers($mobileNumber, $hashed_password);
        
        echo json_encode($json_array);
    }
    ?>