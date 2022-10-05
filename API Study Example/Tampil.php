<?php
 
    include 'koneksi.php';

    $movieArray = array();
    $response = array();

    $query = ("SELECT * FROM mhs") ;
    // print_r($query);
    // exit();

    $result = array();
        //Prepare the query
    if($stmt = $con->prepare($query)){
        $stmt->execute();            
        $stmt->bind_result($nim,$nama,$prodi);
        
        while($stmt->fetch()){
            $movieArray = array();                    
            $movieArray["nim"] = $nim;
            $movieArray["nama"] = $nama;                
            $movieArray["prodi"] = $prodi;
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