var DialogBoxes = function() {
	"use strict";

	//function to initiate programmatic dialog boxes
	var initDialogBoxes = function() {
		var afterActionTypes = {};

		$(document).on("click", "a.delete", function(e) {
			e.preventDefault();
			var type = $(this).data("type");
			var name = $(this).data("name");
			var url = $(this).attr("href");
			var currentElement = $(this);

            bootbox.dialog({
                message : "Are you sure you want to delete this " + name + "?",
                title : "Delete " + name,
                buttons : {
                    success : {
                        label : "Yes!",
                        className : "btn-success",
                        callback : function() {
                            $.ajax({
                                url: url,
                                type: 'post',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {_method: 'DELETE'},
                                success: function(data) {
                                    //called when successful
                                    var result = JSON.parse(data);

                                    if(result.success) {
                                        toastr.success(result.success);
                                        if ( typeof afterActionTypes[type] === 'function') {
                                            afterActionTypes[type](currentElement);
                                        }
                                    }else if (result.error) {
                                        toastr.error(result.error);
                                    }
                                },
                                error: function(e) {
                                    //called when there is an error
                                    toastr.error(e.message);
                                }
                            });

                        }
                    },
                    danger : {
                        label : "No!",
                        className : "btn-danger",
                        callback : function() {

                        }
                    }
                }
            });
		});

        afterActionTypes.button_in_table = function(currentElement) {
            var parentTr = currentElement.closest("tr");
            parentTr.fadeOut(900, function(){ $(this).remove();});
        };
        afterActionTypes.button_in_panel = function(currentElement) {
            $('.panel-body').addClass('center').children('div').remove();
            $('.panel-tools').empty();
            $('.create-button').removeClass('no-display');
        };
        afterActionTypes.button_in_sub_view = function(currentElement) {
            var parentLi = currentElement.closest("li.post-comment");
            parentLi.fadeOut(900, function(){ $(this).remove();});
        };
	};

	return {
		init : function() {
			initDialogBoxes();
		}
	};
}(); 