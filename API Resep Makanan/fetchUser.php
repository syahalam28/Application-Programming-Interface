<?php
 
    include 'koneksi.php';

    $movieArray = array();
    $response = array();

    $query = ("SELECT * FROM user") ;
    // print_r($query);
    // exit();

    $result = array();
        //Prepare the query
    if($stmt = $con->prepare($query)){
        $stmt->execute();            
        $stmt->bind_result($id,$nama,$email,$password);
        
        while($stmt->fetch()){
            $movieArray = array();                    
            $movieArray["user_id"] = $id;               
            $movieArray["nama"] = $nama;
            $movieArray["email"] = $email;
            $movieArray["password"] = $password;  
            $result[]=$movieArray;
            
        }
        $stmt->close();
        $response["success"] = 1;
        $response["data"] = $result;
        
     
    }else{
        $response["success"] = 0;
        $response["message"] = mysqli_error($con);
            
        
    }

    //Display JSON response
    echo json_encode($response);
?>