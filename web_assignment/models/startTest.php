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

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 0;

if ($test_id > 0) {
    // Kiểm tra xem đã có result chưa để tránh tạo nhiều lần nếu người F5
    $stmt = $conn->prepare("SELECT result_id FROM results WHERE user_id = ? AND test_id = ? ORDER BY result_id DESC LIMIT 1");
    $stmt->bind_param("ii", $user_id, $test_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        // Chưa có thì tạo mới
        $insert = $conn->prepare("INSERT INTO results (user_id, test_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $test_id);
        if ($insert->execute()) {
            $_SESSION['result_id'] = $insert->insert_id;
            $response['success'] = true;
            $response['result_id'] = $insert->insert_id;
        }
    } else {
        // Đã có thì lấy ID cũ
        $stmt->bind_result($result_id);
        $stmt->fetch();
        $_SESSION['result_id'] = $result_id;
        $response['success'] = true;
        $response['result_id'] = $result_id;
    }
}
echo json_encode($response);
?>
