@if (session()->has('sweet_alert.alert'))
    <script>
        @if (session()->has('sweet_alert.content'))
            var config = {!! session()->pull('sweet_alert.alert') !!}
            var content = document.createElement('div');
            content.insertAdjacentHTML('afterbegin', config.content);
            config.content = content;
            swal(config);
        @else
            swal({!! session()->pull('sweet_alert.alert') !!});
        @endif
    </script>
@endif
