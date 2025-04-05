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
                            include("getCategories.php"); 
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
                                            include("getCategories.php"); 

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
                            <p><strong>Chủ đề:</strong> <span id="previewTopic">--</span></p>
                            <p><strong>Câu hỏi:</strong> <span id="previewQuestion">--</span></p>
                            <p><strong>A:</strong> <span id="previewA">--</span></p>
                            <p><strong>B:</strong> <span id="previewB">--</span></p>
                            <p><strong>C:</strong> <span id="previewC">--</span></p>
                            <p><strong>D:</strong> <span id="previewD">--</span></p>
                            <p><strong>Đáp án đúng:</strong> <span id="previewAnswer">--</span></p>
                            <p><strong>Độ khó:</strong> <span id="previewDifficulty">--</span></p>
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
                                    include("getCategories.php"); 
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






            <script>
                function loadProducts(category = 0, page = 1, search = "",order = "") {
                    $.ajax({
                        url: "fetchDB_edit.php",
                        type: "GET",
                        data: { category: category, page: page, search: search,order: order },
                        success: function (response) {
                            let data = JSON.parse(response);
                            $("#product-list").html(data.products);
                            $("#pagination").html(data.pagination);
                            MathJax.typeset(); // Ép MathJax cập nhật
                        }
                    });
                }

                $(document).ready(function () {
                    let currentCategory = 0;
                    let currentSearch = "";
                    let currentOrder = "";
                    loadProducts(); // Load tất cả sản phẩm khi vào trang

                    $(".category-btn").click(function () {
                        currentCategory = $(this).data("category");
                        loadProducts(currentCategory, 1, currentSearch, currentOrder); // Giữ nguyên từ khóa tìm kiếm
                    });

                    $(document).on("click", ".page-link", function (e) {
                        e.preventDefault();
                        let page = $(this).data("page");
                        loadProducts(currentCategory, page, currentSearch, currentOrder);
                    });

                    $("#searchInput").on("input", function () {
                        currentSearch = $(this).val();
                        loadProducts(currentCategory, 1, currentSearch); // Giữ nguyên danh mục
                    });

                    $("#sortSelect").change(function () {
                        currentOrder = $(this).val();
                        loadProducts(currentCategory, 1, currentSearch, currentOrder);
                    });

                    loadProducts();
                });
            </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </main>
    </main>
</body>

</html>

<script>
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
<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".category-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                
                buttons.forEach(btn => btn.classList.replace("btn-primary", "btn-secondary"));

                
                this.classList.replace("btn-secondary", "btn-primary");
            });
        });
    });

</script>


<script>

    // Chỉnh sửa danh mục
