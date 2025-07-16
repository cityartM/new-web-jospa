@php
    $dir = app()->getLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">
<head>
<link rel="stylesheet" href="https://jospa.tayasmart.com/css/libs.min.css">
<link rel="stylesheet" href="https://jospa.tayasmart.com/css/backend.css">
<link rel="stylesheet" href="https://jospa.tayasmart.com/custom-css/frontend.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        }
        a svg{
            color:white;
        }
        .h5{
            font-size:15.6px;
        }
    </style>
</head>
<body>
        <img src="https://jospa.tayasmart.com/images/frontend/slider1.webp" alt="Services Hero" class="w-100" style="object-fit: cover;height:263.4px">
        @include('components.frontend.navbar')
        @include('components.frontend.second-navbar')
    </div>
    <div style="height: 100vh;">
        
    </div>
    @include('components.frontend.footer')
</body>
</html>
