<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST['name']) ? (int)$_POST['name'] : 0;
    
    if ($name > 0) {
        $sql = "DELETE FROM categories WHERE category_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $name);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Xóa chủ đề thành công."]);
        } else {
            echo json_encode(["success" => false, "message" => "Lỗi khi xóa chủ đề."]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Tên chủ đề không hợp lệ."]);
    }
}
$conn->close();
?>
