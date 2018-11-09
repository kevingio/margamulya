$(document).ready(function () {
    $('.search-box').autocomplete({
        showNoSuggestionNotice: true,
        lookup: function (query, done) {
            $.post('/search/autocomplete',{ q: query })
            .done(function (response) {
                done(response);
            });
        },
        onSelect: function (suggestion) {
            var target_url = window.location.origin + '/' + suggestion.data;
            window.location.href = target_url;
        }
    });
});
