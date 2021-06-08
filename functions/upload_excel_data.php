<?php
    require "./connect_mysql.php";
    $data = json_decode($_POST['data']);
    $success = 0;
    for($i = 0; $i < count($data); $i ++){
        if(filter_var($data[$i], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            $sql = "INSERT INTO ips (ip_address) VALUES('$data[$i]')";
            if (mysqli_query($conn, $sql)) {
                $success ++;
            } else {
                $sql = "UPDATE ips SET downloaded=0, state=0 WHERE ip_address='".$data[$i]."'";
                mysqli_query($conn, $sql);
            }
        } else {
            $sql = "INSERT INTO domains (domain) VALUES('$data[$i]')";
            if (mysqli_query($conn, $sql)) {
                $success ++;
            } else {
                $sql = "UPDATE domains SET downloaded=0, state=0 WHERE domain='".$data[$i]."'";
                mysqli_query($conn, $sql);
            } 
        }
    }
    echo $success;