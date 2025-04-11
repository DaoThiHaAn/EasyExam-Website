<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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

$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 1;

// Truy vấn để lấy danh sách kết quả
$sql = "
    SELECT r.result_id, r.score, u.username, t.test_name
    FROM results r
    JOIN users u ON r.user_id = u.user_id
    JOIN tests t ON r.test_id = t.test_id
    WHERE r.test_id = ?
";

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);
if (!$stmt = $conn->prepare($sql)) {
  die("Lỗi truy vấn SQL: " . $conn->error);
}
$stmt->bind_param("i", $test_id);
$stmt->execute();
$result = $stmt->get_result();

// Lưu dữ liệu vào một biến để hiển thị sau trong HTML
$resultsData = [];
$test_name = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsData[] = $row;
        $test_name = $row['test_name'];
    }
}
$usernames = [];
$scores = [];

// Gộp những người có điểm giống nhau
$scoreGroups = [];

foreach ($resultsData as $row) {
    $score = $row['score'];
    // Nếu điểm đã có trong mảng $scoreGroups, tăng số lượng lên
    if (isset($scoreGroups[$score])) {
        $scoreGroups[$score]++;
    } else {
        // Nếu điểm chưa có trong mảng, tạo mới
        $scoreGroups[$score] = 1;
    }
}
ksort($scoreGroups);
// Tạo mảng usernames và scores
$usernames = array_keys($scoreGroups);  // Lấy các điểm số
$scores = array_values($scoreGroups);   // Lấy số lượng người có điểm tương ứng

// Chuyển dữ liệu sang JavaScript
$usernamesJson = json_encode($usernames);
$scoresJson = json_encode($scores);
// Đóng kết nối
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <?php include __DIR__."/../include/head.php"; ?>
    <title>Exam Statistics</title>
    <script>
        MathJax = {
            tex: {
                inlineMath: [['$', '$']],
                displayMath: [['$$', '$$']]
            }
        };
    </script>
    <script type="text/javascript" async id="MathJax-script" 
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include __DIR__."/../include/navbar.php"; ?>
<div class="container mt-4">
    <h2 class="text-center">Exam History</h2>
    <h3 class="text-center">Test Name: <?php echo htmlspecialchars($test_name); ?></h3>
    <h4 class="text-center">Test ID: <?php echo htmlspecialchars($test_id); ?></h4>

    <?php if (!empty($resultsData)) : ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Duration</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultsData as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['score']); ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-warning text-center">No one has taken this test!</div>
    <?php endif; ?>
</div>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Score Chart</h3>
                <!-- Biểu đồ -->
                <canvas id="scoreChart"></canvas>
            </div>
        </div>
</div>
<?php include __DIR__."/../include/footer.php"; ?>
</body>
</html>


<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("scoreChart").getContext("2d");

    var chart = new Chart(ctx, {
        type: "bar", // Loại biểu đồ: cột (có thể đổi thành "line", "pie", "doughnut", v.v.)
        data: {
            labels: <?php echo $usernamesJson; ?>, 
            datasets: [{
                label: "Số lượng người",
                data: <?php echo $scoresJson; ?>, // Điểm số tương ứng
                backgroundColor: "rgba(54, 162, 235, 0.5)", // Màu cột
                borderColor: "rgba(54, 162, 235, 1)", // Màu viền
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                      stepSize: 1,  // Đặt bước nhảy giữa các giá trị trên trục Y là 1
                    }        
                }
            }
        }
    });
});
</script>