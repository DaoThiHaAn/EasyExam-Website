
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/viewCreatTest.php';

?>

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
                url: "models/fetchDatabase.php",
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
            const userId = <?= isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null' ?>;
            if (!testName || !testTime || selectedQuestionIds.size === 0) {
                alert("Vui lòng nhập đủ thông tin và chọn ít nhất một câu hỏi!");
                return;
            }
            // console.log(testCategory);
            console.log(testName);
            console.log(testTime);
            console.log(userId);
            $.ajax({
                url: "models/insertTest.php",
                type: "POST",
                data: {
                    test_name: testName,
                    test_time: testTime,
                    test_category: testCategory,
                    created_by: userId,
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


