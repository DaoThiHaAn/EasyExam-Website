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
        
        
        <div class="container mt-4">
    <h4>Chọn bài kiểm tra để xem lịch sử</h4>
        <div class="mb-3">
            <label for="testCategory" class="form-label">Chủ đề:</label>
            <select id="categorySelect" class="form-select">
                <option value="0">Tất cả</option>
                <?php 
                include("getCategories.php"); 
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











