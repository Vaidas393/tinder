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


  <!-- Content -->
  @yield('content')

  <!-- JavaScript Files -->
  <!-- Load jQuery FIRST (some plugins depend on it) -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/swiper.min.js') }}"></script>
  <script src="{{ asset('js/nice-select.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
