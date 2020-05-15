$(function() {
    var chat = new WebSocket('ws://localhost:8080');
    chat.onmessage = function(e) {
        $('#response').text('');

        var response = JSON.parse(e.data);
        if (response.type) {
            $('#chat').append('<div><b>' + response.from + '</b>: ' + response.message + '</div>');
            $('#chat').scrollTop = $('#chat').height;
        } else if (response.message) {
            $('#response').text(response.message);
        }
    };
    chat.onopen = function(e) {
        $('#response').text("Соединение установлено! Пожалуйста, напишите ваше имя.");
    };

    chat.onclose = function (e) {

        $('#response').text("Чат будет доступен позже");
    }
    $('#btnSend').click(function() {
        if ($('#message').val()) {
            chat.send( JSON.stringify({'action' : 'chat', 'message' : $('#message').val()}) );
        } else {
            alert('Сообщение')
        }
    })

    $('#btnSetUsername').click(function() {
        if ($('#username').val()) {
            chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#username').val()}) );
        } else {
            alert('Ваше имя')
        }
    })
})