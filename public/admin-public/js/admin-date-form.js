var AdminDateForm = function () {
	"use strict";
    //function to initiate bootstrap-touchspin
    var runDatePicker = function() {
        $('.date-picker').datepicker({
            autoclose: true
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            runDatePicker();
        }
    };
}();