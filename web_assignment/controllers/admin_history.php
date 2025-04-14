<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__.'/../views/admin/viewHistoryAdmin.php';
?>

<script>
    $(document).ready(function () {
        let currentCategory = 0;
        let currentSearch = "";
        let currentOrder = "";
        let selectedQuestionIds = new Set(); // Tập hợp lưu câu hỏi đã chọn

        function loadProducts(category = 0, page = 1, search = "", order = "") {


            $.ajax({
                url: "models/getQuestionName_admin.php",
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
            window.location.href = "index.php?page=admin_statistic&test_id=" + testId;
        }
    });


</script>
