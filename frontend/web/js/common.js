$(document).ready(function () {


    $("#ampMenu").menu({
        resizeWidth: 1200, // Set the same in Media query
        animationSpeed: 'fast', //slow, medium, fast
        accoridonExpAll: false //Expands all the accordion menu on click
    });


    //Активная ссылка
    var url = window.location.href;
    $('#ampMenu li a').each(function () {
        if (this.href === url) {

           $(this).closest('li a').addClass('active-link');

        }
    });
});