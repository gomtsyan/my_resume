var UISubview = function() {
	"use strict";
	//function to initiate bootstrap extended modals
	var initSubview = function() {
		var visitorTable = $("#visitors");
        visitorTable.on("click", ".show-sv", function(){
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    if(data.content) {
                        $.subview({
                            content: "#visited-pages-subview",
                            onShow: function() {
                                $("#visited-pages-subview").html(data.content);
                            }
                        });
                    }else if (data.error) {
                        toastr.error(data.error);
                    }
                },
                error: function(e) {
                    //called when there is an error
                    toastr.error(e.message);
                }
            });

        });

        visitorTable.on("click", ".show-map-sv", function(){
        	var latitude = $(this).data('latitude');
        	var longitude = $(this).data('longitude');
        	var id = $(this).data('id');

            $.subview({
                content: "#visitor-map-subview",
                onShow: function() {

                    $('.panel-map').html('<div id="map"></div>');

                    var map = L.map('map').setView([latitude, longitude], 13);
                    var layer = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: 'Map data &copy;',
                        maxZoom: 18,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoiZ29tdHN5YW4iLCJhIjoiY2sxNmdzeDBmMTI1bDNkcGZ3c3NyMzdyYiJ9.TYlhtDAkL9GNaitHY-fFdw'
                    }).addTo(map);
                    var marker = L.marker([latitude, longitude]).addTo(map);
                }
            });
        });
	};
	return {
		init : function() {
			initSubview();
		}
	};
}(); 