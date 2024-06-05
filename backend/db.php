<?php

    // Db credentials Web
    $host_name = "localhost";
    $db_name = "kainan_db";
    $username = "root";
    $password = "";

    // Connect to a databse (hostname, username, password and database name)
    $connection = mysqli_connect($host_name, $username, $password, $db_name);

    if(!$connection) {
        die("Connection failed : " . mysqli_connect_error());
    }
