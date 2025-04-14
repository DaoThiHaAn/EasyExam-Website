<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 1;
// Truy vấn để lấy danh sách kết quả
$sql = "
    SELECT r.result_id, r.score,r.start_time, r.end_time, r.duration, u.username, t.test_name
    FROM results r
    JOIN users u ON r.user_id = u.user_id
    JOIN tests t ON r.test_id = t.test_id
    WHERE r.test_id = ?
";

// Chuẩn bị và thực thi truy vấn
$stmt = $mydatabase->prepare($sql);
if (!$stmt) {
  die("Lỗi truy vấn SQL: " . $mydatabase->error);
}
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

// Lưu dữ liệu vào một biến để hiển thị sau trong HTML
$resultsData = [];
$test_name = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsData[] = $row;
        $test_name = $row['test_name'];
    }
}
$usernames = [];
$scores = [];

// Gộp những người có điểm giống nhau
$scoreGroups = [];

foreach ($resultsData as $row) {
    $score = $row['score'];
    // Nếu điểm đã có trong mảng $scoreGroups, tăng số lượng lên
    if (isset($scoreGroups[$score])) {
        $scoreGroups[$score]++;
    } else {
        // Nếu điểm chưa có trong mảng, tạo mới
        $scoreGroups[$score] = 1;
    }
}
ksort($scoreGroups);
// Tạo mảng usernames và scores
$usernames = array_keys($scoreGroups);  // Lấy các điểm số
$scores = array_values($scoreGroups);   // Lấy số lượng người có điểm tương ứng

// Chuyển dữ liệu sang JavaScript
$usernamesJson = json_encode($usernames);
echo "<script>console.log($usernamesJson);</script>";
$scoresJson = json_encode($scores);

include 'views/admin/viewHistoryStatistic.php';
?>
