<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['test_id'])) {
    $test_id = intval($_GET['test_id']);
}

$query = "DELETE FROM tests WHERE test_id = $test_id";
$stmt = $mydatabase->query($query);

if ($stmt) {
    echo "<script>alert('Delete test successfully!');
    window.location.href = 'index.php?page=admin';
    </script>";
    exit();
}
else {
    echo "<script>alert('Delete test failed!');</script>";
    exit();
}

?>