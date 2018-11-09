/*=========================================================================================
    File Name: calendar-datatable
    Description: Calendar Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#calendar-page'),
		$table = {};

	var calendarPage = {
		dtTable: {},
		init: function () {
			$(document).on('click', 'img.img-thumbnail', function () {
				$('#img-preview-modal img').attr('src', $(this).attr('src'));
				$('#img-preview-modal').modal('show');
			});

			var data_id = '';
			this.initDatatable();
            $('#calendar-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

			$(document).on('change', '#select-type', function () {
				calendarPage.dtTable.ajax.reload();
			});

			$('#form-add-event').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.post('/admin/calendar', data)
				.done(function (response) {
					$(this).find("input, textarea").val('');
					$('button.close').click();
					swal({
						title: "Success!",
						text: "New event has been deleted!",
						icon: "success"
					});
					calendarPage.dtTable.ajax.reload(null, false);
				});
			});

			$(document).on('click', '.view', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/calendar/' + data_id)
				.done(function (response) {
					$('#title').val(response.title);
					$('#date').val(response.date);
					$('#start_hour').val(response.start_hour);
					$('#end_hour').val(response.end_hour);
					$('#edit-event-modal').modal('show');
				});
			});

			$('#form-edit-event').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.ajax({
					url: '/admin/calendar/' + data_id,
					data: data,
					type: 'PUT',
					success: function(response) {
						$(this).find("input, textarea").val('');
						$('button.close').click();
						swal({
							title: "Success!",
							text: "Event has been edited!",
							icon: "success"
						});
						calendarPage.dtTable.ajax.reload(null, false);
					}
				});
			});

			$(document).on('click', '.text-danger.delete', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this event!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
						$.ajax({
						    url: '/admin/calendar/' + data_id,
						    type: 'DELETE',
						    success: function(response) {
								calendarPage.dtTable.ajax.reload(null, false);
								swal({
									title: "Success!",
									text: "Poof! Your event has been deleted!",
									icon: "success"
								});
						    }
						});
				  	}
				});
			});
		},
		initDatatable: function () {
			$table = $page.find('#calendar-datatable');
			calendarPage.dtTable = $table.DataTable({
				"aaSorting": [],
		        "processing": true,
	            "serverSide": true,
	            "searching": true,
	            "lengthChange": false,
	            "ajax": {
	                url: "/admin/ajax/calendar",
	                type: "POST",
	                data: function (d) {
						d.mode = 'datatable';
						d.type = $('#select-type').val();
					}
	            },
		        "columns": [
		            { data: 'title', name: 'title' },
					{ data: 'filename', name: 'filename' },
		            { data: 'start_hour', name: 'start_hour' },
		            { data: 'end_hour', name: 'end_hour' },
		            { data: 'date', name: 'date' },
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
		calendarPage.init();
	}
});
