<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$conn = new mysqli("localhost", "root", "", "web");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);



if (!isset($_GET['result_id']) || intval($_GET['result_id']) <= 0) {
    if (isset($_GET['test_id'])) {
        $test_id = intval($_GET['test_id']);
        $user_id = intval($_SESSION['user_id']);

        $findResultSql = "SELECT result_id FROM results WHERE test_id = ? AND user_id = ?";
        $stmt = $conn->prepare($findResultSql);
        if (!$stmt) {
            die("Lỗi prepare SQL: " . $conn->error);
        }
        $stmt->bind_param("ii", $test_id, $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $found = $res->fetch_assoc();

        if ($found) {
            $result_id = $found['result_id'];
        } else {
            echo "Không tìm thấy kết quả bài làm.haha";
            exit;
        }
    } else {
        echo "Không tìm thấy kết quả bài làm123";
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
?>


<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>Kết quả</title>
 <!-- <link rel="stylesheet" href="css/style.css"> -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
  MathJax = {
    tex: {
      inlineMath: [['$', '$']], // Kích hoạt công thức nội dòng với $
      displayMath: [['$$', '$$']] // Công thức độc lập với $$
    }
  };
</script>
<script type="text/javascript" async
  src="https://polyfill.io/v3/polyfill.min.js?features=es6">
</script>
<script type="text/javascript" async
  id="MathJax-script" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="text-center">
        <h2 class="mb-4">🎉 Result of your Test</h2>
        <p><strong>Score:</strong> <?= $score ?> / <?= $total_questions ?></p>
    </div>

    <div class="mt-4">
        <h4>Answer details:</h4>
        <div id="question-table-container"></div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <button id="prevPage" class="btn btn-secondary">⬅️ Previous</button>
            <span id="pageInfo"></span>
            <button id="nextPage" class="btn btn-secondary">Next ➡️</button>
        </div>
    </div>

    <a href="index.php?page=user" class="btn btn-secondary mt-4">🔙 Back to DashBoard</a>
</div>

<script>
    const questions = <?= json_encode($questions) ?>;
    const perPage = 5;
    let currentPage = 1;

    function renderTable() {
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        const pageQuestions = questions.slice(start, end);

        let html = `
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 25%">Question</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
        `;

        pageQuestions.forEach(q => {
            const isCorrect = q.answer === q.correct_answer;
            html += `
                <tr class="${isCorrect ? 'table-success' : 'table-danger'}">
                    <td>${q.question_text}</td>
                    <td>A. ${q.option_a}</td>
                    <td>B. ${q.option_b}</td>
                    <td>C. ${q.option_c}</td>
                    <td>D. ${q.option_d}</td>
                    <td><strong>${q.answer}</strong></td>
                    <td><strong>${q.correct_answer}</strong></td>
                    <td>${isCorrect ? '✅ True' : '❌ False'}</td>
                </tr>
            `;
        });

        html += '</tbody></table>';
        document.getElementById('question-table-container').innerHTML = html;
        document.getElementById('pageInfo').textContent = `Trang ${currentPage} / ${Math.ceil(questions.length / perPage)}`;
        if (window.MathJax) MathJax.typeset();
    }

    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    document.getElementById('nextPage').addEventListener('click', () => {
        if (currentPage < Math.ceil(questions.length / perPage)) {
            currentPage++;
            renderTable();
        }
    });

    // Render ban đầu
    renderTable();
</script>
</body>
</html>
