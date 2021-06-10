<?php
    // $servername = "localhost";
    $servername = "3.138.169.141";
    // $username = 'root';
    $username = "cooker";
    // $password = '';
    $password = "Password123$";
    
    $dbname = "scraping";

    $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }