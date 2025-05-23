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
$where = "WHERE 1=1";
if (!empty($category) && $category != "0") {
    $category = $conn->real_escape_string($category);
    $where .= " AND category_name = '$category'";
}
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where .= " AND question_text LIKE '%$search%'";
}

// Sắp xếp
$orderQuery = "ORDER BY question_id DESC";
if ($order === "asc") {
    $orderQuery = "ORDER BY difficulty ASC";
} elseif ($order === "desc") {
    $orderQuery = "ORDER BY difficulty DESC";
}

// Lấy tổng số câu hỏi phù hợp
$totalQuery = "SELECT COUNT(*) as total FROM web.questions $where";
$totalResult = $conn->query($totalQuery);
if (!$totalResult) {
    die("Lỗi truy vấn: " . $conn->error);
}
$totalRow = $totalResult->fetch_assoc();
$totalQuestions = $totalRow['total'];
$totalPages = ceil($totalQuestions / $limit);

// Lấy danh sách câu hỏi
$questionQuery = "SELECT question_id, category_name, question_text, correct_answer, option_a, option_b, option_c, option_d, picture_link, difficulty FROM web.questions $where $orderQuery LIMIT $limit OFFSET $offset";
$questionResult = $conn->query($questionQuery);

$questionsHTML = '';
if ($questionResult->num_rows > 0) {
    while ($question = $questionResult->fetch_assoc()) {
        $imageSrc = ($question['picture_link'] == 'none') ? '' : htmlspecialchars($question['picture_link']);
        $imageElement = '';
        if (!empty($imageSrc)) {
            $imageElement = '<img src="' . $imageSrc . '" class="card-img-top img-fluid w-25" alt="Question Image">';

        }
        $questionsHTML .= '
        <div class="col-md-12 mb-4 product-item">
            <div class="card h-100 shadow-lg border-0">
                <button class="btn btn-success btn-sm position-absolute bottom-0 start-0 m-2 mr-4 edit-product"  
                    data-id="' . $question['question_id'] . '"
                    data-category="' . htmlspecialchars($question['category_name']) . '"
                    data-text="' . htmlspecialchars($question['question_text']) . '"
                    data-optiona="' . htmlspecialchars($question['option_a']) . '"
                    data-optionb="' . htmlspecialchars($question['option_b']) . '"
                    data-optionc="' . htmlspecialchars($question['option_c']) . '"
                    data-optiond="' . htmlspecialchars($question['option_d']) . '"
                    data-answer="' . htmlspecialchars($question['correct_answer']) . '"
                    data-difficulty="' . htmlspecialchars($question['difficulty']) . '"
                    data-image="' . htmlspecialchars($question['picture_link']) . '"
                    data-bs-toggle="modal" data-bs-target="#editQuestionModal">
                    Edit
                </button>

                <button class="btn btn-danger btn-sm position-absolute bottom-0 end-0 m-2 remove-product" 
                    data-id="' . $question['question_id'] . '" title="Remove question">
                    X
                </button>

               

                <div class="card-body pb-4">
                    <h5 class="card-title mb-4">' . htmlspecialchars($question['question_text']) . '</h5>
                     ' . $imageElement . '
                    <p class="card-text">A: ' . htmlspecialchars($question['option_a']) . '</p>
                    <p class="card-text">B: ' . htmlspecialchars($question['option_b']) . '</p>
                    <p class="card-text">C: ' . htmlspecialchars($question['option_c']) . '</p>
                    <p class="card-text">D: ' . htmlspecialchars($question['option_d']) . '</p>
                    <p class="ans-text card-text">Answer: ' . htmlspecialchars($question['correct_answer']) . '</p>
                    <p class="diff-text mb-4">Difficulty: ' . htmlspecialchars($question['difficulty']) . '</p>
                </div>
            </div>
        </div>';
    }
} else {
    $questionsHTML = '<p>No matching question!</p>';
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

echo json_encode(["products" => $questionsHTML, "pagination" => $paginationHTML]);
?>
