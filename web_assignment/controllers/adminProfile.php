<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__.'/../views/admin/adminProfile.php';
?>