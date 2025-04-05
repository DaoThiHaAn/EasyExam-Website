<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Kết nối MySQL bằng MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Nhận test_id từ request (hoặc có thể đặt giá trị cố định)
$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 1;

// Truy vấn để lấy danh sách kết quả
$sql = "
    SELECT r.result_id, r.score, u.name 
    FROM results r
    JOIN users u ON r.user_id = u.user_id
    WHERE r.test_id = ?
";

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

// Hiển thị kết quả
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Result ID</th><th>Score</th><th>User Name</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['result_id']}</td>
                <td>{$row['score']}</td>
                <td>{$row['name']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Không có kết quả nào cho test_id = $test_id";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
