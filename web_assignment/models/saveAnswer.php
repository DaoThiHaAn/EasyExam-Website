<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Kết nối thất bại']);
    exit;
}

// Kiểm tra dữ liệu POST
if (!isset($_POST['question_id'], $_POST['answer'], $_POST['correct_answer'], $_SESSION['result_id'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Thiếu dữ liệu',
        'debug' => $_POST
    ]);
    exit;
}

$question_id = intval($_POST['question_id']);
$answer = $_POST['answer'];
$correct_answer = $_POST['correct_answer'];
$result_id = intval($_SESSION['result_id']);

// Lưu câu trả lời vào result_test_question
$insert = $conn->prepare("INSERT INTO result_test_questions (result_id, question_id, answer) VALUES (?, ?, ?)");
$insert->bind_param("iis", $result_id, $question_id, $answer);
$insert->execute();

// Nếu đúng thì tăng điểm
if (trim($answer) === trim($correct_answer)) {
    $conn->query("UPDATE results SET score = score + 1 WHERE result_id = $result_id");
}

echo json_encode(['success' => true]);
?>
