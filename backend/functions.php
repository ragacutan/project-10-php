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

function validate_save_profile($fname, $lname, $address, $contact_number, $email, $password)
{
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
    $query = "INSERT INTO `users` (`fname`, `lname`, `address`, `contact_number`, `email`, `password`, `account_type`) VALUES ('" . escape_string($fname) . "','" . escape_string($lname) . "','" . escape_string($address) . "', '" . escape_string($contact_number) . "','" . escape_string($email) . "', '" . escape_string($password) . "', '" . $account_type . "')";
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

function validate_login_request($email, $password)
{
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

function get_categories()
{
    global $connection;
    $categories = [];
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $categories = $result;
    }

    return $categories;
}



function create_booking($user_id, $category_id, $date, $time, $remarks)
{
    global $connection;
    $flag = false;

    $date_created = date("Y-m-d H:i:s");
    $query = "INSERT INTO `bookings` (`user_id`, `category_id`, `date`, `time`, `remarks`, `date_created`) VALUES ('" . mysqli_real_escape_string($connection, $user_id) . "', '" . mysqli_real_escape_string($connection, $category_id) . "', '" . mysqli_real_escape_string($connection, $date) . "', '" . mysqli_real_escape_string($connection, $time) . "', '" . mysqli_real_escape_string($connection, $remarks) . "', '" . $date_created . "')";

    if (mysqli_query($connection, $query)) {
        $flag = true;
    }

    // echo("Error description: " . mysqli_error($connection));
    return $flag;
}

function get_my_booking($user_id)
{
    global $connection;
    $my_bookings = [];

    $query = "SELECT `b`.`id` as `booking_id`, `b`.`date`, `b`.`time`, `c`.`category_name`, `b`.`remarks`,`b`.`date_created` FROM `bookings` as `b`
    INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id`
    WHERE `user_id` = '" . mysqli_real_escape_string($connection, $user_id) . "' 
    ORDER BY `b`.`id` DESC";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $my_bookings = $result;
    }

    return $my_bookings;
}
function get_all_booking()
{
    global $connection;
    $all_bookings = [];

    // $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` ORDER BY `b`.`id` DESC LIMIT 6";
    $query = "SELECT `b`.`id` as `booking_id`, `b`.`date`, `b`.`time`, `c`.`category_name`, `b`.`remarks`, `b`.`date_created`, `u`.`id` as `user_id`, `u`.`fname`, `u`.`lname`, `u`.`contact_number`
    FROM `bookings` as `b` 
    INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` 
    INNER JOIN `users` as `u` ON `u`.`id` = `b`.`user_id` 
    ORDER BY `b`.`id` DESC";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $all_bookings = $result;
    }

    return $all_bookings;
}

function get_all_users() {
    global $connection;
    $all_users = [];

    // SQL query to select all users
    $query = "SELECT `id`, `fname`, `lname`, `address`, `contact_number`, `email` FROM `users` WHERE `account_type` = 'user' ORDER BY `id` DESC";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $all_users[] = $row;
        }
    }

    return $all_users;
}
function display_booking_preview($field, $length)
{
    return substr($field, 0, $length);
}
