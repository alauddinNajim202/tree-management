<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>TreeWorld - Premium Tree Shop</title>

@include('frontend.partials._styles')
</head>
<body class="cnt-home">

@include('frontend.partials._header')

@yield('content')

@include('frontend.partials._footer')

@include('frontend.partials._chat_widget')

@include('frontend.partials._scripts')
@auth
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('{{ config('reverb.apps.apps.0.key', env('REVERB_APP_KEY')) }}', {
        wsHost: '{{ str_replace('"', '', env('REVERB_HOST', 'localhost')) }}',
        wsPort: {{ env('REVERB_PORT', 8080) }},
        wssPort: {{ env('REVERB_PORT', 8080) }},
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws'],
        cluster: 'mt1',
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });

    // Wrap Pusher as Echo-compatible object
    window.Echo = {
        private: function(channel) {
            var ch = pusher.subscribe('private-' + channel);
            ch.bind_global(function(eventName, data) {
                console.log('[Reverb] Event received:', eventName, data);
            });
            return {
                listen: function(event, callback) {
                    // Try all possible event name formats Reverb may use
                    ch.bind('App\\Events\\' + event, callback);
                    ch.bind('\\App\\Events\\' + event, callback);
                    return this;
                }
            };
        }
    };
</script>
@endauth
</body>

</html>