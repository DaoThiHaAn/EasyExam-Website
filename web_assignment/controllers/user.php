
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'user/userDashboard.php';

?>