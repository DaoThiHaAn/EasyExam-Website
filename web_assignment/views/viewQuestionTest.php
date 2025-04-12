<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<script>
	console.log(<?= json_encode($_SESSION) ?>);
</script>
<!DOCTYPE html>
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
<script type="text/javascript" async
  src="https://polyfill.io/v3/polyfill.min.js?features=es6">
</script>
<script type="text/javascript" async
  id="MathJax-script" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
</head>

<body>
    <?php include __DIR__."/../include/navbar.php"; ?>
    <main>        
        <div class="container mt-4">
            <h4>Preview Test</h4>
            <div class="mb-3">
                <label for="categorySelect" class="form-label">Category: </label>
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
                <div class="col-md-9">
                    <h4>Question
                        
                    </h4>
                    <div class="row" id="product-list"></div>

                    <div class="paging" id="pagination"></div>
                </div>
            </div>

    </div>
    </main>

<!-- Modal xem trước câu hỏi -->
<div class="modal fade" id="testPreviewModal" tabindex="-1" aria-labelledby="testPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
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
</div>

            <div class="row">
                <!-- Danh mục -->
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Searching...">
                        
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    
                    <select id="sortSelect" class="form-select">
                        <option value="">Difficulty: Default</option>
                        <option value="asc">Difficulty: Ascending</option>
                        <option value="desc">Difficulty: Descending</option>
                    </select>
                </div>
            </div>


<?php include __DIR__."/../include/footer.php"; ?>
</body>
</html>



<script>
    $(document).ready(function () {
        // Lấy tham số từ URL nếu có
        const urlParams = new URLSearchParams(window.location.search);
        let currentCategory = urlParams.get('category_name') || "0";
        let currentSearch = "";
        let currentOrder = "";
        let selectedQuestionIds = new Set();

        // Gán giá trị vào dropdown category nếu có
        $("#categorySelect").val(currentCategory);

        function loadProducts(category = 0, page = 1, search = "", order = "") {
            $.ajax({
                url: "models/getQuestionName.php",
                type: "GET",
                data: { category: category, page: page, search: search, order: order },
                success: function (response) {
                    let data = JSON.parse(response);

                    $("#product-list").html(data.tests);
                    $("#pagination").html(data.pagination);
                    MathJax.typeset(); // Làm mới công thức

                    selectedQuestionIds.clear();
                }
            });
        }

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
                                <h5 class="card-title mb-3">📝 Câu ${index + 1}</h5>
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

        if (role) {
            // Nếu có role, cho phép chuyển đến trang làm bài
            // Giả sử bạn có testId đang lưu lúc trước khi mở modal
            const testId = $(this).data("test-id"); // hoặc gán bằng biến toàn cục nếu cần
            window.location.href = `index.php?page=doTest&test_id=${currentTestId}`;
        } else {
            // Nếu chưa đăng nhập thì thông báo
            alert("Bạn cần đăng nhập để làm bài kiểm tra.");
            window.location.href = "index.php?page=sign-in";
        }
    });


</script>
