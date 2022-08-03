<?php
    require_once('config/config.php');

    # Connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
        
?>