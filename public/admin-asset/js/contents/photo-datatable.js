/*=========================================================================================
    File Name: photo-datatable
    Description: Photo Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#photo-page'),
		$table = {};

	var photoPage = {
		dtTable: {},
		init: function () {

			var data_id = '';
			let self = this;
			self.initDatatable();
            $('#photo-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

			$(document).on('click', 'img.img-thumbnail', function () {
				$('#img-preview-modal img').attr('src', $(this).attr('src'));
				$('#img-preview-modal').modal('show');
			});

			$('input[name=photo][type=file]').on('change', function () {
				self.readURL(this);
			});

			$('#form-add-photo').on('submit', function (e) {
				e.preventDefault();
				var formData = new FormData(this);
				$.ajax({
		        	url: "/admin/gallery",
					type: "POST",
					data:  formData,
					contentType: false,
		    	    cache: false,
					processData: false,
					success: function(response) {
						$(this).find("input").val('');
						$('#form-add-photo select').val(null).trigger('change');
						$('button.close').click();
						photoPage.dtTable.ajax.reload(null, false);
						swal({
							title: "Success!",
							text: "Photo has been uploaded!",
							icon: "success"
						});
						$('.photo-section').hide();
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

			$(document).on('click', '.edit', function () {
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/gallery/' + data_id)
				.done(function (response) {
					$('.photo-section').show();
					$('#form-edit-photo .img-preview').attr('src',response.filename);
					$('#select2-event').append('<option value="' + response.calendar.id + '" selected="selected">' + response.calendar.title + '</option>');
					$('#select2-event').trigger('change');
					$('#edit-photo-modal').modal('show');
				});
			});

			$('#form-edit-photo').on('submit', function (e) {
				e.preventDefault();
				var formData = new FormData(this);
				formData.append('_method', 'PATCH');
				$.ajax({
		        	url: "/admin/gallery/" + data_id,
					type: "POST",
					data:  formData,
					contentType: false,
		    	    cache: false,
					processData: false,
					success: function(response) {
						$(this).find("input").val('');
						$('#form-edit-photo select').val(null).trigger('change');
						$('button.close').click();
						swal({
							title: "Success!",
							text: "Photo has been edited!",
							icon: "success"
						});
						$('.photo-section').hide();
						photoPage.dtTable.ajax.reload(null, false);
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

			$(document).on('click', '.text-danger.delete', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this photo!",
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
								swal({
									title: "Success!",
									text: "Poof! Your photo has been set as a thumbnail!",
									icon: "success"
								});
						    }
						});
				  	}
				});
			});

			$(document).on('click', '.set-thumbnail', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "This photo will be set as the event's thumbnail!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: false,
				})
				.then((setThumbnail) => {
				  	if (setThumbnail) {
						$.ajax({
						    url: '/admin/gallery/setThumbnail/' + data_id,
						    type: 'PUT',
						    success: function(response) {
								swal({
									title: "Success!",
									text: "Poof! Your photo has been deleted!",
									icon: "success"
								});
								photoPage.dtTable.ajax.reload(null, false);
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
		readURL: function (input) {
			if (input.files && input.files[0]) {
				if(input.files[0].type == 'image/jpeg' || input.files[0].type == 'image/png' || input.files[0].type == 'image/gif') {
					$(input).parent().parent().find('small.text-danger').addClass('d-none');
					var reader = new FileReader();
					reader.onload = function(e) {
						$('.img-preview').attr('src', e.target.result);
						$('.photo-section').slideDown(1000);
					}
					reader.readAsDataURL(input.files[0]);
				} else {
					$('.photo-section').hide(1000);
					$(input).parent().parent().find('small.text-danger').removeClass('d-none');
					$('input[name=photo][type=file]').val('');
				}
			}
		},
		initDatatable: function () {
			$table = $page.find('#photo-datatable');
			photoPage.dtTable = $table.DataTable({
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
						d.search = 'photo';
					}
	            },
		        "columns": [
		            { data: 'event_name', name: 'event_name' },
		            { data: 'filename', name: 'filename' },
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
		photoPage.init();
	}
});
