<?php




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ AJAX
$category = isset($_GET['category']) ? $_GET['category'] : "";
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';
$limit = 10;
$offset = ($page - 1) * $limit;

// Tạo điều kiện lọc theo danh mục và tìm kiếm
$where = "WHERE 1=1"; // Mặc định lấy tất cả dữ liệu

if (!empty($category) && $category !== "0") {
    $category = $conn->real_escape_string($category);
    $where .= " AND test_category = '$category'";
}
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where .= " AND test_name LIKE '%$search%'";
}

// Sắp xếp
$orderQuery = "ORDER BY test_id DESC";
if ($order === "asc") {
    $orderQuery = "ORDER BY count ASC";
} elseif ($order === "desc") {
    $orderQuery = "ORDER BY count DESC";
}

// Lấy tổng số tests phù hợp
$totalQuery = "SELECT COUNT(*) as total FROM tests $where";
$totalResult = $conn->query($totalQuery);
if (!$totalResult) {
    ob_clean(); 
header('Content-Type: application/json');
    echo json_encode(["error" => "Lỗi truy vấn tổng số bài test: ".$where . $conn->error]);
}
$totalRow = $totalResult->fetch_assoc();
$totaltests = $totalRow['total'];
$totalPages = ceil($totaltests / $limit);

// Lấy danh sách câu hỏi
$testQuery = "SELECT test_name, `count`,test_time,test_category,test_id FROM tests $where $orderQuery LIMIT $limit OFFSET $offset";
$testResult = $conn->query($testQuery);

$testsHTML = '';
if ($testResult->num_rows > 0) {
    while ($test = $testResult->fetch_assoc()) {
        $testsHTML .= '
            <div class="test-card card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        Test Name: ' . htmlspecialchars($test['test_name']) . '
                    </h4>                    
                    <h5 class="card-text">Category: ' . $test['test_category'] . '</h5>
                    <p class="card-text">Number of Questions: ' . htmlspecialchars($test['count']) . '</p>
                    <p class="card-text">
                        Duration <span><i class="fa-solid fa-hourglass"></i></span> :  ' . htmlspecialchars($test['test_time']) . '
                    </p>
                    <button class="btn mt-2 btn-primary view-test-btn" data-id="' . htmlspecialchars($test['test_id']) . '">View</button>
                    <a class="btn" href="index.php?page=admin_delete_test&test_id=' . htmlspecialchars($test['test_id']) . '" 
                        title="Delete" onclick="return confirm(\'Are you sure you want to delete this test?\');">
                        <i class="fa-solid fa-lg fa-trash trash-class"></i>
                    </a>
                </div>
            </div>
        ';
    }
} else {

    $testsHTML = '<p>No matching tests found!.</p>';
}

$paginationHTML = '<nav><ul class="pagination justify-content-center mt-4">';
if ($page > 1) {
    $paginationHTML .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
}

if ($totalPages <= 10) {
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $paginationHTML .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }
} else {
    if ($page > 4) {
        $paginationHTML .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
        $paginationHTML .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }
    
    $start = max(1, $page - 2);
    $end = min($totalPages - 1, $page + 2);
    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $paginationHTML .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }
    
    if ($page < $totalPages - 3) {
        $paginationHTML .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        $paginationHTML .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
    }
}

if ($page < $totalPages) {
    $paginationHTML .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
}
$paginationHTML .= '</ul></nav>';

echo json_encode(["tests" => $testsHTML, "pagination" => $paginationHTML]);
?>
