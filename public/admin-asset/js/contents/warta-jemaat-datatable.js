/*=========================================================================================
    File Name: warta-datatable
    Description: Warta Jemaat Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#warta-jemaat-page'),
		$table = {};

	var wartaJemaatPage = {
		dtTable: {},
		init: function () {
			this.initDatatable();
            $('#warta-jemaat-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');
			var data_id = '';
			$(document).on('click', '.edit', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/warta/' + data_id + '/edit')
				.done(function (response) {
					$('#input-title').val(response.title);
					$('#edit-warta-modal').modal('show');
				});
			});

			$('#form-edit-warta').on('submit', function (e) {
				e.preventDefault();
				var formData = new FormData(this);
				formData.append('_method', 'PATCH');
				$.ajax({
		        	url: "/admin/warta/" + data_id,
					type: "POST",
					data:  formData,
					contentType: false,
		    	    cache: false,
					processData: false,
					success: function(response) {
						$(this).find("input, textarea").val('');
						$('button.close').click();
						swal({
							title: "Success!",
							text: "Warta Jemaat has been edited!",
							icon: "success"
						});
						wartaJemaatPage.dtTable.ajax.reload(null, false);
				    },
				  	error: function(response) {
						if(typeof response.responseJSON.errors.file !== 'undefined'){
							var error = response.responseJSON.errors.file[0];
							$('button.close').click();
							swal("Error", error, "error");
						}
					}
			   });
			});

			$(document).on('click', '.view', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				var input_filename = $('.input-filename');
				$.get('/admin/warta/' + data_id + '/edit')
				.done(function (response) {
					$('#warta-text-modal').text(response.title);
					$('#warta-iframe-modal').attr('src', response.path);
					$('#preview-warta-modal').modal('show');
				});
			});

			$(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
                $('#input-filename').text(label);
            });

			$('#form-add-warta').on('submit', function (e) {
				e.preventDefault();
				if($('input[type=file]').val() == ''){
					$('#error').show();
					return false;
				}
				var formData = new FormData(this);
				$.ajax({
		        	url: "/admin/warta",
					type: "POST",
					data:  formData,
					contentType: false,
		    	    cache: false,
					processData: false,
					success: function(response) {
						$(this).find("input, textarea").val('');
						$('button.close').click();
						wartaJemaatPage.dtTable.ajax.reload(null, false);
						swal({
							title: "Success!",
							text: "Warta Jemaat has been uploaded!",
							icon: "success"
						});
				    },
				  	error: function(response) {
						if(typeof response.responseJSON.errors.file !== 'undefined'){
							var error = response.responseJSON.errors.file[0]
							$('#error_message').text(error);
						}
					}
			   });
			});

			$(document).on('click', '.edit', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/warta/' + data_id)
				.done(function () {

				});
			});

			$(document).on('click', '.text-danger.delete', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this post!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
						$.ajax({
						    url: '/admin/warta/' + data_id,
						    type: 'DELETE',
						    success: function(response) {
								wartaJemaatPage.dtTable.ajax.reload(null, false);
								swal({
									title: "Success!",
									text: "Poof! Your post has been deleted!",
									icon: "success"
								});
						    }
						});
				  	}
				});
			});
		},
		initDatatable: function () {
			$table = $page.find('#warta-jemaat-datatable');
			wartaJemaatPage.dtTable = $table.DataTable({
				"aaSorting": [],
		        "processing": true,
	            "serverSide": true,
	            "searching": true,
	            "lengthChange": false,
	            "ajax": {
	                url: "/admin/ajax/warta",
	                type: "POST",
	                data: function (d) {
						d.mode = 'datatable';
						d.search = 'jemaat';
					}
	            },
		        "columns": [
		            { data: 'title', name: 'title' },
		            { data: 'uploader', name: 'uploader' },
					{ data: 'size', name: 'size' },
		            { data: 'created_at', name: 'created_at' },
		            { data: 'action', name: 'action' },
		        ],
		        "columnDefs": [
	                { targets: 'no-sort', orderable: false },
	                { targets: 'no-search', searchable: false },
					{ targets: 'text-center', className: 'text-center' },
	            ],
		    });
		}
	};

	if ($page.length) {
		wartaJemaatPage.init();
	}
});
