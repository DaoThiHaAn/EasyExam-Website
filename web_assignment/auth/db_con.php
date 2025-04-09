<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$mydatabase = new mysqli("localhost", "root", "", "web");
if ($mydatabase->connect_error) {
    die("Connection failed: " . $mydatabase->connect_error);
}
?>