<secti?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<script>
	console.log(<?= json_encode($_SESSION) ?>);
</script>
<html lang="en">
<head>
<?php include __DIR__."/../include/head.php"; ?>
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
    <?php include __DIR__."/../include/navbar.php"; ?>
    <main class="container mt-4 mb-5">        
        <h4 class="header-text text-center mb-5">Preview Test</h4>

    <section class="sort-filter mb-4 p-3 rounded-4 shadow-sm row g-3 align-items-end">
        <!-- Category Select -->
        <div class="col-12 col-md-3">
            <label for="categorySelect" class="form-label">Category:</label>
            <select id="categorySelect" class="form-select">
                <option value="0">All</option>
                <?php 
                include __DIR__."/../models/getCategories.php"; 
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
                <input type="text" class="form-control" id="searchInput" placeholder="Searching test name...">
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

            <!-- <h4>Chọn bài kiểm tra</h4>
                <div class="mb-3">
                    <label for="testCategory" class="form-label">Chủ đề:</label>
                    <select id="categorySelect" class="form-select">
                        <option value="0">Tất cả</option>
            <?php 
            include("models/getCategories.php"); 
            foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['category_name']) ?>">
                    <?= htmlspecialchars($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
                            </select>
                        </div> -->

        
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
        <h5 class="modal-title" id="testPreviewModalLabel">Preview Test</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="testPreviewContent">
        <!-- Nội dung câu hỏi sẽ được chèn vào đây -->
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="startTestBtn" data-role="<?= isset($_SESSION['role']) ? $_SESSION['role'] : '' ?>">
                Start
            </button>
        </div>
    </div>
  </div>
</section>

<!-- Modal xác nhận đăng nhập -->
<section class="modal fade" id="signInConfirmModal" tabindex="-1" aria-labelledby="signInConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content confirm-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="signInConfirmModalLabel">Sign In Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You need to sign in to start the test. Do you want to sign in now?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel-btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSignInBtn">Sign In</button>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__."/../include/footer.php"; ?>
</body>
</html>

<script>
            // Lấy tham số từ URL nếu có
    const urlParams = new URLSearchParams(window.location.search);
    let currentCategory = urlParams.get('category_name') || "0";
    let currentSearch = "";
    let currentOrder = "";
    let selectedQuestionIds = new Set();
    function loadProducts(category = 0, page = 1, search = "", order = "") {
            $.ajax({
                url: "models/getQuestionName.php",
                type: "GET",
                data: { category: category, page: page, search: search, order: order },
                success: function (response) {
                    let data = JSON.parse(response);

                    $("#product-list").html(data.tests);
                    $("#pagination").html(data.pagination);
                    MathJax.typesetPromise(); // Làm mới công thức

                    selectedQuestionIds.clear();
                }
            });
        }
    $(document).ready(function () {

        

        // Gán giá trị vào dropdown category nếu có
        $("#categorySelect").val(currentCategory);

        

        // Khi chọn lại category thì thay đổi cả URL (không reload)
        $("#categorySelect").change(function () {
            currentCategory = $(this).val();

            // Cập nhật URL
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set("category_name", currentCategory);
            window.history.replaceState({}, "", newUrl);

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
    let currentTestId = null;
    $(document).on("click", ".view-test-btn", function () {
        let testId = $(this).data("id");
        currentTestId = testId;
        // console.log(testId)
        if (testId) {
            $.ajax({
                url: "models/getTestQuestions.php",
                type: "GET",
                data: { test_id: testId },
                dataType: "json",
                success: function (data) {
                    const questions = data.questions;
                    console.log(questions);
                    
                    let html = "";
                    questions.slice(0, 3).forEach((q, index) => {
                        html += `
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title mb-3">📝 Question ${index + 1}</h5>
                                <p class="card-text">${q.question_text}</p>
                                
                                ${q.picture_link !== 'none' ? `
                                    <div class="text-center mb-3">
                                        <img src="${q.picture_link}" class="img-fluid rounded" style="max-height: 300px;" alt="Hình minh họa">
                                    </div>
                                ` : ''}

                                <ul class="list-group">
                                    <li class="list-group-item">A. ${q.option_a}</li>
                                    <li class="list-group-item">B. ${q.option_b}</li>
                                    <li class="list-group-item">C. ${q.option_c}</li>
                                    <li class="list-group-item">D. ${q.option_d}</li>
                                </ul>
                            </div>
                        </div>
                        `;
                    });


                    $("#testPreviewContent").html(html);
                    MathJax.typesetPromise();
                    let modal = new bootstrap.Modal(document.getElementById('testPreviewModal'));
                    modal.show();
                }
            });
        }
    });

    $(document).on("click", "#startTestBtn", function () {
        const role = $(this).data("role");
        if (role == 'user') {
            // Proceed to the test if the user is signed in
            window.location.href = `index.php?page=doTest&test_id=${currentTestId}`;
        } else {
            // Show confirmation modal if user is not signed in
            let confirmModal = new bootstrap.Modal(document.getElementById('signInConfirmModal'));
            confirmModal.show();

            // On clicking "Sign In", redirect the user
            $("#confirmSignInBtn").one("click", function () {
                window.location.href = "index.php?page=sign-in";
            });
        }
    });

    // Example helper function to update URL query parameters
    function updateUrlParams(params) {
        const url = new URL(window.location.href);
        Object.keys(params).forEach(key => {
            if (params[key] !== "" && params[key] !== null) {
                url.searchParams.set(key, params[key]);
            } else {
                url.searchParams.delete(key);
            }
        });
        // Use replaceState to change URL without reloading the page.
        history.replaceState({}, "", url);
    }

    // Example usage in your AJAX events:
    // When category changes:
    $("#categorySelect").change(function () {
        let currentCategory = $(this).val();
        updateUrlParams({ category_name: currentCategory });
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    // When search input changes:
    $("#searchInput").on("input", function () {
        let currentSearch = $(this).val();
        updateUrlParams({ search: currentSearch });
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    // When sort selection changes:
    $("#sortSelect").change(function () {
        let currentOrder = $(this).val();
        updateUrlParams({ order: currentOrder });
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });
</script>
