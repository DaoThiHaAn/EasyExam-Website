$(document).ready(function () {
    function loadQuestions(page = 1) {
        $.ajax({
            url: 'models/fetchDatabase.php',
            type: 'GET',
            data: {
                category: $('#categorySelect').val(),
                search: $('#searchInput').val(),
                order: $('#sortSelect').val(),
                page: page
            },
            success: function(response) {
                let data = JSON.parse(response);
                $('#product-list').html(data.products);
                $('.pagination').html(data.pagination);
                $('#resultCount span').text(data.total);
            }
        });
    }

    // Bind pagination and checkbox events
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        loadQuestions(page);
    });

    $(document).on('change', '.form-check-input', function(){
        let selectedCount = $('.form-check-input:checked').length;
        $('#selectedCount span').text(selectedCount);
    });

    // Initial load of questions
    loadQuestions();
});