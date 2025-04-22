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

// Pagination variables
$perPage = 10; // Number of entries per page
$page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$page = max($page, 1); // Ensure the page is at least 1
$offset = ($page - 1) * $perPage;

// Fetch the total number of entries
$totalQuery = "SELECT COUNT(*) as total FROM results WHERE user_id = ?";
$stmt = $conn->prepare($totalQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$totalResult = $stmt->get_result()->fetch_assoc();
$totalEntries = $totalResult['total'];
$totalPages = ceil($totalEntries / $perPage);

// Fetch paginated results
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
    LIMIT ? OFFSET ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $perPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

$history = [];
while ($row = $result->fetch_assoc()) {
    $history[] = $row;
}
?>
