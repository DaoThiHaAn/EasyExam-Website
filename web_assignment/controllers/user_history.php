
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/profile/viewHistoryUser.php';
?>
