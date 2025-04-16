
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "web");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if (!isset($_GET['result_id']) || intval($_GET['result_id']) <= 0) {
    if (isset($_GET['test_id'])) {
        $test_id = intval($_GET['test_id']);
        // admin passes username
        $user_id = $_SESSION['role'] == "user" ? intval($_SESSION['user_id']) : intval($_GET['user_id']);

        $findResultSql = "SELECT result_id FROM results WHERE test_id = ? AND user_id = ?";
        $stmt = $conn->prepare($findResultSql);
        if (!$stmt) {
            die("Preparation SQL Error: " . $conn->error);
        }
        $stmt->bind_param("ii", $test_id, $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $found = $res->fetch_assoc();

        if ($found) {
            $result_id = $found['result_id'];
        } else {
            echo "Unable to find result ID for the test!";
            exit;
        }
    } else {
        echo "Unable to find result ID for the test!";
        exit;
    }
} else {
    $result_id = intval($_GET['result_id']);
}

// Lưu vào session nếu muốn sử dụng sau
$_SESSION['result_id'] = $result_id;


// Lấy điểm và tổng số câu hỏi
$scoreSql = "SELECT COUNT(*) AS total_questions, SUM(rtq.answer = q.correct_answer) AS score
             FROM result_test_questions rtq
             JOIN questions q ON rtq.question_id = q.question_id
             WHERE rtq.result_id = ?";
$stmt = $conn->prepare($scoreSql);
$stmt->bind_param("i", $result_id);
$stmt->execute();
$scoreResult = $stmt->get_result()->fetch_assoc();
$score = $scoreResult['score'] ?? 0;
$total_questions = $scoreResult['total_questions'] ?? 0;

// Lấy chi tiết câu hỏi
$sql = "SELECT q.question_text, q.option_a, q.option_b, q.option_c, q.option_d,
               rtq.answer, q.correct_answer
        FROM result_test_questions rtq
        JOIN questions q ON rtq.question_id = q.question_id
        WHERE rtq.result_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $result_id);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

include 'views/viewResultUser.php';
?>
