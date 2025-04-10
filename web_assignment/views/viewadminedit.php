
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include('models/viewadminedit.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My New Website</title>
        
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        <main>
            <!-- <h2>Welcome to My Website $ u = U_0 \cos(\omega t) \frac{1}{\sqrt{3}} $</h2> -->
            
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
                            <div>
                                <button class="btn btn-primary w-100 mt-2 " id = "Insertcategory" data-bs-toggle="modal" data-bs-target="#insertCategoryModal">Insert Category</button>
                            </div>
                            <div>
                                <button class="btn btn-primary w-100 mt-2" id = "Insertquestion"  data-bs-toggle="modal" data-bs-target="#insertQuestionModal">Insert Question</button>
                            </div>
                            <select id="sortSelect" class="form-select">
                                <option value="">Difficulty: Default</option>
                                <option value="asc">Difficulty: Ascending</option>
                                <option value="desc">Difficulty: Descending</option>
                            </select>

                            <h4>Categories</h4>
        
                            <div class="d-grid gap-2 overflow-auto" style="max-height: 310px;overflow-y: auto;scrollbar-width: thin;">
                                <button class="btn btn-primary category-btn" data-category="0">All</button>
                                <?php 
                                include("models/getCategories.php"); 
                                foreach ($categories as $category): ?>
                                    
                                    <div class="d-flex align-items-center border rounded p-2 w-100 mb-2">
                                    <button class="btn btn-secondary flex-grow-1 text-start category-btn" 
                                        data-category="<?= htmlspecialchars($category['category_name']) ?>">
                                        <?= htmlspecialchars($category['category_name']) ?>
                                    </button>
                                    <button class="btn btn-danger btn-sm ms-2 remove-category" 
                                            data-category="<?= $category['category_name'] ?>">X</button>
                                </div>

                                <?php endforeach; ?>
                            </div>


                            
                        </div>

                        <!-- Sản phẩm -->
                        <div class="col-md-9">
                            <h4>Products
                                
                            </h4>
                            <div class="row" id="product-list"></div>

                            <div class="paging" id="pagination"></div>
                        </div>
                    </div>
                </div>



    <!-- Thêm các modal cho chỉnh sửa và xóa -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="editCategoryId">
            <input type="text" class="form-control" id="editCategoryName">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveCategoryChanges">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal chỉnh sửa sản phẩm -->
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editQuestionModalLabel">Chỉnh sửa câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form id="editQuestionForm">
                                    <input type="hidden" id="editQuestionId">
                                    <div class="mb-3">
                                            <label for="editProductCategory" class="form-label">Chủ đề</label>
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
                                                    echo '<option value="">Không có danh mục</option>';
                                                }
                                                ?>
                                        
                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Câu hỏi:</label>
                                        <textarea class="form-control" id="editQuestionText" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Option A:</label>
                                        <input type="text" class="form-control" id="editOptionA" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Option B:</label>
                                        <input type="text" class="form-control" id="editOptionB" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Option C:</label>
                                        <input type="text" class="form-control" id="editOptionC" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Option D:</label>
                                        <input type="text" class="form-control" id="editOptionD" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án đúng:</label>
                                        <input type="text" class="form-control" id="editAnswer" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Độ khó:</label>
                                        <input type="text" class="form-control" id="editDifficult" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hình ảnh (tùy chọn):</label>
                                        <input type="file" class="form-control" id="editImage">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </form> 
                            </div>
                                <!-- Xem trước -->
                            <div class="col-md-6">
                                <h6 class="text-muted">Xem trước</h6>
                                <p><strong>Category:</strong> <span id="previewTopic">--</span></p>
                                <p><strong>Question</strong> <span id="previewQuestion">--</span></p>
                                <p><strong>Option A:</strong> <span id="previewA">--</span></p>
                                <p><strong>Option B:</strong> <span id="previewB">--</span></p>
                                <p><strong>Option C:</strong> <span id="previewC">--</span></p>
                                <p><strong>Option D:</strong> <span id="previewD">--</span></p>
                                <p><strong>Correct Answer:</strong> <span id="previewAnswer">--</span></p>
                                <p><strong>Difficulty:</strong> <span id="previewDifficulty">--</span></p>
                                <img id="editPreviewImage" src="" alt="Xem trước hình ảnh" style="max-width: 100%; display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <div class="modal fade" id="insertQuestionModal" tabindex="-1" aria-labelledby="insertQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertQuestionModalLabel">Thêm câu hỏi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="insertQuestionForm">
                                <div class="mb-3">
                                    <label for="insertCategory" class="form-label">Chủ đề</label>
                                    <select class="form-select" id="insertCategory">
                                        <option value="">-- Không chọn --</option>
                                        <?php
                                        include("models/getCategories.php"); 
                                        if (!empty($categories)) {
                                            foreach ($categories as $category): ?>
                                                <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                                    <?= htmlspecialchars($category['category_name']) ?>
                                                </option>
                                            <?php endforeach;
                                        } else {
                                            echo '<option value="">Không có danh mục</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Câu hỏi:</label>
                                    <textarea class="form-control" id="insertQuestionText" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Option A:</label>
                                    <input type="text" class="form-control" id="insertOptionA" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Option B:</label>
                                    <input type="text" class="form-control" id="insertOptionB" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Option C:</label>
                                    <input type="text" class="form-control" id="insertOptionC" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Option D:</label>
                                    <input type="text" class="form-control" id="insertOptionD" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Đáp án đúng:</label>
                                    <input type="text" class="form-control" id="insertAnswer" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Độ khó:</label>
                                    <input type="text" class="form-control" id="insertDifficult" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh (tùy chọn):</label>
                                    <input type="file" class="form-control" id="insertImage">
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm câu hỏi</button>
                            </form>
                        </div>
                            <!-- Xem trước -->
                            <div class="col-md-6">
                            <h6 class="text-muted">Xem trước</h6>
                            <p><strong>Chủ đề:</strong> <span id="insertPreviewTopic">--</span></p>
                            <p><strong>Câu hỏi:</strong> <span id="insertPreviewQuestion">--</span></p>
                            <p><strong>A:</strong> <span id="insertPreviewA">--</span></p>
                            <p><strong>B:</strong> <span id="insertPreviewB">--</span></p>
                            <p><strong>C:</strong> <span id="insertPreviewC">--</span></p>
                            <p><strong>D:</strong> <span id="insertPreviewD">--</span></p>
                            <p><strong>Đáp án đúng:</strong> <span id="insertPreviewAnswer">--</span></p>
                            <p><strong>Độ khó:</strong> <span id="insertPreviewDifficulty">--</span></p>
                            <img id="insertPreviewImage" src="" alt="Xem trước hình ảnh" style="max-width: 100%; display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Insert Category -->
    <div class="modal fade" id="insertCategoryModal" tabindex="-1" aria-labelledby="insertCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertCategoryModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
            
        </main>
        </main>
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/24e866o0zl67xx057tzga1j6pjxmgkfwbll303a7i92ezpft/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Apr 21, 2025:
        'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | insertMath| blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        setup: function(editor) {
        // Trigger MathJax typesetting when editor content changes
        editor.on('change', function(e) {
            var iframe = editor.iframeElement;
            if (iframe && iframe.contentDocument) {
                MathJax.typesetPromise(iframe.contentDocument.body);
            }
        });
            
        // Custom button to insert math delimiters
        editor.ui.registry.addButton('insertMath', {
            text: 'Insert Math',
            onAction: function() {
                var selectedText = editor.selection.getContent({format: 'text'});
                editor.insertContent('$' + selectedText + '$');
                var iframe = editor.iframeElement;
                if (iframe && iframe.contentDocument) {
                    MathJax.typesetPromise(iframe.contentDocument.body);
                }
            }
        });
    },
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
    </script>
    <textarea>

    </textarea>

    </body>

</html>

