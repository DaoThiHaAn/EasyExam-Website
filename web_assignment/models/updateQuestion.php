<?php

header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST["id"];

    // Lấy dữ liệu cũ từ database
    $query = "SELECT category_name, question_text, option_a, option_b, option_c, option_d, correct_answer, difficulty, picture_link FROM questions WHERE question_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode([
            "post_data" => $_POST,
            "success" => false,
            "message" => "Câu hỏi không tồn tại!"
        ]);
        exit;
    }

    $row = $result->fetch_assoc();

    // Giữ nguyên giá trị cũ nếu không có thay đổi
    $category_name = !empty($_POST["category_name"]) ? $_POST["category_name"] : $row['category_name'];
    $question_text = !empty($_POST["question_text"]) ? $_POST["question_text"] : $row['question_text'];
    $option_a = !empty($_POST["option_a"]) ? $_POST["option_a"] : $row['option_a'];
    $option_b = !empty($_POST["option_b"]) ? $_POST["option_b"] : $row['option_b'];
    $option_c = !empty($_POST["option_c"]) ? $_POST["option_c"] : $row['option_c'];
    $option_d = !empty($_POST["option_d"]) ? $_POST["option_d"] : $row['option_d'];
    $correct_answer = !empty($_POST["correct_answer"]) ? $_POST["correct_answer"] : $row['correct_answer'];
    $difficulty = !empty($_POST["difficulty"]) ? $_POST["difficulty"] : $row['difficulty'];
    $image = !empty($_POST["image"]) ? $_POST["image"] : $row['picture_link'];

    // Kiểm tra và xử lý ảnh nếu có
    if (isset($_FILES["image"])) {
        $imageFile = $_FILES["image"];
        if ($imageFile["error"] == 0) {
            $targetDir = "../images/"; // Thư mục lưu ảnh
            $fileName = basename($imageFile["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedTypes = ["jpg", "jpeg", "png", "gif"];

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($imageFile["tmp_name"], $targetFilePath)) {
                    $image = "images/" . $fileName;
                } else {
                    echo json_encode(["success" => false, "message" => "Lỗi khi tải ảnh lên!"]);
                    exit;
                }
            } else {
                echo json_encode(["success" => false, "message" => "Chỉ chấp nhận file JPG, JPEG, PNG, GIF!"]);
                exit;
            }
        }
    }

    // Cập nhật database
    $sql = "UPDATE questions SET category_name=?, question_text=?, option_a=?, option_b=?, option_c=?, option_d=?, correct_answer=?, difficulty=?, picture_link=? WHERE question_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $category_name, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $difficulty, $image, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cập nhật câu hỏi thành công!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật câu hỏi!"]);
    }
}

$conn->close();
?>
