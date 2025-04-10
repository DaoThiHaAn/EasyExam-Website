<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './views/mainview/category.php';
?>