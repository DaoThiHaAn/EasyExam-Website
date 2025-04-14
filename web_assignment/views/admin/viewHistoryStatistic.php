<?php
$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 1;
$test = $mydatabase->query("SELECT test_name, test_category, test_id FROM tests WHERE test_id = $test_id");
$test = $test->fetch_array();
?>

<html lang="en">
<head>
    <?php include __DIR__."/../../include/head.php"; ?>
    <title>Exam Statistics</title>
    <link rel="stylesheet" href="css/historyStatistics.css">
    <script>
        MathJax = {
            tex: {
                inlineMath: [['$', '$']],
                displayMath: [['$$', '$$']]
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include __DIR__."/../../include/navbar.php"; ?>
<div class="history-container mt-4">
    <div class="text-center mb-4">
        <h2 class="header display-6 fw-bold mb-4">Test History</h2>
        <h3 class="tfw-semibold mb-3">Test Name: <?php echo htmlspecialchars($test['test_name']); ?></h3>
        <h4 class="text-muted mb-5">Test ID: <?php echo htmlspecialchars($test['test_id']); ?></h4>
    </div>

    <h4 class="table-name mb-3">List of Examinees</h4>
    <?php if (!empty($resultsData)) : ?>
        <table class="table table-bordered table-hover table-striped text-center align-middle">
            <thead>
                <tr>
                    <th class="count"></th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Duration</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($resultsData as $row) : ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['score']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                        <td><?php echo htmlspecialchars(gmdate("H:i:s",$row['duration'])); ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-warning text-center">No one has taken this test!</div>
    <?php endif; ?>
</div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Score Chart</h3>
                <!-- Biểu đồ -->
                <canvas id="scoreChart"></canvas>
            </div>
        </div>
    </div>
<?php include __DIR__."/../../include/footer.php"; ?>
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
                label: "Number of examinees",
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
                    },
                         
                },
                x: {
                    title: {
                        display: true,
                        text: "Score"
                    }
                }
            }
        }
    });
});
</script>