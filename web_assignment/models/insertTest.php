<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $test_name = $conn->real_escape_string($_POST['test_name']);
    $test_category = $conn->real_escape_string($_POST['test_category']);
    $test_time = $conn->real_escape_string($_POST['test_time']);

    $created_by = (int)$_POST['created_by'];
    $question_ids = $_POST['question_ids']; // Mảng ID câu hỏi
    $count = is_array($question_ids) ? count($question_ids) : 0;
    // Chèn vào bảng tests
    $sql = "INSERT INTO web.tests (test_name,test_category, test_time, created_by,count) VALUES ('$test_name','$test_category', '$test_time', $created_by,$count)";
    if ($conn->query($sql) === TRUE) {
        $test_id = $conn->insert_id;
        
        // Chèn vào bảng test_questions
        foreach ($question_ids as $question_id) {
            $question_id = (int)$question_id;
            $conn->query("INSERT INTO test_questions (test_id, question_id) VALUES ($test_id, $question_id)");
        }
        echo "Bài kiểm tra và câu hỏi đã được thêm thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
$conn->close();
?>