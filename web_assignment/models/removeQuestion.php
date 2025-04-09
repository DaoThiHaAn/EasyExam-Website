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
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    
    if ($id > 0) {
        $sql = "DELETE FROM questions WHERE question_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("Content-Type: application/json");
            echo json_encode(["success" => true, "message" => "Xóa câu hỏi thành công."]);
        } else {
            header("Content-Type: application/json");
            echo json_encode(["success" => false, "message" => "Lỗi khi xóa câu hỏi."]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "ID câu hỏi không hợp lệ."]);
    }
}
$conn->close();
?>
