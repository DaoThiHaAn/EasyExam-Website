<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$tests = [];
$sql = "SELECT test_id, test_name, test_category, created_by FROM tests ORDER BY test_id DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $tests[] = $row;
}

include 'views/admin/adminDashboard.php';

?>
<script>
	console.log(<?= json_encode($_SESSION) ?>);
</script>