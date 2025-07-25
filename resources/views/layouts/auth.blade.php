<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('images/JOSPA.webp') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/JOSPA.webp') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="setting_options" content="{{ setting('customization_json') }}">

    <title>{{ $title }} - {{ app_name() }}</title>
    <!-- Styles -->
    @stack('before-styles')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/hope-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customizer.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    @stack('after-styles')

    <!-- Analytics -->
    <x-google-analytics config="{{ setting('google_analytics') }}" />

    <style>
      {!! setting('custom_css_block') !!}
    </style>
        <style>
        :root{
          <?php
            $rootColors = setting('root_colors'); // Assuming the setting() function retrieves the JSON string

            // Check if the JSON string is not empty and can be decoded
            if (!empty($rootColors) && is_string($rootColors)) {
                $colors = json_decode($rootColors, true);

                // Check if decoding was successful and the colors array is not empty
                if (json_last_error() === JSON_ERROR_NONE && is_array($colors) && count($colors) > 0) {
                    foreach ($colors as $key => $value) {
                        echo $key . ': ' . $value . '; ';
                    }
                } else {
                    echo 'Invalid JSON or empty colors array.';
                }
            }
            ?>

        }
        
        :root {
            --primary-color: #bf9456 !important;
            --primary: #bf9456 !important;
        }

        .btn-primary {
            background-color: #bf9456 !important;
            border-color: #bf9456 !important; 
        }
        
        .btn-primary:hover {
            background-color: #a8834b !important;
            border-color: #a8834b !important;
        }
        
        a {
            color: #bf9456 !important;
        }
        
        a:hover {
            color: #a8834b !important;
        }
        
        .text-primary {
            color: #bf9456 !important;
        }
        
        .border-primary {
            border-color: #bf9456 !important;
        }
        
        .bg-primary {
            background-color: #bf9456 !important;
        }
        
        .icon-primary {
            color: #bf9456 !important;
        }
        
        input:focus,
        textarea:focus,
        select:focus {
            border-color: #bf9456 !important;
            box-shadow: 0 0 0 0.2rem rgba(191, 148, 86, 0.25) !important;
            outline: none !important;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #bf9456 !important;
            box-shadow: 0 0 0 0.2rem rgba(191, 148, 86, 0.25) !important;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: #bf9456 !important;
            box-shadow: 0 0 0 0.2rem rgba(191, 148, 86, 0.25) !important;
        }
    </style>
</head>

<body>
    <!-- Lo    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
ader Start -->
    <div id="loading">
        <x-partials._body_loader />
    </div>
    <!-- Loader End -->
    <div>
        {{ $slot }}
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/backend.js') }}"></script>

    <script>
      {!! setting('custom_js_block') !!}
    </script>
</body>

</html>
       @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif