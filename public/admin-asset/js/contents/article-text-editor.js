$(document).ready(function() {
    var $page = $('#create-article-page');

    var create_article_page = {
        init: function() {
            let self = this;
            $('input[name=photo][type=file]').on('change', function () {
				self.readURL(this);
			});

			$(".summernote").summernote({
				height: 500,
				codemirror: {
					theme: "lumen"
				},
				toolbar: [
					[
						"font",
						[
							"bold",
							"italic",
							"underline",
						]
					],
					['color', ['color']],
					["para", ["ol", "ul", "paragraph"]],
					["insert", ["link", "picture"]]
				]
			});
        },
		readURL: function (input) {
			if (input.files && input.files[0]) {
				if(input.files[0].type == 'image/jpeg' || input.files[0].type == 'image/png' || input.files[0].type == 'image/gif') {
					$(input).parent().parent().find('small.text-danger').addClass('d-none');
					var reader = new FileReader();
					reader.onload = function(e) {
						$('.img-preview-post').attr('src', e.target.result);
						$('.preview-section').slideDown(1000);
					}
					reader.readAsDataURL(input.files[0]);
				} else {
					$('.preview-section').hide(1000);
                    $('.img-preview-post').attr('src', window.location.origin + '/app-asset/img/category.jpg');
					$(input).parent().parent().find('small.text-danger').removeClass('d-none');
					$('input[name=photo][type=file]').val('');
				}
			}
		}
    };

    if ($page.length) {
        create_article_page.init();
    }
})