$(document).ready(function () {
    $(document).on("click", "[data-bs-target='#editQuestionModal']", function () {
        const fields = [
            { id: 'editQuestionText', data: 'text' },
            { id: 'editOptionA', data: 'optiona' },
            { id: 'editOptionB', data: 'optionb' },
            { id: 'editOptionC', data: 'optionc' },
            { id: 'editOptionD', data: 'optiond' },
            { id: 'editDifficult', data: 'difficulty' },
            { id: 'editAnswer', data: 'answer' },
            { id: 'editCategory', data: 'category' }
        ];

        // Cập nhật giá trị cho các input và kích hoạt sự kiện input
        fields.forEach(({ id, data }) => {
            const value = $(this).data(data);
            $(`#${id}`).val(value || '').trigger('input');
        });

        $("#editQuestionId").val($(this).data("id"));

        // Cập nhật preview ngay lập tức
        updateAllPreviews();

        // Hiển thị ảnh xem trước nếu có
        const imagePath = $(this).data("image");
        const imagePreview = document.getElementById("previewImage");
        if (imagePath) {
            imagePreview.src = imagePath;
            imagePreview.style.display = 'block';
        } else {
            imagePreview.src = 'none';
            imagePreview.style.display = 'none';
        }
    });

    // Hàm cập nhật tất cả các preview
    function updateAllPreviews() {
        const previewMappings = [
            { input: 'editCategory', preview: 'previewTopic' },
            { input: 'editQuestionText', preview: 'previewQuestion' },
            { input: 'editOptionA', preview: 'previewA' },
            { input: 'editOptionB', preview: 'previewB' },
            { input: 'editOptionC', preview: 'previewC' },
            { input: 'editOptionD', preview: 'previewD' },
            { input: 'editAnswer', preview: 'previewAnswer' },
            { input: 'editDifficult', preview: 'previewDifficulty' }
        ];

        previewMappings.forEach(({ input, preview }) => {
            const inputEl = document.getElementById(input);
            const previewEl = document.getElementById(preview);
            if (inputEl && previewEl) {
                previewEl.innerHTML = inputEl.value || '--';
                if (window.MathJax) MathJax.typesetPromise([previewEl]);
            }
        });
    }

    // Tự động cập nhật preview khi nhập
    const config = [
        {
            prefix: 'edit', // Cấu hình cho edit
            mappings: [
                { input: 'Category', preview: 'previewTopic' },
                { input: 'QuestionText', preview: 'previewQuestion' },
                { input: 'OptionA', preview: 'previewA' },
                { input: 'OptionB', preview: 'previewB' },
                { input: 'OptionC', preview: 'previewC' },
                { input: 'OptionD', preview: 'previewD' },
                { input: 'Answer', preview: 'previewAnswer' },
                { input: 'Difficult', preview: 'previewDifficulty' },
            ],
            imageInputId: 'editImage',
            formId: 'editQuestionForm',
            previewImageId: 'editPreviewImage' // Thêm ID xem trước ảnh cho modal edit
        },
        {
            prefix: 'insert', // Cấu hình cho insert
            mappings: [
                { input: 'Category', preview: 'insertPreviewTopic' },
                { input: 'QuestionText', preview: 'insertPreviewQuestion' },
                { input: 'OptionA', preview: 'insertPreviewA' },
                { input: 'OptionB', preview: 'insertPreviewB' },
                { input: 'OptionC', preview: 'insertPreviewC' },
                { input: 'OptionD', preview: 'insertPreviewD' },
                { input: 'Answer', preview: 'insertPreviewAnswer' },
                { input: 'Difficult', preview: 'insertPreviewDifficulty' },
            ],
            imageInputId: 'insertImage',
            formId: 'insertQuestionForm',
            previewImageId: 'insertPreviewImage' // Thêm ID xem trước ảnh cho modal insert
        }
    ];

    // Cập nhật preview cho tất cả các modal
    config.forEach(({ prefix, mappings, imageInputId, previewImageId }) => {
        mappings.forEach(({ input, preview }) => {
            const inputEl = document.getElementById(`${prefix}${input}`);
            const previewEl = document.getElementById(preview);
            if (inputEl && previewEl) {
                const updatePreview = () => {
                    previewEl.innerHTML = inputEl.value || '--';
                    if (window.MathJax) MathJax.typesetPromise([previewEl]);
                };
                inputEl.addEventListener('input', updatePreview);
                inputEl.addEventListener('change', updatePreview);
            }
        });

        // Xem trước ảnh mới
        const imageInput = document.getElementById(imageInputId);
        const imagePreview = document.getElementById(previewImageId); // Sử dụng previewImageId riêng biệt cho mỗi modal
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
            });
        }
    });


    $("#editQuestionForm").submit(function (e) {
        e.preventDefault();

        let formData = new FormData();
        formData.append("id", $("#editQuestionId").val());
        formData.append("question_text", $("#editQuestionText").val());
        formData.append("option_a", $("#editOptionA").val());
        formData.append("option_b", $("#editOptionB").val());
        formData.append("option_c", $("#editOptionC").val());
        formData.append("option_d", $("#editOptionD").val());
        formData.append("difficulty", $("#editDifficult").val());
        formData.append("correct_answer", $("#editAnswer").val());

        // Nếu category khác "Not change" thì mới gửi lên
        let category = $("#editCategory").val();
        if (category !== "Not change") {
            formData.append("category_name", category);
        }

        // Kiểm tra xem có file hình ảnh không
        let file = $("#editImage")[0].files[0];
        if (file) {
            formData.append("image", file);
        }

        console.log("Form Data123:", formData); // Kiểm tra dữ liệu trước khi gửi

        $.ajax({
            url: "updateQuestion.php",
            type: "POST",
            data: formData,
            contentType: false, // Không tự động thêm header `Content-Type`
            processData: false, // Không xử lý dữ liệu FormData
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert("Lỗi: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                console.error("Response Text:", xhr.responseText);
                alert("Có lỗi xảy ra, vui lòng thử lại!");
            }
        });
    });


    $(document).on("click", "[data-bs-target='#insertQuestionModal']", function () {
        const fields = [
            { id: 'insertQuestionText', data: 'text' },
            { id: 'insertOptionA', data: 'optiona' },
            { id: 'insertOptionB', data: 'optionb' },
            { id: 'insertOptionC', data: 'optionc' },
            { id: 'insertOptionD', data: 'optiond' },
            { id: 'insertDifficult', data: 'difficulty' },
            { id: 'insertAnswer', data: 'answer' },
            { id: 'insertCategory', data: 'category' }
        ];

        // Cập nhật giá trị cho các input và kích hoạt sự kiện input
        fields.forEach(({ id, data }) => {
            const value = $(this).data(data);
            $(`#${id}`).val(value || '').trigger('input');
        });

        $("#insertQuestionId").val($(this).data("id"));

        // Hiển thị ảnh xem trước nếu có
        const imagePath = $(this).data("image");
        const imagePreview = document.getElementById("previewImage");
        if (imagePath) {
            imagePreview.src = imagePath;
            imagePreview.style.display = 'block';
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    });
   
    $("#insertQuestionForm").submit(function (e) {
        e.preventDefault();
        
        let formData = new FormData();
        formData.append("category_name", $("#insertCategory").val());
        formData.append("question_text", $("#insertQuestionText").val());
        formData.append("option_a", $("#insertOptionA").val());
        formData.append("option_b", $("#insertOptionB").val());
        formData.append("option_c", $("#insertOptionC").val());
        formData.append("option_d", $("#insertOptionD").val());
        formData.append("correct_answer", $("#insertAnswer").val());
        formData.append("difficulty", $("#insertDifficult").val());

        // Kiểm tra xem có file ảnh không
        let imageFile = $("#insertImage")[0].files[0];
        if (imageFile) {
            formData.append("image", imageFile);
        }

        $.ajax({
            url: "insertQuestion.php",
            type: "POST",
            data: formData,
            contentType: false, // Không tự động thêm header `Content-Type`
            processData: false, // Không xử lý dữ liệu FormData
            dataType: "json",
            success: function (response) {
                console.log("Server Response:", response);
                if (response.success) {
                    alert(response.message);
                    $("#insertQuestionModal").modal("hide");
                    location.reload(); // Load lại danh sách câu hỏi
                } else {
                    alert("Lỗi: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                alert("Có lỗi xảy ra, vui lòng thử lại!");
            }
        });
    });


    $("#insertCategoryForm").submit(function (event) {
        event.preventDefault();

        let formData = new FormData();
        
        formData.append("category", $("#categoryName").val());
    
        // console.log("Tên ảnh gửi đi:", imageName); // Kiểm tra trên console
        
        $.ajax({
            url: "insertCategory.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                alert(response.message);
                if (response.success) {
                    location.reload();
                }
                else {
                    alert("Thêm sản phẩm thất bại: " + response.error);
                }
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".category-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                
                buttons.forEach(btn => btn.classList.replace("btn-primary", "btn-secondary"));

                
                this.classList.replace("btn-secondary", "btn-primary");
            });
        });
    });




    // Xóa danh mục
    $(document).on("click", ".remove-category", function () {
        let categoryName = $(this).data("category");
        if (confirm("Bạn có chắc muốn xóa danh mục này?")) {
            $.post("removeCategory.php", { name: categoryName }, function (response) {
                alert(response);
                location.reload();
            });
        }
    });

    // Chỉnh sửa sản phẩm
    // $(document).on("click", ".edit-product", function () {
    //     let productId = $(this).data("id");
    //     let productName = $(this).data("name");
    //     let productPrice = $(this).data("price");
    //     let productDescription = $(this).data("description");
    //     $("#editProductId").val(productId);
    //     $("#editProductName").val(productName);
    //     $("#editProductPrice").val(productPrice);
    //     $("#editProductDescription").val(productDescription);
    //     $("#editProductModal").modal("show");
    // });

    // $("#saveProductChanges").click(function () {
    //     let productId = $("#editProductId").val();
    //     let productName = $("#editProductName").val();
    //     let productPrice = $("#editProductPrice").val();
    //     let productDescription = $("#editProductDescription").val();
    //     $.post("updateProduct.php", { id: productId, name: productName, price: productPrice, description: productDescription }, function (response) {
    //         alert(response);
    //         location.reload();
    //     });
    // });

    // Xóa sản phẩm
    $(document).on("click", ".remove-product", function () {
        let productId = $(this).data("id");
        console.log(productId)
        if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
            $.post("removeQuestion.php", { id: productId }, function (response) {
                alert(response);
                location.reload();
            });
        }
    });
});










</script>
