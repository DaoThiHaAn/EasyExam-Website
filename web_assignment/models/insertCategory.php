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
    $category = $conn->real_escape_string($_POST["category"]);
    $sql = "INSERT INTO categories (category_name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Incsert new category successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error when deleting category"]);
    }
    
    $stmt->close();
}
$conn->close();
?>
