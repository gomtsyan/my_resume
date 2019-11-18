$(document).ready(function(){

    "use strict";

    /*
     ----------------------------------------------------------------------
     Resume
     ----------------------------------------------------------------------
     */

    $('#skills-grid').mixItUp();

    $('#skills-grid').on('mixEnd', function(e, state){
        $(state.activeFilter+" a").attr("rel", "visiblegallery");
    });

    $('#skills-grid').on('mixEnd', function (e, state) {
        var n = state.$show.length;
        var ourClass = state.$show;
        $('.mix').removeClass('active-mix');
        $('.mix').removeClass('active-mix-first');
        $(ourClass[0]).addClass('active-mix-first');
        for (var i = 0; i < n; i++) {
            $(ourClass[i]).addClass('active-mix');
        }
    });

    $(".ratyli").ratyli();

}); // End $(document).ready(function(){