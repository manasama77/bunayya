<?php

include 'configuration/config_connect.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $query = "select count(*) as cntUser from user where email='".$email."'";
    
    $result = mysqli_query($conn,$query);
    $response = "<span style='color: green;'>Tersedia.</span>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cntUser'];
        
        if($count > 0){
            $response = "<span style='color: red;'>Sudah dipakai.</span>";
        }
       
    }
    
    echo $response;
    die;
}


