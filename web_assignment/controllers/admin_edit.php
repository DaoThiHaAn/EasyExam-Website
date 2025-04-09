
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/viewadminedit.php';

?>

<script>
    function loadProducts(category = 0, page = 1, search = "",order = "") {
        $.ajax({
            url: "models/fetchDB_edit.php",
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
            
                    // Lấy giá trị các đáp án
            let optionA = $("#editOptionA").val().trim();
            let optionB = $("#editOptionB").val().trim();
            let optionC = $("#editOptionC").val().trim();
            let optionD = $("#editOptionD").val().trim();
            let correctAnswer = $("#editAnswer").val().trim();

            // Kiểm tra đáp án có nằm trong 4 phương án không
            if (
                correctAnswer !== optionA &&
                correctAnswer !== optionB &&
                correctAnswer !== optionC &&
                correctAnswer !== optionD
            ) {
                alert("Đáp án đúng không trùng khớp với bất kỳ đáp án A, B, C hoặc D.");
                return; // Dừng lại, không gửi form
            }


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
                url: "models/updateQuestion.php",
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
            
                    // Lấy giá trị các đáp án
            let optionA = $("#insertOptionA").val().trim();
            let optionB = $("#insertOptionB").val().trim();
            let optionC = $("#insertOptionC").val().trim();
            let optionD = $("#insertOptionD").val().trim();
            let correctAnswer = $("#insertAnswer").val().trim();

            // Kiểm tra đáp án có nằm trong 4 phương án không
            if (
                correctAnswer !== optionA &&
                correctAnswer !== optionB &&
                correctAnswer !== optionC &&
                correctAnswer !== optionD
            ) {
                alert("Đáp án đúng không trùng khớp với bất kỳ đáp án A, B, C hoặc D.");
                return; // Dừng lại, không gửi form
            }


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
                url: "models/insertQuestion.php",
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
                url: "models/insertCategory.php",
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
                $.post("models/removeCategory.php", { name: categoryName }, function (response) {
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
                $.post("models/removeQuestion.php", { id: productId }, function (response) {
                    alert(response);
                    location.reload();
                });
            }
        });
    });
</script>
