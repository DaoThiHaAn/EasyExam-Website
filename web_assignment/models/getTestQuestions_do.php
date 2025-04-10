<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    $result_id = isset($_SESSION['result_id'])? intval($_SESSION['result_id']):0;


        // Lấy thời gian làm bài (định dạng HH:MM:SS)
    $stmt = $conn->prepare("SELECT test_time FROM tests WHERE test_id = ?");
    $stmt->bind_param("i", $test_id);
    $stmt->execute();
    $timeRes = $stmt->get_result();
    $row = $timeRes->fetch_assoc();
    $test_time_str = $row['test_time'];
    list($hours, $minutes, $seconds) = explode(":", $test_time_str);
    $test_duration = ($hours * 3600) + ($minutes * 60) + $seconds;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Lấy start_time từ bảng results thay vì từ $_SESSION
    $stmt = $conn->prepare("SELECT start_time FROM results WHERE result_id = ?");
    $stmt->bind_param("i", $result_id);
    $stmt->execute();
    $startRes = $stmt->get_result();
    $startRow = $startRes->fetch_assoc();

    $start_time = strtotime($startRow['start_time']); // chuyển về timestamp
    $end_time = $start_time + $test_duration;
    $time_left = max($end_time - time(), 0);
    $now = time();
    // $log = [
    //     'raw_test_time' => $test_time_str,
    //     'h' => $hours,
    //     'm' => $minutes,
    //     's' => $seconds,
    //     'dura' =>$test_duration,
    //     'END' => $end_time,
    //     'now' => $now,
    //     'start' =>$start_time,
    //     'time_left' => $time_left
    // ];
    //file_put_contents('debug_time.log', print_r($log, true));


    $stmt = $conn->prepare("
        SELECT q.*
        FROM test_questions tq
        JOIN questions q ON tq.question_id = q.question_id
        WHERE tq.test_id = ?
        AND q.question_id NOT IN (
            SELECT question_id FROM result_test_questions WHERE result_id = ?
        )
    ");
    $stmt->bind_param("ii", $test_id, $result_id);
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
            'correct_answer' => $row['correct_answer'], // có thể xóa dòng này nếu không cần
            'difficulty'     => $row['difficulty']
        ];
    }

    // Đếm số câu đã làm
    $answered_count = 0;
    if ($result_id > 0) {
        $stmtCount = $conn->prepare("SELECT COUNT(*) FROM result_test_questions WHERE result_id = ?");
        $stmtCount->bind_param("i", $result_id);
        $stmtCount->execute();
        $stmtCount->bind_result($answered_count);
        $stmtCount->fetch();
        $stmtCount->close();
    }


    header('Content-Type: application/json');
    echo json_encode(['questions' => $questions,'time_left' => $time_left,'answered_count' => $answered_count]);
}
?>
