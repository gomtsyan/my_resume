var TouchSpin = function () {
	"use strict";
    //function to initiate bootstrap-touchspin
    var runTouchSpin = function() {

        $(".touch-spin").TouchSpin({
            min: 0
        });

    };

    return {
        //main function to initiate template pages
        init: function () {
            runTouchSpin();
        }
    };
}();