<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'facility_management';

    $con = mysqli_connect($host, $username, $password, $database);

    if (mysqli_error($con)) {
        echo 'not connected';
    } 