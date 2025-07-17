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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">  
    <style>
      body {
        background: #f7f7f7;
        font-family: 'IBM Plex Sans Arabic', sans-serif !important;
      }
      .profile-hero {
        background: linear-gradient(90deg, #fff 60%, #f7f7f7 100%);
        border-radius: 0 0 32px 32px;
        padding: 23px 0 32px 0;
        margin-bottom: 0;
        width: 100%;
        position: relative;
        z-index: 999;
      }
      .profile-avatar-lg {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #bc9a69;
        background: #eee;
        margin-bottom: 18px;
        margin-top: -116px;
      }
      .profile-balance-corner {
        position: absolute;
        top: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 10;
      }
      .balance-box {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px #bc9a6920;
        padding: 10px 22px 10px 18px;
        display: flex;
        align-items: center;
        font-size: 1.13rem;
        font-weight: bold;
        color: #2e7d32;
        border: 1.5px solid #bc9a69;
      }
      .charge-btn-icon {
        background: #bc9a69;
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        box-shadow: 0 2px 8px #bc9a6920;
        margin-right: 2px;
      }
      .charge-btn-icon:hover {
        background: #a8834b;
      }
      .charge-btn-icon svg {
        color: #fff;
        width: 26px;
        height: 26px;
      }
      .profile-info-wide {
        margin: 0 auto;
        margin-top: 40px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px #0001;
        padding: 32px 32px 18px 32px;
        max-width: 1100px;
        width: 100%;
      }
      .profile-info-wide h4 {
        color: #bc9a69;
        font-weight: bold;
        margin-bottom: 24px;
      }
      .profile-info-wide .row {
        row-gap: 18px;
      }
      .profile-info-wide .info-label {
        color: #888;
        font-size: 1.08rem;
        margin-bottom: 4px;
      }
      .profile-info-wide .info-value {
        font-weight: bold;
        font-size: 1.15rem;
        color: #222;
      }
      @media (max-width: 991.98px) {
        .profile-info-wide {
          padding: 10px 2px;
          max-width: 100%;
          border-radius: 12px;
        }
        .profile-hero {
          padding: 18px 0 8px 0;
          border-radius: 0 0 18px 18px;
        }
        .profile-avatar-lg {
          width: 90px;
          height: 90px;
          margin-top: -60px;
          border-width: 3px;
        }
        .profile-balance-corner {
          top: 8px;
          right: 4px;
          left: auto;
          gap: 6px;
        }
        .balance-box {
          font-size: 1rem;
          padding: 7px 12px 7px 10px;
          border-radius: 12px;
        }
        .charge-btn-icon {
          width: 34px;
          height: 34px;
        }
        .profile-info-wide h4 {
          font-size: 1.1rem;
          margin-bottom: 12px;
        }
        .profile-info-wide .info-label, .profile-info-wide .info-value {
          font-size: 0.98rem;
        }
      }
      @media (max-width: 600px) {
        .profile-info-wide {
          padding: 4px 0.5vw;
          border-radius: 8px;
        }
        .profile-hero {
          padding: 10px 0 4px 0;
          border-radius: 0 0 8px 8px;
        }
        .profile-avatar-lg {
          width: 70px;
          height: 71px;
          margin-top: -56px;
          border-width: 2px;
        }
        .profile-balance-corner {
          top: 2px;
          right: 2px;
          left: auto;
          gap: 3px;
        }
        .balance-box {
          font-size: 0.9rem;
          padding: 4px 7px 4px 6px;
          border-radius: 8px;
        }
        .charge-btn-icon {
          width: 26px;
          height: 26px;
        }
        .profile-info-wide h4 {
          font-size: 1rem;
          margin-bottom: 8px;
        }
        .profile-info-wide .info-label, .profile-info-wide .info-value {
          font-size: 0.89rem;
        }
      }
      a svg{
              color:white;
          }
          .h5{
              font-size:15.6px;
          }
      .charge-modal-content {
        border-radius: 24px;
        box-shadow: 0 8px 40px #bc9a6940;
        padding: 0 8px 18px 8px;
        background: #fff;
      }
      .charge-modal-icon {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -38px;
        margin-bottom: 8px;
      }
      .charge-modal-title {
        font-size: 1.55rem;
        font-weight: bold;
        color: #d4af37;
        margin-bottom: 0;
        letter-spacing: 0.5px;
      }
      .charge-modal-label {
        font-size: 1.08rem;
        color: #bc9a69;
        font-weight: 500;
        margin-bottom: 6px;
      }
      .charge-modal-input-group {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 10px #bc9a6920;
        background: #fff8e1;
      }
      .charge-modal-input-icon {
        background: #fff8e1;
        border: none;
        color: #d4af37;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
      }
      .charge-modal-input-icon svg {
        width: 26px;
        height: 26px;
        color: #d4af37;
      }
      .charge-modal-input {
        border: none;
        background: transparent;
        font-size: 1.18rem;
        font-weight: bold;
        color: #222;
        box-shadow: none;
      }
      .charge-modal-input:focus {
        outline: none;
        box-shadow: none;
        background: #fff;
      }
      .charge-modal-btn {
        background: linear-gradient(90deg, #d4af37 0%, #bc9a69 100%);
        color: #fff;
        font-size: 1.18rem;
        font-weight: bold;
        border-radius: 16px;
        padding: 14px 0;
        box-shadow: 0 2px 12px #bc9a6920;
        border: none;
        transition: background 0.2s, transform 0.2s;
      }
      .charge-modal-btn:hover {
        background: linear-gradient(90deg, #bc9a69 0%, #d4af37 100%);
        transform: translateY(-2px) scale(1.03);
      }
      .modal-backdrop {
        z-index: 1050 !important;
      }

      .modal {
        z-index: 1060 !important;
      }

      .profile-info-wide,
      .profile-hero {
        z-index: auto !important;
      }
    </style>
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
    <!-- Hero Section -->
    <div class="profile-hero text-center">
      <div class="profile-hero text-center position-relative">
        <!-- رصيد المستخدم في الزاوية -->
        <div class="profile-balance-corner"
             style="{{ app()->getLocale() == 'ar' ? 'right:48px;' : 'left:48px;' }}">
          <div class="balance-box">
            {{ number_format($balance, 2) }}
            <span class="text-muted ms-1" style="font-size: 0.98rem;">{{ __('profile.riyal') }}</span>
          </div>
          <button type="button" class="charge-btn-icon" data-bs-toggle="modal" data-bs-target="#chargeModal" title="{{ __('profile.charge_my_balance') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
          </button>
        </div>
      <img src="{{ $user->profile_image ?? asset('images/default-avatar.png') }}" alt="avatar" class="profile-avatar-lg">
      <h2 class="fw-bold mt-2 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h2>
      <div class="text-muted mb-2">{{ $user->email }}</div>
      
    <!-- معلومات المستخدم -->
    <div class="profile-info-wide mt-0 mb-5">
      <h4 class="mb-4">{{ __('profile.personal_info') }}</h4>
      <div class="row">
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.mobile_number') }}</div>
          <div class="info-value">{{ $user->mobile }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.registration_date') }}</div>
          <div class="info-value">{{ $user->created_at->format('Y-m-d') }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.last_login') }}</div>
          <div class="info-value">{{ $user->last_login_at ?? __('profile.no_data') }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.address') }}</div>
          <div class="info-value">{{ $user->address->address_line_1 ?? __('profile.no_data') }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.city') }}</div>
          <div class="info-value">{{ $user->address->city ?? __('profile.no_data') }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.country') }}</div>
          <div class="info-value">{{ $user->address->country ?? __('profile.no_data') }}</div>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <div class="info-label">{{ __('profile.national_id') }}</div>
          <div class="info-value">{{ $user->national_id ?? __('profile.no_data') }}</div>
        </div>
      </div>
    </div>
    </div>
    <!-- Modal شحن الرصيد -->
    <div class="modal fade" id="chargeModal" tabindex="-1" aria-labelledby="chargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content charge-modal-content">
          <div class="modal-header flex-column align-items-center border-0 pb-0">
            <div class="charge-modal-icon mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke="currentColor"><circle cx="16" cy="16" r="16" fill="#fff8e1"/><path stroke="#d4af37" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M16 8v16m8-8H8"/></svg>
            </div>
            <h5 class="modal-title w-100 text-center charge-modal-title" id="chargeModalLabel">{{ __('profile.charge_my_balance') }}</h5>
            <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="{{ __('profile.close') }}"></button>
          </div>
          {{-- <form method="POST" action="#"> --}}
            {{-- @csrf --}}
            <div class="modal-body pt-0">
              <label for="amount" class="form-label charge-modal-label">{{ __('profile.amount') }}</label>
              <div class="input-group charge-modal-input-group mb-3">
                <span class="input-group-text charge-modal-input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 16v-4" /></svg>
                </span>
                <input type="number" min="1" class="form-control charge-modal-input" id="amount" name="amount" required placeholder="{{ __('profile.amount') }}">
              </div>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex justify-content-center">
              <button  class="btn charge-modal-btn w-100">{{ __('profile.charge') }}</button>
            </div>
          {{-- </form> --}}
        </div>
      </div>
    </div>
    <!-- Footer -->
    @include('components.frontend.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
