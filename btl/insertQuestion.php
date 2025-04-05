<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"] ?? "";
    $question_text = $_POST["question_text"] ?? "";
    $option_a = $_POST["option_a"] ?? "";
    $option_b = $_POST["option_b"] ?? "";
    $option_c = $_POST["option_c"] ?? "";
    $option_d = $_POST["option_d"] ?? "";
    $correct_answer = $_POST["correct_answer"] ?? "";
    $difficulty = $_POST["difficulty"] ?? "";
    $imagePath = ""; // Mặc định không có ảnh

    // Kiểm tra upload ảnh
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../images/"; // Thư mục lưu ảnh
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = basename($_FILES["image"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($fileType, $allowedTypes)) {
            $newFileName = uniqid("question_") . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $imagePath = "images/" . $newFileName;
            } else {
                echo json_encode(["success" => false, "message" => "Lỗi khi tải ảnh lên!"]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Chỉ chấp nhận file JPG, JPEG, PNG, GIF!"]);
            exit;
        }
    }

    // Thêm dữ liệu vào database
    $sql = "INSERT INTO questions (category_name, question_text, option_a, option_b, option_c, option_d, correct_answer, difficulty, picture_link)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $category_name, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $difficulty, $imagePath);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Thêm câu hỏi thành công!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi thêm câu hỏi!"]);
    }
}

$conn->close();
?>
