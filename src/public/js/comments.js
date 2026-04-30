function refreshComments(page = 1) {
    $.ajax({
        url: '/comments/list',
        type: 'GET',
        data: { page: page },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#commentsContainer').html(response.html);
                bindDeleteButtons();
                bindPaginationLinks();
            }
        }
    });
}

function bindDeleteButtons() {
    $(document).off('click', '.delete-btn');
    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Вы уверены?')) return;

        const id = $(this).data('id');

        $.ajax({
            url: `/comments/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    refreshComments(1);
                }
            }
        });
    });
}

function bindPaginationLinks() {
    $(document).off('click', '#commentsContainer .pagination-btn');
    $(document).on('click', '#commentsContainer .pagination-btn', function() {
        const page = $(this).data('page');
        if (page) {
            refreshComments(page);
        }
    });
}

function initComments() {
    const today = new Date().toISOString().split('T')[0];
    $('#date').val(today);

    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        
        $('.text-danger').text('');
        
        const formData = {
            name: $('#name').val(),
            text: $('#text').val(),
            date: $('#date').val()
        };

        $.ajax({
            url: '/comments',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#commentForm')[0].reset();
                    $('#date').val(today);
                    
                    const alert = $(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ✅ ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    $('#commentForm').before(alert);
                    
                    setTimeout(() => alert.fadeOut(300, function() { $(this).remove(); }), 3000);
                    refreshComments(1);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (response && response.errors) {
                    $.each(response.errors, function(key, value) {
                        $(`#${key}Error`).text(value);
                    });
                }
            }
        });
    });

    bindDeleteButtons();
    bindPaginationLinks();
}

$(document).ready(initComments);

