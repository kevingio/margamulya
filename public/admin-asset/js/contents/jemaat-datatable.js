/*=========================================================================================
    File Name: jemaat-datatable
    Description: Jemaat Datatable
==========================================================================================*/
$(document).ready(function () {
	var $page = $('#jemaat-page'),
		$table = {};

	var jemaatPage = {
		dtTable: {},
		init: function () {
			this.initDatatable();
            $('#jemaat-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

            $('#form-add-jemaat').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.post('/admin/jemaat', data)
				.done(function (response) {
					$(this).find("input, textarea").val('');
					$('button.close').click();
					jemaatPage.dtTable.ajax.reload(null, false);
					swal({
						title: "Success!",
						text: "Data has been added!",
						icon: "success"
					});
				});
			});

			function isMarriage() {
				if($('.edit-jemaat-marriage').val() == 'yes') {
					$('#edit-jemaat-couple').show(500);
				} else {
					$('#edit-jemaat-couple').hide(500);
					$('#edit-jemaat-couple .select2-couple').val(null).trigger('change');
				}
			}

			$(document).on('click', '.text-danger.delete', function () {
				var data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				swal({
				  	title: "Are you sure?",
				  	text: "Once deleted, you will not be able to recover this record!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
						$.ajax({
						    url: '/admin/jemaat/' + data_id,
						    type: 'DELETE',
						    success: function(response) {
								jemaatPage.dtTable.ajax.reload(null, false);
								swal({
									title: "Success!",
									text: "Poof! Your record has been deleted!",
									icon: "success"
								});
						    }
						});
				  	}
				});
			});
			var data_id = '';
			$(document).on('click', '.edit', function () {
				$('#edit-jemaat-couple').find("input, textarea").val('');
				$('#edit-jemaat-couple .select2-couple').val(null).trigger('change');
				data_id = $(this).parent().parent().find('.datatable-action').attr('data');
				$.get('/admin/jemaat/' + data_id)
				.done(function (response) {
					$('#input-name').val(response.name);
					$('#input-dob').val(response.dob);
					$('#input-address').val(response.address);
					$('#form-edit-jemaat input[name=gender][value=' + response.gender + ']').prop('checked', true);
					if(response.anniversary != null) {
						$('#input-anniversary').val(response.anniversary);
					}
					if(response.couple_id != null) {
						$('#form-edit-jemaat input[name=marriage][value=yes]').prop('checked', true);
						$('#edit-jemaat-couple .select2-couple').append('<option value="' + response.couple_id + '" selected="selected">' + response.couple.name + ', ' + response.couple.sector + '</option>');
						$('#edit-jemaat-couple .select2-couple').trigger('change');
						isMarriage();
					}
					if(response.sector != null) {
						$('#input-sector').val(response.sector);
					}
					$('#edit-jemaat-modal').modal('show');
				});
			});

			$('#form-edit-jemaat').on('submit', function (e) {
				e.preventDefault();
				var data = $(this).serializeArray();
				$.ajax({
					url: '/admin/jemaat/' + data_id,
					data: data,
					type: 'PUT',
					success: function(response) {
						$(this).find("input, textarea").val('');
						$('button.close').click();
						swal({
							title: "Success!",
							text: "Data has been edited!",
							icon: "success"
						});
						jemaatPage.dtTable.ajax.reload(null, false);
					}
				});
			});
		},
		initDatatable: function () {
			$.extend($.fn.dataTableExt.oSort, {
			    "non-empty-string-asc": function (str1, str2) {
			        if(str1 == "")
			            return 1;
			        if(str2 == "")
			            return -1;
			        return ((str1 < str2) ? -1 : ((str1 > str2) ? 1 : 0));
			    },

			    "non-empty-string-desc": function (str1, str2) {
			        if(str1 == "")
			            return 1;
			        if(str2 == "")
			            return -1;
			        return ((str1 < str2) ? 1 : ((str1 > str2) ? -1 : 0));
			    }
			});

			$table = $page.find('#jemaat-datatable');
			jemaatPage.dtTable = $table.DataTable({
				"aaSorting": [],
		        "processing": true,
	            "serverSide": true,
	            "searching": true,
	            "lengthChange": false,
	            "ajax": {
	                url: "/admin/ajax/jemaat",
	                type: "POST",
	                data: function (d) { d.mode = 'datatable'; }
	            },
		        "columns": [
		            { data: 'name', name: 'name' },
		            { data: 'dob', name: 'dob' },
		            { data: 'aniversary', name: 'aniversary' },
		            { data: 'couple', name: 'couple' },
					{ data: 'sector', name: 'sector' },
		            { data: 'action', name: 'action' },
		        ],
		        "columnDefs": [
	                { targets: 'no-sort', orderable: false },
	                { targets: 'no-search', searchable: false },
					{ targets: 'text-center', className: 'text-center' },
					{ targets: ['couple', 'anniversary'], type: 'non-empty-string' }
	            ],
		    });
		}
	};

	if ($page.length) {
		jemaatPage.init();
	}
});
