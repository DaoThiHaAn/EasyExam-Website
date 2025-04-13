<html lang="en">
  <head>
    <?php include __DIR__.'/../../include/head.php'; ?>
    <link rel="stylesheet" href="./css/editQuestion.css">
    <script type="text/javascript">
      MathJax = {
        tex: {
          inlineMath: [['$', '$']],
          displayMath: [['$$', '$$']]
        }
      };
    </script>
</head>

  <body>
    <?php include __DIR__.'/../../include/navbar.php'; ?>
    <main class="container mt-5 mb-5">
      <h2 class="fw-bold text-center mb-5 header-text">Manage Questions</h2>
      
      <!-- Header Tabs -->
      <ul class="nav nav-tabs" id="editTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="edit-existing-tab" data-bs-toggle="tab" data-bs-target="#edit-existing" type="button" role="tab">
            Edit Existing Question
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="insert-question-tab" data-bs-toggle="tab" data-bs-target="#insert-question" type="button" role="tab">
            Insert Question
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="insert-category-tab" data-bs-toggle="tab" data-bs-target="#insert-category" type="button" role="tab">
            Insert Category
          </button>
        </li>
      </ul>
      
      <!-- Tab Content -->
      <section class="tab-content" id="editTabsContent">
        <!-- EDIT EXISTING QUESTION -->
        <section class="tab-pane fade show active" id="edit-existing" role="tabpanel">
          <div class="row mt-4">
            <!-- Left Column: Search, Filter & Categories -->
            <div class="col-md-4">
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Searching name...">
                <span class="input-group-text">
                  <i class="fas fa-search"></i>
                </span>
              </div>
              <select id="sortSelect" class="form-select mb-3">
                <option value="">
                  Difficulty: Default <i class="fa-solid fa-arrow-up-9-1"></i>
                </option>
                <option value="asc">Difficulty: Ascending</option>
                <option value="desc">Difficulty: Descending</option>
              </select>
              
              <h4 class="mb-4">Categories</h4>
                <div class="d-grid gap-2 cat-list">

                  <!-- Nút "All" dùng chung layout -->
                  <div class="mb-2 d-flex align-items-center">
                    <button class="btn btn-secondary category-btn flex-grow-1 text-start" data-category="0">
                      All
                    </button>
                    <button class="btn btn-danger btn-sm ms-2" disabled style="opacity: 0; pointer-events: none;">X</button>
                  </div>

                  <?php 
                    include("models/getCategories.php"); 
                    foreach ($categories as $category): ?>
                    <div class="mb-2 d-flex align-items-center">
                      <button class="btn btn-secondary category-btn flex-grow-1 text-start" 
                        data-category="<?= htmlspecialchars($category['category_name']) ?>">
                        <?= htmlspecialchars($category['category_name']) ?>
                      </button>
                      <button class="btn btn-danger btn-sm ms-2 remove-category" 
                        data-category="<?= $category['category_name'] ?>" title="Remove category">
                        X
                      </button>
                    </div>
                  <?php endforeach; ?>
                </div>

            </div>

            <!-- Right Column: Question List -->
            <div class="col-md-8">
              <h4 class="mb-4 header-text">Question List</h4>
              <div class="row" id="product-list">
                <!-- AJAX loaded question cards go here -->
              </div>
              <div class="paging" id="pagination">
                <!-- Pagination buttons go here -->
              </div>
            </div>
          </div>
        </section>
        
        <!-- INSERT QUESTION -->
        <section class="tab-pane fade" id="insert-question" role="tabpanel">
          <div class="insert-card card">
            <div class="card-header">
              <h5>Insert Question</h5>
            </div>
            <div class="card-body">
              <form id="insertQuestionForm">
                <div class="row">
                  <!-- Left Column: Form Inputs -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="insertCategory" class="form-label">Category</label>
                      <select class="form-select" id="insertCategory">
                        <option value="">-- None --</option>
                        <?php
                          include("models/getCategories.php"); 
                          if (!empty($categories)) {
                            foreach ($categories as $category): ?>
                              <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                <?= htmlspecialchars($category['category_name']) ?>
                              </option>
                            <?php endforeach;
                          } else {
                            echo '<option value="">No categories available!</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <p><i class="note-text mb-4">*Note: To write the arithmetic symbols and formulas, use LaTeX format</i></p>
                    <div class="mb-3">
                      <label class="form-label">Question: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertQuestionText" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Option A: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertOptionA" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Option B: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertOptionB" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Option C: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertOptionC" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Option D: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertOptionD" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Correct Answer: <span style="color: red">*</span></label>
                      <textarea class="form-control" id="insertAnswer" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Difficulty Level: <span style="color: red">*</span></label>
                      <input type="number" class="form-control" id="insertDifficult" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Image:</label>
                      <input type="file" class="form-control" id="insertImage">
                    </div>
                  </div>
                  <!-- Right Column: Live Preview for Insert -->
                  <div class="col-md-6 preview">
                    <h6 class="text-muted text-center">Preview</h6>
                    <p><strong>Category:</strong> <span id="insertPreviewTopic">--</span></p>
                    <p><strong>Question:</strong> <span id="insertPreviewQuestion">--</span></p>
                    <p><strong>Option A:</strong> <span id="insertPreviewA">--</span></p>
                    <p><strong>Option B:</strong> <span id="insertPreviewB">--</span></p>
                    <p><strong>Option C:</strong> <span id="insertPreviewC">--</span></p>
                    <p><strong>Option D:</strong> <span id="insertPreviewD">--</span></p>
                    <p><strong>Correct Answer:</strong> <span id="insertPreviewAnswer">--</span></p>
                    <p><strong>Difficulty Level:</strong> <span id="insertPreviewDifficulty">--</span></p>
                    <img id="insertPreviewImage" src="" alt="Preview image" style="max-width: 100%; display: none;">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Insert Question</button>
              </form>
            </div>
          </div>
        </section>
        
        <!-- INSERT CATEGORY -->
        <section class="tab-pane fade" id="insert-category" role="tabpanel">
          <div class="insert-card card">
            <div class="card-header">
              <h5>Insert New Category</h5>
            </div>
            <div class="card-body">
              <form id="insertCategoryForm">
                <div class="mb-3">
                  <label for="categoryName" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="categoryName" required>
                </div>
                <button type="submit" class="btn btn-primary">Insert Category</button>
              </form>
            </div>
          </div>
        </section>
      </section>
      
      <!-- Modal for Editing an Existing Question -->
      <section class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Edit Form Column -->
          <div class="col-md-6">
            <form id="editQuestionForm">
              <input type="hidden" id="editQuestionId">
              <div class="mb-3">
                <label for="editCategory" class="form-label">Category</label>
                <select class="form-select" id="editCategory">
                  <option value="">Not change</option>
                  <?php
                    include("models/getCategories.php");
                    if (!empty($categories)) {
                      foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_name']) ?>">
                          <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                      <?php endforeach;
                    } else {
                      echo '<option value="">No category available!</option>';
                    }
                  ?>
                </select>
              </div>
              <p><i class="note-text mb-4">*Note: To write the arithmetic symbols and formulas, use LaTeX format</i></p>
              <div class="mb-3">
                <label class="form-label">Question: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editQuestionText" rows="5" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Option A: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editOptionA" required rows="2"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Option B: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editOptionB" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Option C: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editOptionC" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Option D: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editOptionD" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Correct Answer: <span style="color: red">*</span></label>
                <textarea class="form-control" id="editAnswer" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Difficulty Level: <span style="color: red">*</span></label>
                <input type="number" class="form-control" id="editDifficult" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Image:</label>
                <input type="file" class="form-control" id="editImage" accept="image/*">
              </div>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>

          <!-- Modal Preview Column -->
          <div class="col-md-6">
            <h6 class="text-muted text-center">Preview</h6>
            <p><strong>Category:</strong> <span id="previewTopic">--</span></p>
            <p><strong>Question:</strong> <span id="previewQuestion">--</span></p>
            <p><strong>Option A:</strong> <span id="previewA">--</span></p>
            <p><strong>Option B:</strong> <span id="previewB">--</span></p>
            <p><strong>Option C:</strong> <span id="previewC">--</span></p>
            <p><strong>Option D:</strong> <span id="previewD">--</span></p>
            <p><strong>Correct Answer:</strong> <span id="previewAnswer">--</span></p>
            <p><strong>Difficulty:</strong> <span id="previewDifficulty">--</span></p>
            <img id="editPreviewImage" src="" alt="Preview Image" style="max-width: 100%; display: none;">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </main>
    
    <?php include __DIR__.'/../../include/footer.php'; ?>
    
  </body>
</html>

