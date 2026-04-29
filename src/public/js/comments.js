function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
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
                    const comment = response.comment;
                    const $emptyAlert = $('#commentsList .alert-info');
                    
                    if ($emptyAlert.length) {
                        $emptyAlert.remove();
                    }
                    
                    const $newComment = $(`
                        <div class="card mb-3 comment-item" data-id="${comment.id}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-envelope"></i> ${escapeHtml(comment.name)}
                                </h5>
                                <p class="card-text">${escapeHtml(comment.text)}</p>
                                <small class="text-muted d-block mb-2">
                                    📅 ${comment.date}
                                </small>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${comment.id}">
                                    🗑️ Удалить
                                </button>
                            </div>
                        </div>
                    `);
                    
                    $('#commentsList').prepend($newComment);
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

    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Вы уверены?')) return;
        
        const id = $(this).data('id');
        const $item = $(this).closest('.comment-item');
        
        $.ajax({
            url: `/comments/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $item.fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            }
        });
    });
}

$(document).ready(initComments);

