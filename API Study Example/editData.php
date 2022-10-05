<?php
 
    include 'koneksi.php';
    $response = array();
     
    //Check for mandatory parameters
    if(isset($_POST['nim'])){

        $id = $_POST['nim'];    
        $nim = $_POST['nama'];
        $nama = $_POST['prodi'];
                
        //Query to insert a movie
        $query = "UPDATE mhs SET nim =?, nama=?, prodi=? WHERE nim=?";
        //Prepare the query
        if($stmt = $con->prepare($query)){
            //Bind parameters
            $stmt->bind_param("sss",$nim,$nama,$prodi);
            //Exceting MySQL statement
            $stmt->execute();
            //Check if data got inserted
            if($stmt){
                $response["success"] = 1;           
                $response["message"] = "Sukses Update";          
                
            }else{
                
                $response["success"] = 0;
                $response["message"] = "Gagal Update";
            }                   
        }else{
            //Some error while inserting
            $response["success"] = 0;
            $response["message"] = mysqli_error($con);
        }
     
    }else{
        //Mandatory parameters are missing
        $response["success"] = 0;
        $response["message"] = "tidak ada parameter";
    }
    //Displaying JSON response
    echo json_encode($response);
?>