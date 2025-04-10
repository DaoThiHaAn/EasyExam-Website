<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
  id="MathJax-script" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
</head>

<body>
    <?php include __DIR__."/../include/navbar.php"; ?>
    <main>
        <!-- <h2>Welcome to My Website $ u = U_0 \cos(\omega t) \frac{1}{\sqrt{3}} $</h2> -->
        
        
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

           
            <div id="questionList" >
                <div class="col-md-9">
                    <h4>Question
                        
                    </h4>
                    <div class="row" id="product-list"></div>

                    <div class="paging" id="pagination"></div>
                </div>
            </div>
        </div>

        
        
        
        
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
    <?php include __DIR__."/../include/footer.php"; ?>
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
            url: "models/getQuestionName.php",
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
        window.location.href = "index.php?page=viewTest&test_id=" + testId;
    }
});


</script>
