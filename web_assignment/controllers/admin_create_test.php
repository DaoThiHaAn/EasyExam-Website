
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/viewCreatTest.php';

?>

<script>
    function updateUrlParams(params) {
        const url = new URL(window.location);
        Object.keys(params).forEach(key => {
            if (params[key] !== "" && params[key] !== null) {
                url.searchParams.set(key, params[key]);
            } else {
                url.searchParams.delete(key);
            }
        });
        history.pushState({}, '', url);
    }


    $(document).ready(function () {
        let currentCategory = null;
        let currentSearch = "";
        let currentOrder = "";
        let selectedQuestionIds = new Set(); // Tập hợp lưu câu hỏi đã chọn

        function loadProducts(category = null, pagenum = 1, search = "", order = "") {
            if (category === null || category === "0") {
                $("#product-list").html("");
                $("#pagination").html("");
                return;
            }

            // Update URL parameters
            updateUrlParams({
                category: category,
                search: search,
                order: order,
                pagenum: pagenum
            });

            $.ajax({
                url: "models/fetchDatabase.php",
                type: "GET",
                data: { category: category, pagenum: pagenum, search: search, order: order },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#product-list").html(data.products);
                    $("#pagination").html(data.pagination);
                    $('#resultCount span').text(data.total);
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
            $('#selectedCount span').text(0);
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $(document).on("click", ".pagenum-link", function (e) {
            e.preventDefault();
            let pagenum = $(this).data("pagenum");
            loadProducts(currentCategory, pagenum, currentSearch, currentOrder);
        });

        $("#searchInput").on("input", function () {
            currentSearch = $(this).val();
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $("#sortSelect").change(function () {
            currentOrder = $(this).val();
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });


        $(document).on("change", ".form-check-input", function () {
            let questionId = $(this).data("id");
            if ($(this).is(":checked")) {
                selectedQuestionIds.add(questionId);
            } else {
                $('#selectedCount span').text(0);
                selectedQuestionIds.delete(questionId);
            }
            let selectedCount = selectedQuestionIds.size;
            $('#selectedCount span').text(selectedCount);
        });
        // Gửi bài kiểm tra vào database
        $("#createTestForm").submit(function (e) {
            e.preventDefault();
            const h = String(document.getElementById("hours").value).padStart(2, '0');
            const m = String(document.getElementById("minutes").value).padStart(2, '0');
            const s = String(document.getElementById("seconds").value).padStart(2, '0');

            let testName = $("#testName").val();
            let testTime = `${h}:${m}:${s}`;
            let testCategory = $("#categorySelect").val();
            const userId = <?= isset($_SESSION['user_id']) ? json_encode($_SESSION['user_id']) : 'null' ?>;
            if (!testName || !testTime || selectedQuestionIds.size === 0) {
                console.log(testCategory);
                console.log(testName);
                console.log(testTime);
                console.log(userId);
                console.log(selectedQuestionIds)
                alert("Vui lòng nhập đủ thông tin và chọn ít nhất một câu hỏi!");
                return;
            }
            
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
    $(document).on('change', '.form-check-input', function(){
        let selectedCount = $('.form-check-input:checked').length;
        $('#selectedCount span').text(selectedCount);
    });


</script>


