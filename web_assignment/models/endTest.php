<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


if (!isset($_GET['result_id'])) {
    echo json_encode(['success' => false, 'message' => 'Thiếu result_id']);
    exit;
}

$resultId = (int) $_GET['result_id'];

// Lấy start_time từ DB
$sql = "SELECT start_time FROM results WHERE result_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $resultId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy result_id']);
    exit;
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$row = $result->fetch_assoc();
$startTime = strtotime($row['start_time']);
$endTime = time(); // hiện tại
$duration = $endTime - $startTime;

$sqlUpdate = "UPDATE results SET end_time = FROM_UNIXTIME(?), duration = ? WHERE result_id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("iii", $endTime, $duration, $resultId);

if ($stmtUpdate->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật DB']);
}
?>
