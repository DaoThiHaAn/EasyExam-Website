<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
<head>
<?php include __DIR__."/../../include/head.php"; ?>
<link rel="stylesheet" href="./css/questionTest.css">
 <script type="text/javascript">
  MathJax = {
    tex: {
      inlineMath: [['$', '$']], // Kích hoạt công thức nội dòng với $
      displayMath: [['$$', '$$']] // Công thức độc lập với $$
    }
  };
</script>
</head>

<body>
    <?php include __DIR__."/../../include/navbar.php"; ?>
    <main class="container mt-4 mb-5">        
        <h4 class="header-text text-center mb-5">Test Statistics</h4>

    <section class="sort-filter mb-4 p-3 rounded-4 shadow-sm row g-3 align-items-end">
        <!-- Category Select -->
        <div class="col-12 col-md-3">
            <label for="categorySelect" class="form-label">Category:</label>
            <select id="categorySelect" class="form-select">
                <option value="0">All</option>
                <?php 
                include __DIR__."/../../models/getCategories.php"; 
                foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_name']) ?>">
                        <?= htmlspecialchars($category['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Search Input -->
        <div class="col-md-5">
            <label for="searchInput" class="form-label d-block">Search:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Searching...">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>

        <!-- Sort Dropdown -->
        <div class="col-md-4">
            <label for="sortSelect" class="form-label">Sort by:</label>
            <select id="sortSelect" class="form-select">
                <option value="">Difficulty: Default</option>
                <option value="asc">Difficulty: Ascending</option>
                <option value="desc">Difficulty: Descending</option>
            </select>
        </div>
    </section>

            
        
        <div id="questionList" >
            <div class="card-list">
                <h4 class="text-center mb-5 mt-5">Test List</h4>
                <div id="product-list" class="mb-4 test-item"></div>

            </div>
            <div class="paging" id="pagination"></div>

        </div>

    </main>

<!-- Modal xem trước câu hỏi -->
<section class="modal fade" id="testPreviewModal" tabindex="-1" aria-labelledby="testPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content bg-light">
      <div class="modal-header">
        <h5 class="modal-title" id="testPreviewModalLabel">Test Statistics</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="testPreviewContent">
        <!-- Nội dung câu hỏi sẽ được chèn vào đây -->
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="startTestBtn" data-role="<?= isset($_SESSION['role']) ? $_SESSION['role'] : '' ?>">
                Start Mock Test
            </button>
        </div>
    </div>
  </div>
</section>

<?php include __DIR__."/../../include/footer.php"; ?>
</body>
</html>



<script>
$(document).ready(function () {
    let currentCategory = 0;
    let currentSearch = "";
    let currentOrder = "";
    let selectedQuestionIds = new Set(); // Tập hợp lưu câu hỏi đã chọn

    function loadProducts(category = 0, page = 1, search = "", order = "") {
        $.ajax({
            url: "models/getQuestionName_admin.php",
            type: "GET",
            data: { category: category, page: page, search: search, order: order },
            success: function (response) {
                console.log(response)
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






