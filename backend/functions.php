<?php
require "db.php";

function check_existing_email($email)
{
    global $connection;
    $flag = false;

    $query = "SELECT `id` FROM `users` WHERE `email` = '" . mysqli_escape_string($connection, $email) . "'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $flag = true;
    }
    return $flag;
}


function escape_string($field)
{
    global $connection;
    return mysqli_escape_string($connection, $field);
}