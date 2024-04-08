document.addEventListener('DOMContentLoaded', function () {
    const openMenuBtn = document.querySelector('.open-menu-btn');
    const body = document.body;
    const breakpoint = 768;

    function toggleMenu() {
        const isMenuClosed = body.classList.contains('closed-menu');
        body.classList.toggle('closed-menu', !isMenuClosed);
    }

    function updateMenuState() {
        const isScreenSmall = window.innerWidth <= breakpoint;
        body.classList.toggle('closed-menu', isScreenSmall);
    }

    updateMenuState();

    window.addEventListener('resize', function () {
        updateMenuState();

        if (window.innerWidth <= breakpoint && !body.classList.contains('closed-menu')) {
            toggleMenu();
        }
    });

    openMenuBtn.addEventListener('click', toggleMenu);
});

// form validation
$(document).ready(function () {
    $('form[data-handle-errors]').on('submit', function (e) {
        $("#form-submit-fail").remove();
        let form = $(this);
        form.find('[data-error]').remove();
        let fieldsWithError = form.find('[data-error-message]').filter(function () {
            let value = $(this).val();
            return !value || value.trim() === '';
        });

        if (fieldsWithError.length > 0) {
            e.preventDefault();
            fieldsWithError.each(function () {
                let errorMessage = $(this).data('error-message');
                $(this).after('<div class="error-message" data-error style="color: red;">' + errorMessage + '</div>');
            });
        }
    });
});
