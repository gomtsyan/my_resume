var FormElements = function() {
	"use strict";
	//function to initiate Select2
	var runSelect2 = function() {
		$(".search-select").select2({
			placeholder: "Select a State",
			allowClear: false
		});
	};
	return {
		//main function to initiate template pages
		init: function() {
			runSelect2();
		}
	};
}();
