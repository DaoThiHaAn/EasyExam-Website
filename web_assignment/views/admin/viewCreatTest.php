<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<html lang="en">
<head>
    <?php include __DIR__.'/../../include/head.php'; ?>
    <link rel="stylesheet" href="./css/createTest.css">
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
</head>
<body>
    <?php include __DIR__.'/../../include/navbar.php'; ?>
    <main>
        <!-- Test Creation Form -->
        <section class="container">
            <h4 class="mb-4">Create a Test</h4>
            <div class="card">
                <div class="card-header">
                    Test Details
                </div>

                <div class="card-body">
                    <form id="createTestForm">
                        <section class="mb-6">
                                <!-- Example of a two-column row: filter sidebar and question list -->
                                <div class="row">
                                    <!-- Sidebar: Filter section -->
                                    <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="testName" class="form-label">Test Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="testName" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Test Duration (HH:MM:SS) <span style="color: red;">*</span></label>
                                        <div class="timer-selects">
                                            <input type="number" id="hours" class="form-control" placeholder="HH" min="0" required>
                                            <span>:</span>
                                            <input type="number" id="minutes" class="form-control" placeholder="MM" min="0" max="59" required>
                                            <span>:</span>
                                            <input type="number" id="seconds" class="form-control" placeholder="SS" min="0" max="59" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="categorySelect" class="form-label">Test Category <span style="color: red;">*</span> </label>
                                        <select id="categorySelect" class="form-select">
                                            <option value="0">None</option>
                                            <?php 

                                            include("models/getCategories.php"); 
                                            foreach ($categories as $category): ?>
                                                <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                                    <?= htmlspecialchars($category['category_name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <label class="form-label">Select Questions <span style="color: red;">*</span></label>
                                        <div class="bg-light p-3">
                                             <!-- New info section -->
                                            <div id="filterInfo">
                                                <p id="resultCount">Total results: <span>0</span></p>
                                                <p id="selectedCount">Selected questions: <span>0</span></p>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchInput" placeholder="Searching...">
                                                <span class="input-group-text">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                            <select id="sortSelect" class="form-select mt-3">
                                                <option value="">Difficulty: Default</option>
                                                <option value="asc">Difficulty: Ascending</option>
                                                <option value="desc">Difficulty: Descending</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <!-- Main content: Question list -->
                                    <div class="col-md-9">
                                        <div class="list-question-card">
                                            <h4>Question List</h4>
                                            <div class="row" id="product-list"></div>
                                            <div class="paging" id="pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <button type="submit" class="create-btn">Create Test</button>
                    </form>
                </div>
        </section>
    </main>
    <?php include __DIR__.'/../../include/footer.php'; ?>
</body>
</html>



