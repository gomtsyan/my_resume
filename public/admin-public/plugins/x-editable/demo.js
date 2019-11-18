$(function(){
  
    //defaults
    $.fn.editable.defaults.url = '/post';
    var c = window.location.href.match(/c=inline/i) ? 'inline' : 'popup';
    $.fn.editable.defaults.mode = c === 'inline' ? 'inline' : 'popup';
    
    //editables
    $('#theme_color').editable({
        ajaxOptions: {
            type: 'post',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        },
        params: {_method: 'PUT'},
        source: [
            {value: 'blue', text: 'Blue'},
            {value: 'brown', text: 'Brown'},
            {value: 'green', text: 'Green'},
            {value: 'orange', text: 'Orange'},
            {value: 'purple', text: 'Purple'},
            {value: 'red', text: 'Red'}
        ],
        success: function(response, newValue) {
            toastr.success(response.success);
        }
    });

    $('#articles_count').editable({
        ajaxOptions: {
            type: 'post',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        },
        params: {_method: 'PUT'},
        source: [
            {value: 3, text: '3'},
            {value: 5, text: '5'},
            {value: 10, text: '10'},
            {value: 15, text: '15'},
            {value: 25, text: '25'}
        ],
        success: function(response, newValue) {
            toastr.success(response.success);
        }
    });

    $('#recent_posts').editable({
        ajaxOptions: {
            type: 'post',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        },
        params: {_method: 'PUT'},
        source: [
            {value: 2, text: '2'},
            {value: 3, text: '3'},
            {value: 4, text: '4'},
            {value: 5, text: '5'}
        ],
        success: function(response, newValue) {
            toastr.success(response.success);
        }
    });
});