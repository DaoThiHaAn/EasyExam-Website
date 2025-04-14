<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/admin/viewCreatTest.php';
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
        let selectedQuestionIds = new Set(); // Set to track selected question IDs

        function restoreSelections() {
            $(".form-check-input").each(function () {
                const id = $(this).data("id");
                if (selectedQuestionIds.has(id)) {
                    $(this).prop("checked", true);
                }
            });
            $('#selectedCount span').text(selectedQuestionIds.size);
        }

        function loadProducts(category = null, pagenum = 1, search = "", order = "") {
            if (category === null || category === "0") {
                $("#product-list").html("");
                $("#pagination").html("");
                return;
            }

            // Update URL parameters
            updateUrlParams({ category, search, order, pagenum });

            $.ajax({
                url: "models/fetchDatabase.php",
                type: "GET",
                data: { category, pagenum, search, order },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#product-list").html(data.products);
                    $("#pagination").html(data.pagination);
                    $('#resultCount span').text(data.total);
                    MathJax.typeset();

                    restoreSelections(); // Restore checkbox states
                }
            });
        }

        $(".category-btn").click(function () {
            currentCategory = $(this).data("category");
            $("#categorySelect").val(currentCategory);
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $("#categorySelect").change(function () {
            currentCategory = $(this).val();
            $('#selectedCount span').text(0);
            loadProducts(currentCategory, 1, currentSearch, currentOrder);
        });

        $(document).on("click", ".page-link", function (e) {
            e.preventDefault();
            let pagenum = $(this).data("page");
            updateUrlParams({ pagenum, category: currentCategory, search: currentSearch, order: currentOrder });
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
                selectedQuestionIds.delete(questionId);
            }
            $('#selectedCount span').text(selectedQuestionIds.size);
        });

        // Form submission: create test
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
                alert("Please fill in all fields and select at least one question.");
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
                    $('#selectedCount span').text(0);
                    loadProducts(currentCategory, 1, currentSearch, currentOrder);
                }
            });
        });

        loadProducts(currentCategory); // Initial load
    });

    // Local filtering for a simple list (unrelated to pagination)
    function searchFunction() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let items = document.querySelectorAll("#list li");

        items.forEach(item => {
            if (item.textContent.toLowerCase().includes(input)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }
</script>
