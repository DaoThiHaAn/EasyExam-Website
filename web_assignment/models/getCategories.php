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

// Lấy danh mục
$categoryQuery = "SELECT category_name FROM categories";
$categoryResult = $conn->query($categoryQuery);
$categories = [];
while ($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row;
}
?>