$(document).ready(function () {

    "use strict";

    /*
     ----------------------------------------------------------------------
     Animated menu
     ----------------------------------------------------------------------
     */


    $(".menu .menu-img").on({
        mouseenter: function () {
            var $div = $(this);
            var img = document.createElement('img');
            var img_name = $div.attr("data-img-name");
            img.src = "./site/img/menu/" + img_name + ".gif?t=" + new Date().getTime();

            $(img).load(function () {
                $div.attr("src", img.src);
            });
        },
        mouseleave: function () {
            var $div = $(this);
            var img_name = $div.attr("data-img-name");
            var src = "./site/img/menu/" + img_name + ".png";
            $div.attr("src", src);

        }
    });


    /*
     ----------------------------------------------------------------------
     Preloader
     ----------------------------------------------------------------------
     */
    
    $(".loader").delay(400).fadeOut();
    $(".animationload").delay(400).fadeOut("fast");


    /*
     ----------------------------------------------------------------------
     Scroll
     ----------------------------------------------------------------------
     */
    //Check to see if the window is top if not then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    //Click event to scroll to top
    $('.scrollToTop').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });


    /*
     ----------------------------------------------------------------------
     Animation
     ----------------------------------------------------------------------
     */
    $('.animated').appear(function () {
        var elem = $(this);
        var animation = elem.data('animation');
        if (!elem.hasClass('visible')) {
            var animationDelay = elem.data('animation-delay');
            if (animationDelay) {
                setTimeout(function () {
                    elem.addClass(animation + " visible");
                }, animationDelay);
            } else {
                elem.addClass(animation + " visible");
            }
        }
    });

    /*
     ----------------------------------------------------------------------
     Animated Counter
     ----------------------------------------------------------------------
     */
    $('.count').each(function () {
        $(".total-numbers .sum").appear(function () {
            var counter = $(this).html();
            $(this).countTo({
                from: 0,
                to: counter,
                speed: 2000,
                refreshInterval: 60
            });
        });
    });


    /*
     ----------------------------------------------------------------------
     Style contact form
     ----------------------------------------------------------------------
     */

    $('.style-open-form').on("click", function (el) {
        el.preventDefault();
        $('.style-contact-form').toggleClass('style-off-form');
    });

    $('.btn-close-form').on("click", function (el) {
        el.preventDefault();
        $('.style-contact-form').toggleClass('style-off-form');
    });

    /*
     ----------------------------------------------------------------------
     Contact form
     ----------------------------------------------------------------------
     */

    $(".close-msg").on("click", function () {
        $(this).parent().removeClass("success");
    });

    $("#user-name-panel, #user-email-panel").on("click", function () {

        $(this).removeClass("error");

    });

    /* Email validation */
    function valid_email_address(email) {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        return pattern.test(email);
    }

}); // End $(document).ready(function(){