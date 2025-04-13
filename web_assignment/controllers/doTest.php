
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$test = $mydatabase->query("SELECT test_name, test_category FROM tests WHERE test_id = {$_GET['test_id']}");
$test = $test->fetch_array();
if (!$test) {
    echo "<script>alert('Not found test! Try again!');</script>";
    exit;
}

include 'views/viewDoTest.php';

?>
