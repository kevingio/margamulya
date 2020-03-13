/*=========================================================================================
    File Name: jemaat-datatable
    Description: Jemaat Datatable
==========================================================================================*/
$(document).ready(function () {
    var $page = $('#contributor-page'),
        $table = {};

    var contributorPage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            $('select').select2({ width: '100%' });
            $('#container-datatable_wrapper').removeClass('container-fluid');
            $('table.table').css('width', '100%');

            $('#form-add-contributor').on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serializeArray();
                $(this).find("input, textarea").val('');
                $.post('/admin/kontributor', data)
                    .done(function (response) {
                        if (response.status == 200) {
                            $('button.close').click();
                            $('#form-add-contributor .select2').val(1).trigger('change');
                            contributorPage.dtTable.ajax.reload(null, false);
                            swal({
                                title: "Success!",
                                text: "Data has been added!",
                                icon: "success"
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: `${response.message}!`,
                                icon: "error"
                            });
                        }
                    });
            });

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
                                url: '/admin/kontributor/' + data_id,
                                type: 'DELETE',
                                success: function (response) {
                                    contributorPage.dtTable.ajax.reload(null, false);
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
                data_id = $(this).parent().parent().find('.datatable-action').attr('data');
                $.get('/admin/kontributor/' + data_id)
                    .done(function (response) {
                        $('#form-edit-contributor input[name=name]').val(response.name);
                        $('#form-edit-contributor input[name=username]').val(response.username);
                        $('#form-edit-contributor select[name=contributor_type_id]').val(response.contributor_type_id).trigger('change');
                        $('#edit-contributor-modal').modal('show');
                    });
            });

            $('#form-edit-contributor').on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serializeArray();
                $.ajax({
                    url: '/admin/kontributor/' + data_id,
                    data: data,
                    type: 'PUT',
                    success: function (response) {
                        if (response.status == 200) {
                            $(this).find("input, textarea").val('');
                            $('button.close').click();
                            $('#form-edit-contributor .select2').val(1).trigger('change');
                            contributorPage.dtTable.ajax.reload(null, false);
                            swal({
                                title: "Success!",
                                text: "Data has been edited!",
                                icon: "success"
                            });
                        } else {
                            swal({
                                title: "Error!",
                                text: `${response.message}!`,
                                icon: "error"
                            });
                        }
                    }
                });
            });
        },
        initDatatable: function () {
            $.extend($.fn.dataTableExt.oSort, {
                "non-empty-string-asc": function (str1, str2) {
                    if (str1 == "")
                        return 1;
                    if (str2 == "")
                        return -1;
                    return ((str1 < str2) ? -1 : ((str1 > str2) ? 1 : 0));
                },

                "non-empty-string-desc": function (str1, str2) {
                    if (str1 == "")
                        return 1;
                    if (str2 == "")
                        return -1;
                    return ((str1 < str2) ? 1 : ((str1 > str2) ? -1 : 0));
                }
            });

            $table = $page.find('#contributor-datatable');
            contributorPage.dtTable = $table.DataTable({
                "aaSorting": [],
                "processing": true,
                "serverSide": true,
                "searching": true,
                "lengthChange": false,
                "ajax": {
                    url: "/admin/ajax/contributor",
                    type: "POST",
                    data: function (d) { d.mode = 'datatable'; }
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'username', name: 'username' },
                    { data: 'contributor_type', name: 'contributor_type' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false },
                    { targets: 'no-search', searchable: false },
                    { targets: 'text-center', className: 'text-center' },
                    { targets: ['couple', 'anniversary'], type: 'non-empty-string' }
                ],
            });
        },
    };

    if ($page.length) {
        contributorPage.init();
    }
});
