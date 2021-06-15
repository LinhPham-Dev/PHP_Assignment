<?php 
    // Connect to database
    $conn = mysqli_connect('localhost', 'linhpn', '18122002', 'php_btl');
    // Check connect
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>