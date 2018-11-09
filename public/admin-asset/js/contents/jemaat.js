$(document).ready(function() {
    var $page = $('#jemaat-page');

    var jemaatPage = {
        init: function() {
            $('.add-jemaat-marriage').on('change', function () {
                if($(this).val() == 'yes') {
                    $('#add-jemaat-couple').show(500);
                } else {
                    $('#add-jemaat-couple').hide(500);
                    $('#add-jemaat-couple .select2-couple').val(null).trigger('change');
                }
            });

            $('.edit-jemaat-marriage').on('change', function () {
                if($(this).val() == 'yes') {
                    $('#edit-jemaat-couple').show(500);
                } else {
                    $('#edit-jemaat-couple').hide(500);
                    $('#edit-jemaat-couple .select2-couple').val(null).trigger('change');
                }
            });

            $("select").select2({
                placeholder: 'type name',
                allowClear: true,
                ajax: {
                    url: '/admin/ajax/jemaat',
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

            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
                $('#input-filename').text(label);
            });
        }
    };

    if ($page.length) {
        jemaatPage.init();
    }
});
