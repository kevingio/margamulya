$('.page-item.disabled').remove();
$('a.page-link[rel="next"]').text('Next');
$('a.page-link[rel="prev"]').text('Previous');

$(document).ready(function () {
    $('.tab-list-direktori .tab-item').on('click', function () {
        $('.tab-list-direktori .tab-item').removeClass('active');
        $(this).addClass('active');
        $('.tab-direktori .tab-pane').hide();
        $($('a', this).attr('data-target')).fadeIn(1000);
    });

    $('.load_more_button').on('click', function () {
        window.location.href = "/article";
    });

    $('.post_body img').removeAttr('style');

    $('button[data-toggle=collapse]').on('click', function () {
        $('html, body').animate({
                    scrollTop: $(this).closest(".accordion").offset().top - 100
                }, 1000);
    });

    $('#form-contact').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serializeArray();
        $(this).find('input, textarea').val('');
        $('.contact-us').hide();
        $('.loading').show();
        $.post('/contact-form/send', data)
        .done(function (response) {
            swal({
                title: "Thank You!",
                text: "Your message has been sent!",
                icon: "success"
            });
            $('.contact-us').show();
            $('.loading').hide();
        });
    });
});
