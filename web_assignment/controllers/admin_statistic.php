
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/viewHistoryStatistic.php';

?>
