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

$user_id = $_SESSION['user_id'] ?? 0;

$sql = "
    SELECT 
        r.result_id,
        t.test_name,
        t.test_category,
        t.count AS total_questions,
        r.start_time,
        r.score
    FROM results r
    JOIN tests t ON r.test_id = t.test_id
    WHERE r.user_id = ?
    ORDER BY r.start_time DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$history = [];
while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}
?>
