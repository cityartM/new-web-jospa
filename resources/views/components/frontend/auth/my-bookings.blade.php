<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') | {{ app_name() }}</title>

    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    @if (language_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @stack('after-styles')
    <!-- Toastr CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">  
</head>
<body class="bg-white">
    <!-- Lightning Progress Bar -->
    @include('components.frontend.progress-bar')

    <!-- Hero Section (30% of screen) -->
    <div class="position-relative" style="height: 290.79px;">
        <img src="{{ asset('images/frontend/slider1.webp') }}" alt="Contact Hero" class="w-100 h-100" style="object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.35);"></div>

        <!-- First Navbar -->
        @include('components.frontend.navbar')

        <!-- Second Navbar -->
        @include('components.frontend.second-navbar')
    </div>
    
    <div class="container py-4 " style="min-height:100vh">
        <h2 class="mb-4 text-center">{{ __('profile.my_bookings') }}</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('profile.neighborhood') }}</th>
                        <th>{{ __('profile.branch') }}</th>
                        <th>{{ __('profile.service') }}</th>
                        <th>{{ __('profile.booking_date') }}</th>
                        <th>{{ __('profile.booking_time') }}</th>
                        <th>{{ __('profile.staff') }}</th>
                        <th>{{ __('profile.type') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->neighborhood }}</td>
                            <td>{{ $booking->branch ?? '---'}}</td>
                            <td>{{ $booking->service->name}}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->time }}</td>
                            <td>{{ $booking->staff->name }}</td>
                            <td>{{ $booking->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">{{ __('profile.no_bookings') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('components.frontend.footer')

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script>
      document.addEventListener("DOMContentLoaded", function () {
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
      });
  </script>
</body>
</html>
