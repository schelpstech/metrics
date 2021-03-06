<?php

// begin or resume session
session_start();

// Include necessary file
include_once 'User.class.php';
include_once 'Model.class.php';

// database access parameters
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'crunch_mart_%@001';

// connect to database
try {
    $db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}



// make use of database with users
$user = new User($db_conn);
$model = new Model($db_conn);