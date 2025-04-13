<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$test_id = isset($_GET['test_id']) ? intval($_GET['test_id']) : 1;
// Truy vấn để lấy danh sách kết quả
$sql = "
    SELECT r.result_id, r.score,r.start_time, r.end_time, r.duration, u.username, t.test_name
    FROM results r
    JOIN users u ON r.user_id = u.user_id
    JOIN tests t ON r.test_id = t.test_id
    WHERE r.test_id = ?
";

// Chuẩn bị và thực thi truy vấn
$stmt = $mydatabase->prepare($sql);
if (!$stmt) {
  die("Lỗi truy vấn SQL: " . $mydatabase->error);
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

include __DIR__.'/../views/admin/viewHistoryAdmin.php';
?>

<script>
    $(document).ready(function () {
        let currentCategory = 0;
        let currentSearch = "";
        let currentOrder = "";
        let selectedQuestionIds = new Set(); // Tập hợp lưu câu hỏi đã chọn

        function loadProducts(category = 0, page = 1, search = "", order = "") {


            $.ajax({
                url: "getQuestionName.php",
                type: "GET",
                data: { category: category, page: page, search: search, order: order },
                success: function (response) {
                    let data = JSON.parse(response);
                    
                    $("#product-list").html(data.tests);
                    $("#pagination").html(data.pagination);
                    MathJax.typeset(); // Ép MathJax cập nhật

                    // Reset danh sách câu hỏi đã chọn khi đổi danh mục
                    selectedQuestionIds.clear();
                }
            });
        }


        $("#categorySelect").change(function () {
            currentCategory = $(this).val();
            console.log(currentCategory)
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $("#searchInput").on("input", function () {
            currentSearch = $(this).val();
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $("#sortSelect").change(function () {
            currentOrder = $(this).val();
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });


        loadProducts(currentCategory);
    });

    $(document).on("click", ".view-test-btn", function () {
        let testId = $(this).data("id");
        if (testId) {
            window.location.href = "index.php?page=admin_statistic&test_id=" + testId;
        }
    });


</script>
