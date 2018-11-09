/*=========================================================================================
    File Name: post-datatable
    Description: Post Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#article-page'),
		$table = {};

	var articlePage = {
		dtTable: {},
		init: function () {
			this.initDatatable();
            $('#article-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

			$(document).on('click', '.text-danger.delete', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this article!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
						$.ajax({
						    url: '/admin/article/' + data_id,
						    type: 'DELETE',
						    success: function(response) {
								articlePage.dtTable.ajax.reload(null, false);
								swal({
									title: "Success!",
									text: "Poof! Your video has been deleted!",
									icon: "success"
								});
						    }
						});
				  	}
				});
			});
		},
		initDatatable: function () {
			$table = $page.find('#article-datatable');
			articlePage.dtTable = $table.DataTable({
				"aaSorting": [],
		        "processing": true,
	            "serverSide": true,
	            "searching": true,
	            "lengthChange": false,
	            "ajax": {
	                url: "/admin/ajax/article",
	                type: "POST",
	                data: function (d) { d.mode = 'datatable'; }
	            },
		        "columns": [
		            { data: 'title', name: 'title' },
		            { data: 'author', name: 'author' },
		            { data: 'views', name: 'views' },
		            { data: 'timestamp', name: 'timestamp' },
		            { data: 'action', name: 'action' },
		        ],
		        "columnDefs": [
	                { targets: 'no-sort', orderable: false },
	                { targets: 'no-search', searchable: false },
                    { targets: 'wrap-text', render: function (data,type,row) { return data.length > 70 ? data.substr( 0, 70 ) + '…' :data; } },
					{ targets: 'text-center', className: 'text-center' },
	            ],
		    });
		}
	};

	if ($page.length) {
		articlePage.init();
	}
});
