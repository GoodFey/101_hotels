function getSortParams() {
    return {
        sortBy: $('#sortBy').val(),
        sortDir: $('#sortDir').val()
    };
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validateNameField() {
    const email = $('#name').val().trim();
    const errorEl = $('#nameError');
    const inputEl = $('#name');

    if (!email) {
        errorEl.text('Email is required').addClass('show');
        inputEl.addClass('is-invalid');
        return false;
    }

    if (!validateEmail(email)) {
        errorEl.text('Enter a valid email address').addClass('show');
        inputEl.addClass('is-invalid');
        return false;
    }

    errorEl.text('').removeClass('show');
    inputEl.removeClass('is-invalid');
    return true;
}

function validateTextField() {
    const text = $('#text').val().trim();
    const errorEl = $('#textError');
    const inputEl = $('#text');

    if (!text) {
        errorEl.text('Comment cannot be empty').addClass('show');
        inputEl.addClass('is-invalid');
        return false;
    }

    if (text.length < 5) {
        errorEl.text('Minimum 5 characters').addClass('show');
        inputEl.addClass('is-invalid');
        return false;
    }

    errorEl.text('').removeClass('show');
    inputEl.removeClass('is-invalid');
    return true;
}

function refreshComments(page = 1) {
    const sortParams = getSortParams();
    $.ajax({
        url: '/comments/list',
        type: 'GET',
        data: {
            page: page,
            sortBy: sortParams.sortBy,
            sortDir: sortParams.sortDir
        },
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
        if (!confirm('Are you sure?')) return;

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

    $('#sortBy, #sortDir').on('change', function() {
        refreshComments(1);
    });

    $('#name, #text').on('focus', function() {
        $(this).removeClass('is-invalid');
        $(`#${this.id}Error`).text('').removeClass('show');
    });

    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        
        if (!validateNameField() || !validateTextField()) {
            return false;
        }

        const formData = {
            name: $('#name').val(),
            text: $('#text').val()
        };

        $.ajax({
            url: '/comments',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#commentForm')[0].reset();
                    $('#nameError, #textError').text('').removeClass('show');
                    $('#name, #text').removeClass('is-invalid');

                    const alert = $(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
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
                        $(`#${key}Error`).text(value).addClass('show');
                        $(`#${key}`).addClass('is-invalid');
                    });
                }
            }
        });
    });

    bindDeleteButtons();
    bindPaginationLinks();
}

$(document).ready(initComments);

