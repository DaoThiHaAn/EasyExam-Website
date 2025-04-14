<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$test_id = intval($_GET['test_id']);
$query = "SELECT 
q.category_name,
q.question_text,
q.correct_answer,
q.option_a,
q.option_b,
q.option_c,
q.option_d,
q.picture_link,
q.difficulty
FROM test_questions as tq
JOIN questions as q ON tq.question_id = q.question_id
WHERE tq.test_id = ?";
// Prepare the statement
$stmt = $mydatabase->prepare($query);
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

// Create an array to store each question row
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}
$query = "SELECT * FROM tests WHERE test_id = $test_id";
$test = $mydatabase->query($query);
$test = $test->fetch_array();

$query = "SELECT username FROM users WHERE user_id = $test[created_by]";
$creator = $mydatabase->query($query);
$creator = $creator->fetch_array()['username'];

include __DIR__.'/../views/admin/viewTestDetail.php';
?>