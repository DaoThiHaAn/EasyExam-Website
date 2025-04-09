
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'auth/sign-up.php';
?>