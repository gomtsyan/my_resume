var UIMessages = function () {
    "use strict";

    //function to initiate show single message
    var initSingleMessage = function () {
        var demos = {};

        $("body").on("click", ".messages-item", function (e) {
            e.preventDefault();
            var currentElement = $(this);
            var type = currentElement.data("bb");
            var url = currentElement.data("route");

            $('.messages-item').removeClass('active');
            $(this).addClass('active');

            if (typeof demos[type] === 'function') {
                demos[type](url, currentElement);
            }
        });

        // let's namespace the demo methods; it makes them easier
        // to invoke

        demos.singleMessage = function (url, currentElement) {
            $.ajax({
                url: url,
                type: 'get',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    //called when successful
                    var result = JSON.parse(data);

                    if (result.success) {
                        $('.messages-content').removeClass('flex').html(result.success);

                        var currentImage = currentElement.children('img');
                        var currentImageSrc = currentImage.attr('src');
                        var currentImageData = currentImage.data('image');

                        if (currentImageSrc !== currentImageData) {
                            currentImage.attr('src', currentImageData)
                        }
                    } else if (result.error) {
                        toastr.error(result.error);
                    }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
        };
    };
    //function to initiate delete message
    var initDeleteMessage = function () {

        $("body").delegate(".delete", "click", function (e) {
            e.stopPropagation();
            e.preventDefault();
            var currentElement = $(this);
            var url = currentElement.attr("href");
            var parentLi = currentElement.closest('li');

            bootbox.dialog({
                message: "Are you sure you want to delete this message?",
                title: "Delete Message",
                buttons: {
                    success: {
                        label: "Yes!",
                        className: "btn-success",
                        callback: function () {
                            $.ajax({
                                url: url,
                                type: 'post',
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {_method: 'DELETE'},
                                success: function (data) {
                                    //called when successful
                                    var result = JSON.parse(data);

                                    if (result.success) {
                                        toastr.success(result.success);
                                        parentLi.fadeOut(900, function () {
                                            $(this).remove();
                                        });
                                    } else if (result.error) {
                                        toastr.error(result.error);
                                    }
                                },
                                error: function (e) {
                                    //called when there is an error
                                    console.log(e.message);
                                }
                            });
                        }
                    },
                    danger: {
                        label: "No!",
                        className: "btn-danger",
                        callback: function () {

                        }
                    }
                }
            });
        });
    };
    //function to initiate delete message
    var initSearchMessage = function () {

        $(".messages-search").delegate(".start-search", "click", function (e) {
            e.preventDefault();
            var form = $(".search-form");
            var url = form.attr("action");

            $.ajax({
                url: url,
                type: 'get',
                data: form.serialize(),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (data) {
                    //called when successful
                    var result = JSON.parse(data);

                    if (result.success) {
                        $('.messages-item').remove();
                        $('.messages-pagination').remove();
                        $('ul.messages-list').append(result.success);
                    } else if (result.error) {
                        console.log(result.error);
                    }
                },
                error: function (e) {
                    //called when there is an error
                    toastr.error(e.responseJSON.errors.query[0]);
                }
            });
        });
    };
    return {
        init: function () {
            initSingleMessage();
            initDeleteMessage();
            initSearchMessage();
        }
    };
}(); 