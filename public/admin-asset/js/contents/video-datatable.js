/*=========================================================================================
    File Name: video-datatable
    Description: Video Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#video-page'),
		$table = {};

	var videoPage = {
		dtTable: {},
		init: function () {
			var data_id = '';
			this.initDatatable();
            $('#video-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

			$('#form-add-video').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.post('/admin/gallery', data)
				.done(function (response) {
					$(this).find("input, textarea").val('');
					$('#form-add-video select').val(null).trigger('change');
					$('button.close').click();
					swal({
						title: "Success!",
						text: "New video has been added!",
						icon: "success"
					});
					videoPage.dtTable.ajax.reload(null, false);
				});
			});

			$(document).on('click', '.edit', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/gallery/' + data_id)
				.done(function (response) {
					$('#input-filename').val(response.filename);
					$('#select2-event').append('<option value="' + response.calendar.id + '" selected="selected">' + response.calendar.title + '</option>');
					$('#select2-event').trigger('change');
					$('#edit-video-modal').modal('show');
				});
			});

			$('#form-edit-video').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.ajax({
					url: '/admin/gallery/' + data_id,
					data: data,
					type: 'PUT',
					success: function(response) {
						$(this).find("input, textarea").val('');
						$('#form-edit-video select').val(null).trigger('change');
						$('button.close').click();
						swal({
							title: "Success!",
							text: "Video has been edited!",
							icon: "success"
						});
						videoPage.dtTable.ajax.reload(null, false);
					}
				});
			});

			$(document).on('click', '.view', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/gallery/' + data_id)
				.done(function (response) {
					$('.video-preview').attr('src', response.url);
					$('#preview-video-modal').modal('show');
				});
			});

			$(document).on('click', '.text-danger.delete', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this video!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
						$.ajax({
						    url: '/admin/gallery/' + data_id,
						    type: 'DELETE',
						    success: function(response) {
								videoPage.dtTable.ajax.reload(null, false);
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

			$("select").select2({
				allowClear: true,
                placeholder: 'Enter event name',
                ajax: {
                    url: '/admin/ajax/calendar',
                    delay: 200,
                    dataType: 'json',
                    type: 'POST',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            mode: 'select2'
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                },
                minimumInputLength: 2,
				width: '100%',
            });
		},
		initDatatable: function () {
			$table = $page.find('#video-datatable');
			videoPage.dtTable = $table.DataTable({
				"aaSorting": [],
		        "processing": true,
	            "serverSide": true,
	            "searching": true,
	            "lengthChange": false,
	            "ajax": {
	                url: "/admin/ajax/file",
	                type: "POST",
	                data: function (d) {
						d.mode = 'datatable';
						d.search = 'video';
					}
	            },
		        "columns": [
		            { data: 'event_name', name: 'event_name' },
		            { data: 'filename', name: 'filename' },
		            { data: 'uploader', name: 'uploader' },
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
		videoPage.init();
	}
});
