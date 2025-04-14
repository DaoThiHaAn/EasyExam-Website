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

            
        
        <div id="questionList" >
            <div class="card-list">
                <h4 class="text-center mb-5 mt-5">Test List</h4>
                <div id="product-list" class="mb-4 test-item"></div>

            </div>
            <div class="paging" id="pagination"></div>

        </div>

    </main>

<?php include __DIR__."/../../include/footer.php"; ?>
</body>
</html>







