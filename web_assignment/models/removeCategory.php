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
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    
    if ($name > 0) {
        $sql = "DELETE FROM categories WHERE category_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Delete Category successfully!."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error deleting category!."]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Category name is invalid!."]);
    }
}
$conn->close();
?>
