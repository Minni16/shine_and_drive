<?php
if(!isset($_SESSION['alogin']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'user')
{
    echo "<script type='text/javascript'> document.location = '../login.php'; </script>";
}
?>

