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

function validate_save_profile($fname, $lname, $address, $contact_number, $email, $password){
    $validation_errors = [];

    if (!$_POST['fname']) {
        $validation_errors[] = "First Name is Required.";
    }

    if (!$_POST['lname']) {
        $validation_errors[] = "Last Name is Required.";
    }

    if (!$_POST['address']) {
        $validation_errors[] = "Address is Required.";
    }

    if (!$_POST['contact_number']) {
        $validation_errors[] = "Contact Number is Required.";
    }

    if (!$_POST['email']) {
        $validation_errors[] = "Email is Required.";
    }

    if (!$_POST['password']) {
        $validation_errors[] = "Password is Required.";
    }

    return $validation_errors;
}

function save_registration($fname, $lname, $address, $contact_number, $email, $password)
{
    global $connection;
    $users = [];

    $account_type = 'user';
    $query = "INSERT INTO `users` (`fname`, `lname`, `address`, `contact_number`, `email`, `password`, `account_type`) VALUES ('" . escape_string($fname) . "','" . escape_string($lname) . "','" . escape_string($address) . "', '". escape_string($contact_number) ."','" . escape_string($email) . "', '" . escape_string($password) . "', '" .$account_type."')";
    if (mysqli_query($connection, $query)) {
        $id = mysqli_insert_id($connection);
        $encrypted_password = md5(md5($id . $password)); //convert password to hash

        $query = "UPDATE `users` SET `password` = '" . $encrypted_password . "' WHERE `users`.`id` = '" . $id . "'";
        if (mysqli_query($connection, $query)) {
            $query = "SELECT * FROM `users` WHERE `users`.`password` = '" . escape_string($encrypted_password) . "' LIMIT 1";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($result);
            if (!empty($rows)) {
                $users = [
                    "id" => $row['id'],
                    "email" => $row['email']
                ];
            }
        }
    }
    return $users;
}

function validate_login_request($email, $password){
    $validation_errors = [];

    if (!$_POST['email']) {
        $validation_errors[] = "Email is Required.";
    }

    if (!$_POST['password']) {
        $validation_errors[] = "Password is Required.";
    }

    return $validation_errors;
}

function login_account($email, $password)
{
    global $connection;
    $user = [];

    $query = "SELECT * FROM `users` WHERE `users`.`email`='" . escape_string($email) . "' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if (!empty($row)) {
        $hash_password = md5(md5($row['id'] . $password));
        if ($hash_password == $row['password']) {
            $user = [
                "id" => $row['id'],
                "fname" => $row['fname'],
                "lname" => $row['lname'],
                "email" => $row['email']
            ];
        }
    }

    return $user;
}
