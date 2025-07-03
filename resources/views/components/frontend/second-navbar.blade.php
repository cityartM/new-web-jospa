<div class="position-absolute top-0 start-0 w-100" style="z-index: 6; margin-top: 5rem;">
    <nav class="navbar navbar-expand-lg bg-transparent py-3 d-none d-lg-flex">
        <div class="container"  style="padding: 0 5rem ">
            <a class="navbar-brand" href="{{ route('frontend.home') }}">
                <!-- Replace with your logo -->
                <img src="{{ asset('images/frontend/logo.webp') }}" alt="Logo" style="height: 40px;">
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center gap-4">
                <li class="nav-item h5"><a class="nav-link text-white {{ request()->routeIs('frontend.home') ? 'text-active' : '' }}" href="{{ route('frontend.home') }}">Home</a></li>
                <li class="nav-item h5"><a class="nav-link text-white {{ request()->routeIs('frontend.about') ? 'text-active' : '' }}" href="{{ route('frontend.about') }}">About Us</a></li>
                <li class="nav-item h5"><a class="nav-link text-white {{ request()->routeIs('frontend.services') ? 'text-active' : '' }}" href="{{ route('frontend.services') }}">Services</a></li>
                {{-- <li class="nav-item h5"><a class="nav-link text-white {{ request()->routeIs('frontend.ads') ? 'text-active' : '' }}" href="#">Ads</a></li> --}}
                <li class="nav-item h5"><a class="nav-link text-white {{ request()->routeIs('frontend.contact') ? 'text-active' : '' }}" href="{{ route('frontend.contact') }}">Contact Us</a></li>
                <li class="nav-item h5"><a class="nav-link text-white fw-bold {{ request()->routeIs('frontend.ae') ? 'text-active' : '' }}" href="#">Ae</a></li>
            </ul>
        </div>
    </nav>
</div>
<!-- Mobile Bottom Nav -->
<nav class="d-lg-none d-block position-fixed w-100 bg-black border-top border-primary"
    style="z-index: 6; bottom: 0;">
    <div class="container px-0">
        <div class="d-flex justify-content-between align-items-center text-center">
            <a href="#"
                class="flex-fill py-2 text-white {{ ($active ?? '') === 'home' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 2 7.5V14a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-2h2v2a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7.5a.5.5 0 0 0-.146-.354l-6-6z" />
                    </svg></div>
                <small>Home</small>
            </a>
            <a href="#"
                class="flex-fill py-2 text-white {{ ($active ?? '') === 'about' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4-3a4 4 0 1 1-8 0 4 4 0 0 1 8 0z" />
                        <path d="M14 14s-1-1.5-6-1.5S2 14 2 14V15h12v-1z" />
                    </svg></div>
                <small>About</small>
            </a>
            <a href="#"
                class="flex-fill py-2 text-white {{ ($active ?? '') === 'services' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg></div>
                <small>Services</small>
            </a>
            <a href="#"
                class="flex-fill py-2 text-white {{ ($active ?? '') === 'ads' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2h12v12H2z" />
                    </svg></div>
                <small>Ads</small>
            </a>
            <a href="#"
                class="flex-fill py-2 text-white {{ ($active ?? '') === 'contact' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 2h12v12H2z" />
                    </svg></div>
                <small>Contact</small>
            </a>
            <a href="#"
                class="flex-fill py-2 text-white fw-bold {{ ($active ?? '') === 'ae' ? 'bg-primary text-white rounded-3' : '' }}">
                <div><svg width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><text x="4" y="14"
                            font-size="10">Ae</text></svg></div>
                <small>Ae</small>
            </a>
        </div>
    </div>
</nav>
