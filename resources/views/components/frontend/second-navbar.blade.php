<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Desktop Navbar --> 
<style>
    body{
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;

    }
</style>
<div class="position-absolute top-0 start-0 w-100" style="z-index: 6; margin-top: 65px;font-family: 'IBM Plex Sans Arabic', sans-serif !important">
    <nav class="navbar navbar-expand-lg bg-transparent py-3 d-none d-lg-flex"
        style=" margin-top: 43px;padding-right: 45px;font-family: 'IBM Plex Sans Arabic', sans-serif !important">

        <div class="container" style="padding: 0 20px">
            <div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center gap-4" style="margin-right: 22px;">
  
                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('frontend.home') ? 'text-active' : '' }}"
                       href="{{ route('frontend.home') }}">    
                        {{ __('messagess.nav_home') }} 
                    </a>
                </li>

                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('frontend.about') ? 'text-active' : '' }}"
                       href="{{ route('frontend.about') }}">
                        {{ __('messagess.nav_about') }}
                    </a>
                </li>

                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('frontend.services') ? 'text-active' : '' }}"
                       href="{{ route('frontend.services') }}">
                        {{ __('messagess.nav_services') }}
                    </a>
                </li>

                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('frontend.contact') ? 'text-active' : '' }}"
                       href="{{ route('frontend.contact') }}">
                        {{ __('messagess.nav_contact') }}
                    </a>
                </li>
                
                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('ads.page') ? 'text-active' : '' }}"
                       href="{{ route('ads.page') }}">
                        {{ __('messagess.nav_ads') }}
                    </a>
                </li>
                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('cart.page') ? 'text-active' : '' }}"
                       href="{{ route('cart.page') }}">
                        {{ __('messagess.nav_cart') }}
                    </a>
                </li>


                <li class="nav-item h5">
                    <a class="nav-link text-white {{ request()->routeIs('profile') ? 'text-active' : '' }}"
                       href="{{ route('profile') }}">
                       {{ __('messagess.profile') }}
                    </a>
                </li>
                
                  <li class="nav-item h5">
                    @php
                        $currentLocale = session('locale', app()->getLocale());
                        $targetLocale = $currentLocale === 'ar' ? 'en' : 'ar';
                        $translationKey = $targetLocale === 'ar' ? 'messagess.nav_lang_ar' : 'messagess.nav_lang_en';
                    @endphp

                    <form id="change-lang-form" action="{{ route('change.lang', $targetLocale) }}" method="GET" style="display: none;"></form>

                    <button type="button"
                            onclick="document.getElementById('change-lang-form').submit();"
                            class="nav-link text-white fw-bold border-0 bg-transparent {{ $currentLocale == 'ar' ? 'text-active' : '' }}">
                        {{ __($translationKey) }}
                    </button>
                </li>


            </ul>
            </div>
            
                        <a class="navbar-brand" href="{{ route('frontend.home') }}">
                <img src="{{ asset('images/frontend/logo.webp') }}" alt="Logo" style="height: 50px;width: 160px;margin-right: 80px;margin-top: -16px;">
            </a>
        </div>
    </nav>
</div>

<!-- Mobile Bottom Nav -->
<nav class="d-lg-none d-block position-fixed w-100 bg-black border-top border-primary" style="z-index: 6; bottom: 0;">
    <div class="container px-0">
        <div class="d-flex justify-content-between align-items-center text-center">
            <a href="{{ route('frontend.home') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'home' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3a1 1 0 001-1v-4h2v4a1 1 0 001 1h3a1 1 0 001-1V10" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_home') }}</small>
            </a>
            <a href="{{ route('frontend.about') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'about' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="2" fill="none"/>
                        <path d="M12 16v-4" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="8" r="1" fill="#fff"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_about') }}</small>
            </a>
            <a href="{{ route('frontend.services') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'services' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="7" width="18" height="13" rx="2" stroke="#fff" stroke-width="2" fill="none"/>
                        <path d="M16 3v4M8 3v4" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_services') }}</small>
            </a>
            <a href="{{ route('frontend.contact') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'contact' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 10.5V6a2 2 0 00-2-2H5a2 2 0 00-2 2v4.5M21 10.5l-9 6.5-9-6.5M21 10.5V18a2 2 0 01-2 2H5a2 2 0 01-2-2v-7.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_contact') }}</small>
            </a>
            <a href="{{ route('ads.page') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'ads' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="#fff" stroke-width="2" fill="none"/>
                        <path d="M7 9h10M7 15h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_ads') }}</small>
            </a>
            <a href="{{ route('cart.page') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'cart' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1" fill="#fff"/>
                        <circle cx="20" cy="21" r="1" fill="#fff"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </div>
                <small>{{ __('messagess.nav_cart') }}</small>
            </a>
            <a href="{{ route('profile') }}"
               class="flex-fill py-2 text-white {{ ($active ?? '') === 'profile' ? 'bg-primary text-white rounded-3' : '' }}">
                <div>
                    <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" stroke="#fff" stroke-width="2" fill="none"/>
                        <path d="M2 20c0-4 8-6 10-6s10 2 10 6" stroke="#fff" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <small>{{ __('messagess.profile') }}</small>
            </a>
        </div>
    </div>
</nav>
