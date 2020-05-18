(function ($) {

    $.fn.menu = function (options) {

        //Plugin's default options
        var defaults = {

            resizeWidth: '1200',
            animationSpeed: 'fast',
            accoridonExpAll: false
        };

        //variables
        var extendOptions = $.extend(defaults, options),

            $resizeWidth = options.resizeWidth,
            $animationSpeed = options.animationSpeed,
            $expandAll = options.accoridonExpAll,
            $menu = $(this),
            $menuStyle = $(this).attr('data-menu-style');

        //Initilizing menu
        $menu.find('ul').addClass('sub-menu');

        if ($menuStyle === 'accordion') {

            $(this).addClass('collapse');
        }


        //Window resize
        if ($(window).innerWidth() <= $resizeWidth) {
            menuCollapse();
        }
        $(window).resize(function () {
            menuCollapse();
        });

        //Menu toggles
        function menuCollapse() {

            var w = $(window).innerWidth();

            if (w <= $resizeWidth) {
                $(this).addClass('collapse');
                $menu.find('li.menu-active').removeClass('menu-active');
                $menu.find('ul.slide').removeClass('slide').removeAttr('style');
                $menu.addClass('collapse hide-menu');
                $menu.attr('data-menu-style', '');
                $('.navbar-header').hide();
                $('.menu-toggle').show();

            } else {

                $menu.attr('data-menu-style', $menuStyle);
                $menu.removeClass('collapse hide-menu').removeAttr('style');
                $('.menu-toggle').hide();
                $('.navbar-header').show();

                if ($menu.attr('data-menu-style') === 'accordion') {

                    $menu.addClass('collapse');

                    return;
                }
                $menu.find('li.menu-active').removeClass('menu-active');
                $menu.find('ul.slide').removeClass('slide').removeAttr('style');
            }
        }

        //BtnToggle click
        $('#menu-btn').click(function () {
            $menu.slideToggle().toggleClass('hide-menu');
        });


        return this.each(function () {

            //Horizontal menu
            $menu.on('mouseover', '> li a', function () {

                if ($menu.hasClass('collapse') === true) {

                    return false;
                }

                $(this).parent('li')
                    .siblings().children('.sub-menu').stop(true, true)
                    .slideUp($animationSpeed).removeClass('slide')
                    .removeClass('style').stop();

                $(this).parent().addClass('menu-active')
                    .children('.sub-menu').slideDown($animationSpeed)
                    .addClass('slide');
                return;
            });


            $menu.on('mouseleave', 'li', function () {
                if ($menu.hasClass('collapse') === true) {
                    return false;
                }
                $(this).off('click', '> li a');
                $(this).removeClass('menu-active');
                $(this).children('ul.sub-menu').stop(true, true)
                    .slideUp($animationSpeed).removeClass('slide')
                    .removeAttr('style');

                return;
            });


            // Function for Vertical/Responsive Menu on mouse click
            $menu.on('click', '> li a', function () {
                if ($menu.hasClass('collapse') === false) {
                    //return false;
                }
                $(this).off('mouseover', '> li a');
                if ($(this).parent().hasClass('menu-active')) {
                    $(this).parent().children('.sub-menu').slideUp().removeClass('slide');
                    $(this).parent().removeClass('menu-active');
                } else {
                    if ($expandAll === true) {
                        $(this).parent().addClass('menu-active')
                            .children('.sub-menu').slideDown($animationSpeed)
                            .addClass('slide');
                        return;
                    }
                    $(this).parent().siblings().removeClass('menu-active');
                    $(this).parent('li').siblings()
                        .children('.sub-menu').slideUp()
                        .removeClass('slide');
                    $(this).parent().addClass('menu-active')
                        .children('.sub-menu').slideDown($animationSpeed)
                        .addClass('slide');
                }
            });

        });


    }


})(jQuery);