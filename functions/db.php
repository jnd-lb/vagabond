<?php

function openDatabaseConnection() {
    
    $servername = "localhost";
    $username = "admin";
    $password = "123456";
    $dbname = "vagabonddb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function closeDatabaseConnection($conn) {
    mysqli_close($conn);
}
?>
