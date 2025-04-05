<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>My New Website</title>
 <link rel="stylesheet" href="css/style.css">
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

<body>
    <main>
        <!-- <h2>Welcome to My Website $ u = U_0 \cos(\omega t) \frac{1}{\sqrt{3}} $</h2> -->
        
        
        <!-- Form tạo bài kiểm tra -->
<div class="container mt-4">
    <h4>Tạo bài kiểm tra</h4>
    <form id="createTestForm">
        <div class="mb-3">
            <label for="testName" class="form-label">Tên bài kiểm tra:</label>
            <input type="text" class="form-control" id="testName" required>
        </div>
        <div class="mb-3">
            <label for="testTime" class="form-label">Thời gian làm bài (HH:MM:SS):</label>
            <input type="text" class="form-control" id="testTime" placeholder="00:30:00" required>
        </div>
        <div class="mb-3">
            <label for="testCategory" class="form-label">Chủ đề:</label>
            <select id="categorySelect" class="form-select">
                <option value="0">Không</option>
                <?php 
                include("getCategories.php"); 
                foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_name']) ?>">
                        <?= htmlspecialchars($category['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
           
            <div id="questionList" >
                    <div class="col-md-9">
                        <h4>Question
                            
                        </h4>
                        <div class="row" id="product-list"></div>

                        <div class="paging" id="pagination"></div>
                    </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Tạo bài kiểm tra</button>
    </form>
</div>

        
        
        
        
        <main>
            <div class="container mt-4">

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

                    <!-- Sản phẩm -->
                    
                </div>
            </div>

           

        
        </main>
    </main>
</body>

</html>










<script>
$(document).ready(function () {
    let currentCategory = null;
    let currentSearch = "";
    let currentOrder = "";
    let selectedQuestionIds = new Set(); // Tập hợp lưu câu hỏi đã chọn

    function loadProducts(category = null, page = 1, search = "", order = "") {
        if (category === null || category === "0") {
            $("#product-list").html("");
            $("#pagination").html("");
            return;
        }

        $.ajax({
            url: "fetchDatabase.php",
            type: "GET",
            data: { category: category, page: page, search: search, order: order },
            success: function (response) {
                let data = JSON.parse(response);
                $("#product-list").html(data.products);
                $("#pagination").html(data.pagination);
                MathJax.typeset(); // Ép MathJax cập nhật

                // Reset danh sách câu hỏi đã chọn khi đổi danh mục
                selectedQuestionIds.clear();
            }
        });
    }

    $(".category-btn").click(function () {
        currentCategory = $(this).data("category");
        $("#categorySelect").val(currentCategory); // Đồng bộ dropdown
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    $("#categorySelect").change(function () {
        currentCategory = $(this).val();
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    $(document).on("click", ".page-link", function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        loadProducts(currentCategory, page, currentSearch, currentOrder);
    });

    $("#searchInput").on("input", function () {
        currentSearch = $(this).val();
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    $("#sortSelect").change(function () {
        currentOrder = $(this).val();
        loadProducts(currentCategory, 1, currentSearch, currentOrder);
    });

    // Xử lý chọn/bỏ chọn câu hỏi
    $(document).on("change", ".question-checkbox", function () {
        let questionId = $(this).data("id");
        if ($(this).is(":checked")) {
            selectedQuestionIds.add(questionId);
        } else {
            selectedQuestionIds.delete(questionId);
        }
    });
    // Gửi bài kiểm tra vào database
    $("#createTestForm").submit(function (e) {
        e.preventDefault();

        let testName = $("#testName").val();
        let testTime = $("#testTime").val();
        let testCategory = $("#categorySelect").val();
        if (!testName || !testTime || selectedQuestionIds.size === 0) {
            alert("Vui lòng nhập đủ thông tin và chọn ít nhất một câu hỏi!");
            return;
        }
        console.log(testCategory);

        $.ajax({
            url: "insertTest.php",
            type: "POST",
            data: {
                test_name: testName,
                test_time: testTime,
                test_category: testCategory,
                created_by: 1,
                question_ids: Array.from(selectedQuestionIds)
            },
            success: function (response) {
                alert(response);
                selectedQuestionIds.clear();
                $("#createTestForm")[0].reset(); 
            }
        });
    });
    loadProducts(currentCategory);
});


function searchFunction() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let items = document.querySelectorAll("#list li");

    items.forEach(item => {
        if (item.textContent.toLowerCase().includes(input)) {
            item.style.display = "block"; // Hiện mục phù hợp
        } else {
            item.style.display = "none"; // Ẩn mục không khớp
        }
    });
}



</script>






