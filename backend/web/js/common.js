(function ($) {

    $('.grid-view input[type ="checkbox"]').on('click', function () {

        var checkbox = $('.grid-view input[type ="checkbox"]');

        if (checkbox.is(':checked')) {

            $('#btnDelete').removeClass('type-hidden');
        } else {

            $('#btnDelete').addClass('type-hidden');
        }

    });

    $('#btnDelete').on('click', function () {

        var keys = $('.grid-view').yiiGridView('getSelectedRows');
        var href = window.location.pathname;
        var action = window.location.origin + '/admin/user/delete-selected';

        $.ajax({
            url: action,
            type: 'post',
            data: {
                id: keys
            },
            success: function (data) {

                window.location = href;
                return $('#btnDelete').addClass('type-hidden');


            },
            error: function () {

                var errorInfo = '<span class="alert alert-warning fade in">Измените условие выбора</span>';
                return $('#btnDelete').after(errorInfo);
            }
        });
    })

})(window.jQuery);


