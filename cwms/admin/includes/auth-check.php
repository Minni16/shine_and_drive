<?php
// Authentication and authorization check for admin pages
// Include this file at the top of admin pages after session_start() and config.php

// Check if user is logged in
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
    exit();
}

// Check if user has admin role
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // User is logged in but not an admin - redirect to home
    session_destroy();
    header('location:index.php');
    exit();
}
?>

