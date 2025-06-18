<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="dark light">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  <!-- Livewire Styles (Auto-injected in Livewire 3) -->

  <!-- <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
  <link rel="manifest" href="{{ asset('manifest.json') }}"> -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <title>Dating</title>
</head>

<body>

    <!-- Preloader section -->
    <div id="preloader">
        <div class="img-container">
            <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="logo">
        </div>
    </div>

    <!-- Content slot for Livewire components -->
    {{ $slot }}

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/nice-select.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const conversationId = @json(request()->route('conversation')->id ?? null);
            if (!conversationId) return;
            const appKey = @json(config('broadcasting.connections.reverb.key'));
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: appKey,
                wsHost: window.location.hostname,
                wsPort: 6001,
                wssPort: 6001,
                forceTLS: false,
                disableStats: true,
                enabledTransports: ['ws', 'wss'],
            });
            window.Echo.private('chat.' + conversationId)
                .listen('MessageSent', (data) => {
                    console.log('MessageSent event received:', data);
                    window.Livewire.dispatch('message-received');
                });
        });
    </script>
    @endpush

</body>
</html>
