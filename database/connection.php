<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'facility_management';

    $dsn = "mysql:host=$host;dbname=$dbname";

    $con = new PDO($dsn, $username, $password);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);