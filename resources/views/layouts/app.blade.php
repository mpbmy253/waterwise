<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> - Water Wise - </title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        xxrel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/style.css') }}" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="header-white sidebar-light">
    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
        </div>
    </div>
    @include('layouts.sidebar')
    <div class="main-container" style="overflow-y: auto;">
        @yield('content')
    </div>
    <!-- JS -->
    <script src="{{ url('vendors/scripts/core.js') }}"></script>
    <script src="{{ url('vendors/scripts/script.min.js') }}"></script>
    @yield('script')
</body>

</html>
