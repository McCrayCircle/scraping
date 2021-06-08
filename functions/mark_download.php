<?php
    require "./connect_mysql.php";
    $sql = "UPDATE domains SET downloaded = 1";
    mysqli_query($conn, $sql);
    $sql = "UPDATE ips SET downloaded = 1";
    mysqli_query($conn, $sql);
    echo "ok";