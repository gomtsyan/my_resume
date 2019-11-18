var TableData = function() {
	"use strict";
	//function to initiate DataTable
	//DataTable is a highly flexible tool, based upon the foundations of progressive enhancement,
	//which will add advanced interaction controls to any HTML table
	//For more information, please visit https://datatables.net/
	var runDataTable = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var visitors = $('#visitors');
        var url = visitors.data('url');
        var imgPath = visitors.data('img-path')+'/flag.png';

		var oTable = visitors.dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[0, 'desc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
				{ data: 'id', name: 'id' },

				{
					data: 'country_flag',
					name: 'country_flag',
                    render: function(data, type, full, meta){
						var flag = data ? data : imgPath;
                        return "<img src=" + flag + "  class='thumbnail' alt='flag' />";
                    }
				},
                { data: 'country_name', name: 'country_name' },
				{ data: 'city', name: 'city' },
				{
					data: 'visit_count',
					name: 'visit_count',
                    render: function(data, type, full, meta){

                        return "<a href='#visited-pages-subview' " +
                            "class='btn btn-yellow show-sv' " +
                            "title='Show Viewed Pages' " +
                            "data-startFrom='right' " +
                            "data-url='/admin/visited_pages/"+full.id+"'>" +
                            "<i class='fas fa-eye'></i>" + data + "</a>";
                    }
				},
				{
					data: 'is_download_file',
					name: 'is_download_file',
                    render: function(data, type, full, meta){
						var disabled = data ? '' : 'disabled';
						var color = data ? 'success' : 'red';
						var title = data ? 'cv downloaded' : '';
                        return '<button href="javascript:void(0);" ' +
							'class="btn btn-'+color+'" ' + disabled +
							' title="'+title+'">' +
							'<i class="fas fa-download"></i></button>';
                    }
				},
                {data: 'updated_at', name: 'updated_at'},
                {
                    data: 'latitude',
                    name: 'latitude',
                    render: function(data, type, full, meta){
                        var disabled = (full.latitude && full.longitude) ? '' : 'disabled';

                        return '<button href="#visitor-map-subview" ' +
                            'class="show-map-sv btn btn-azure" ' + disabled +
                            ' data-latitude="'+full.latitude+'" ' +
                            'data-longitude="'+full.longitude+'" ' +
                            'data-id="'+full.id+'" ' +
                            'title="Show In Map">' +
                            '<i class="fas fa-map-marked-alt"></i></button>' +
							'<div id="map-'+full.id+'" class="no-display"></div>';
                    }
                },
			]
		});
		$('#visitors_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#visitors_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#visitors_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#visitors_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, (bVis ? false : true));
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			runDataTable();
		}
	};
}();
