var UIButtons = function () {
	"use strict";
    var runSwitchButtons = function () {
        $("input[type='checkbox'].make-switch").bootstrapSwitch();
    };
    return {
        //main function to initiate template pages
        init: function () {
            runSwitchButtons();
        }
    };
}();