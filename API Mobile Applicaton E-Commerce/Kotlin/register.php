<?php
 
if($_SERVER['REQUEST_METHOD']=='POST'){
       include_once("config.php");
    
 $postdata = file_get_contents("php://input");
 if (isset($postdata)) {
  $request1 = json_decode($postdata);
  $email = $request1->email;
  $username = $request1->username;
  $password = $request1->password;
   
   if($email == '' || $username == '' || $password == ''){
          echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
   }else{
     
          $query= "SELECT * FROM user WHERE username='$username'";
          $result= mysqli_query($con, $query);
    
          if(mysqli_num_rows($result) > 0){  
             echo json_encode(array( "status" => "false","message" => "Username already exist!") );
          }else{ 
      $query = "INSERT INTO user (email,username,password) VALUES ('$email','$username','$password')";
     if(mysqli_query($con,$query)){
        
         $query= "SELECT * FROM user WHERE username='$username'";
                       $result= mysqli_query($con, $query);
                $emparray = array();
                       if(mysqli_num_rows($result) > 0){  
                       while ($row = mysqli_fetch_assoc($result)) {
                                      $emparray[] = $row;
                                    }
                       }
        echo json_encode(array( "status" => "true","message" => "Successfully registered!" , "data" => $emparray) );
      }else{
       echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
     }
      }
              mysqli_close($con);
   }
 }
} else{
 echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
}
 
 ?>