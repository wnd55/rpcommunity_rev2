$(document).ready(function () {

    var count = {
        count: 10
    };
    var user = {
        name: null
    };

    $('#btnSetUsername').click(function () {


        var username = $('#username');
        var name = username.val();
        user = {

            name: name
        };
        $('#message').focus();

    });

    $('#btnSend').on('click', function () {

        var message = $('#message');
        var text = message.val();
        message.val('');


        $.ajax({
            url: '/site/index',
            type: 'post',
            dataType: 'html',
            data: {
                'message': text,
                '_csrf-frontend': yii.getCsrfToken()
            },
            success: function (data) {

                count.count += 10;
                var name = user.name ? user.name : 'гость';

                var template = '<div class="direct-chat-text" style="margin-left: ' + count.count + 'px"> ' + name + ' : ' + data + '</div> '

                $('#chat').append(template).scrollTop(500);
                if (count.count > 50)
                    count.count = 10;

            },

            error: function () {

                var errorInfo = '<span class="alert">Измените условие выбора</span>';
                return $('#chat').after(errorInfo);
            }

        })

    });


    $('#btnClean').click(function () {


            $.ajax({

                url: '/site/clean-chat',
                type: 'post',
                data: {
                    '_csrf-frontend': yii.getCsrfToken()
                },
                success: function (data) {


                    return $('#chat').html('');


                },
                error: function () {

                    var errorInfo = '<span class="alert">Измените условие выбора</span>';
                    return $('#chat').after(errorInfo);
                }
            })

        }
    );

});