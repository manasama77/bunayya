<?php

include 'configuration/config_connect.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $query = "select count(*) as cntUser from user where email='".$email."'";
    
    $result = mysqli_query($conn,$query);
    $response = "<span style='color: green;'>Sedang anda pakai.</span>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cntUser'];
        
        if($count > 1){
            $response = "<span style='color: red;'>Sudah dipakai orang lain.</span>";
        }
       
    }
    
    echo $response;
    die;
}


