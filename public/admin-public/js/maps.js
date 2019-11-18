var Maps = function () {
	"use strict";
    //function to initiate Maps
    //For more information, please visit https://opencagedata.com/tutorials/geocode-in-jquery
    var runMaps = function () {
        var url ='https://api.opencagedata.com/geocode/v1/map';
    };
    return {
        //main function to initiate template pages
        init: function () {
            runMaps();
        }
    };
}();