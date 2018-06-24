<?php
    
    include_once 'db-connect.php';
    
    class User{
        
        private $db;
        
        private $db_table = "users";
        
        public function __construct(){
            $this->db = new DbConnect();
        }
        
        public function isLoginExist($mobileNumber, $password){
            
            $query = "select * from ".$this->db_table." where mobileNumber = '$mobileNumber' AND password = '$password' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
                mysqli_close($this->db->getDb());
                
                
                return true;
                
            }
            
            mysqli_close($this->db->getDb());
            
            return false;
            
        }
        
        // public function isEmailmobileNumberExist($mobileNumber, $email){
            
        //     $query = "select * from ".$this->db_table." where mobileNumber = '$mobileNumber' AND email = '$email'";
            
        //     $result = mysqli_query($this->db->getDb(), $query);
            
        //     if(mysqli_num_rows($result) > 0){
                
        //         mysqli_close($this->db->getDb());
                
        //         return true;
                
        //     }
            
            
        //     return false;
            
        // }
        
        // public function isValidEmail($email){
        //     return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        // }

        public function ismobileNumberExist($mobileNumber){
            
            $query = "select * from ".$this->db_table." where mobileNumber = '$mobileNumber'";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
                mysqli_close($this->db->getDb());
                
                return true;
                
            }
            
            
            return false;
            
        }
        
      
        
        
        public function createNewRegisterUser($mobileNumber, $password){
            
            
            $isExisting = $this->ismobileNumberExist($mobileNumber);
            
            
            if($isExisting){
                
                $json['success'] = 0;
                $json['message'] = "Error in registering. The Mobile Number already exists";
            }
            
            else{
                
            // $isValid = $this->isValidEmail($email);
                
                if(true)
                {
                $query = "insert into ".$this->db_table." (mobileNumber, password, created_at, updated_at) values ('$mobileNumber', '$password', NOW(), NOW())";
                
                $inserted = mysqli_query($this->db->getDb(), $query);
                
                if($inserted == 1){
                    
                    $json['success'] = 1;
                    $json['message'] = "Successfully registered the user";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Error in registering. Please try again";
                    
                }
                
                mysqli_close($this->db->getDb());
                }
                // else{
                //     $json['success'] = 0;
                //     $json['message'] = "Error in registering. Email Address is not valid";

                
                // }
                
            }
            
            return $json;
            
        }
        
        public function loginUsers($mobileNumber, $password){
            
            $json = array();
            
            $canUserLogin = $this->isLoginExist($mobileNumber, $password);
            
            if($canUserLogin){
                
                $json['success'] = 1;
                $json['message'] = "Successfully logged in";
                
            }else{
                $json['success'] = 0;
                $json['message'] = "Incorrect details";
            }
            return $json;
        }
    }
    ?>