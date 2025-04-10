<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (isset($_GET['test_id'])) {
    $test_id = intval($_GET['test_id']);

    $stmt = $conn->prepare("
        SELECT q.*
        FROM test_questions tq
        JOIN questions q ON tq.question_id = q.question_id
        WHERE tq.test_id = ?
    ");
    $stmt->bind_param("i", $test_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];

    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            'question_id'    => $row['question_id'],
            'question_text'  => $row['question_text'],
            'option_a'       => $row['option_a'],
            'option_b'       => $row['option_b'],
            'option_c'       => $row['option_c'],
            'option_d'       => $row['option_d'],
            'picture_link'   => $row['picture_link'],
            'correct_answer' => $row['correct_answer'], // có thể ẩn nếu không cần
            'difficulty'     => $row['difficulty']
        ];
    }

    header('Content-Type: application/json');
    echo json_encode(['questions' => $questions]);
}
?>
