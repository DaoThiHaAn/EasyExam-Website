<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = isset($_GET['page']) ? $_GET['page'] : 'adminDashboard';
include __DIR__.'/../views/admin/adminDashboard.php';
?>