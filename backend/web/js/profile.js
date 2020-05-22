(function () {

    var ch1 = $("#profilecreateform-check1");
    var ch2 = $("#profilecreateform-check2");

    ch1.on('click', function () {

        if(ch1.is(':checked')) {

            ch2.prop('checked', false);
        }

    });

    ch2.on('click', function () {

        if(ch2.is(':checked')) {

            ch1.prop('checked', false);
        }
    })

})(window.jQuery);

