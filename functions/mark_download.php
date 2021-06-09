<?php
    require "./connect_mysql.php";
    // $sql = "UPDATE domains SET downloaded = 1";
    $sql = "TRUNCATE TABLE domains";
    mysqli_query($conn, $sql);
    // $sql = "UPDATE ips SET downloaded = 1";
    $sql = "TRUNCATE TABLE ips";
    mysqli_query($conn, $sql);
    echo "ok";