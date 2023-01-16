<?php
    // connect to database (server name, username, password, database)
    $conn = mysqli_connect('localhost', 'admin', 'admin', 'ubisoft');

    // check connection
    if(!$conn) {
        echo 'Connection error: '.mysqli_connect_error();
    }
    
?>