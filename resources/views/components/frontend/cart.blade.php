    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('after-styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    .cart-table th, .cart-table td { text-align: center; vertical-align: middle; }
    .cart-empty { color: #888; font-size: 1.3rem; margin: 3rem 0; text-align: center; }
    .cart-actions { display: flex; gap: 1rem; justify-content: center; }
    .btn-danger { background: #dc3545; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 8px; }
    .btn-primary { background: var(--primary-color); color: #fff; border: none; padding: 0.5rem 1.5rem; border-radius: 8px; }
    .btn-danger:hover, .btn-primary:hover { opacity: 0.85; }
    .show-services-btn {
        position: relative;
        overflow: hidden;
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 0.6rem 2.2rem 0.6rem 1.2rem;
        font-size: 1rem;
        font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        cursor: pointer;
        transition: background 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 14px rgba(0,123,255,0.15);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .show-services-btn .btn-icon {
        display: inline-block;
        transform: translateX(0);
        transition: transform 0.3s cubic-bezier(.4,2.3,.3,1);
    }
    .show-services-btn:hover {
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        box-shadow: 0 6px 20px rgba(0,123,255,0.25);
    }
    .show-services-btn:hover .btn-icon {
        transform: translateX(-8px) scale(1.2) rotate(-10deg);
    }
    .show-services-btn .btn-text {
        font-weight: bold;
        letter-spacing: 1px;
    }
    .cart-cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }
    .cart-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        min-width: 320px;
        max-width: 350px;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-bottom: 1.5rem;
        border: 1px solid #f1f1f1;
    }
    .cart-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(0,123,255,0.13);
    }
    .cart-card .customer-name {
        font-size: 1.3rem;
        font-weight: bold;
        color: var(--primary-color, #bc9a69);
        margin-bottom: 0.5rem;
    }
    .cart-card .mobile {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 1.2rem;
    }
    .cart-card .to {
        white-space: normal;
        padding-top: 10px;
        border-left: 2px solid gray;
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 1.2rem;
    }
    .cart-card .show-services-btn {
        width: 100%;
        justify-content: center;
        font-size: 1.1rem;
        padding: 0.7rem 0;
        border-radius: 25px;
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        color: #fff;
        border: none;
        font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 2px 10px rgba(0,123,255,0.10);
        transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .cart-card .show-services-btn .btn-icon {
        transition: transform 0.3s cubic-bezier(.4,2.3,.3,1);
    }
    .cart-card .show-services-btn:hover {
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        box-shadow: 0 6px 20px rgba(0,123,255,0.18);
        transform: scale(1.04);
    }
    .cart-card .show-services-btn:hover .btn-icon {
        transform: translateX(-8px) scale(1.2) rotate(-10deg);
    }
    .modal-backdrop {
        position: fixed;
        top:0; left:0; right:0; bottom:0;
        background: rgba(0,0,0,0.25);
        z-index: 1040;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .custom-modal {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px #bc9a69;
        padding: 2rem 2.5rem;
        width: 30%;
        position: relative;
        z-index: 1050;
        animation: modalIn 0.4s cubic-bezier(.4,2.3,.3,1);
    }
    @keyframes modalIn {
        from { transform: scale(0.8) translateY(40px); opacity: 0; }
        to { transform: scale(1) translateY(0); opacity: 1; }
    }
    .custom-modal .close-modal {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #bc9a69;
        cursor: pointer;
        transition: color 0.2s;
    }
    .custom-modal .close-modal:hover {
        color: #dc3545;
    }
    @keyframes fadeInUp { from { opacity:0; transform:translate3d(0,40px,0);} to { opacity:1; transform:none; } }
    .animate__animated.animate__fadeInUp { animation: fadeInUp 0.7s; }
    @keyframes zoomIn { from { opacity:0; transform:scale(0.7);} to { opacity:1; transform:scale(1);} }
    .animate__animated.animate__zoomIn { animation: zoomIn 0.4s;margin-top: 128px; }

    .cart-cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }
    .cart-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        min-width: 320px;
        max-width: 350px;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
        margin-bottom: 1.5rem;
        border: 1px solid #f1f1f1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .cart-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px #bc9a694d;
    }
    .avatar-circle {
        width: 60px;
        height: 60px;
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0,123,255,0.10);
        border: 3px solid #fff;
    }
    .customer-info {
        text-align: center;
        margin-bottom: 1.2rem;
    }
    .customer-name {
        font-size: 1.3rem;
        font-weight: bold;
        color: var(--primary-color, #bc9a69);
        margin-bottom: 0.3rem;
    }
    .mobile {
        font-size: 1.1rem;
        color: #444;
    }
    .fancy-btn {
        width: 100%;
        justify-content: center;
        font-size: 1.1rem;
        padding: 0.7rem 0;
        border-radius: 25px;
        background: linear-gradient(90deg, #bc9a69 0%, #00c6ff 100%);
        color: #fff;
        border: none;
        font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 2px 10px rgba(0,123,255,0.10);
        transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .fancy-btn .btn-icon {
        transition: transform 0.3s cubic-bezier(.4,2.3,.3,1);
    }
    .fancy-btn:hover {
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        box-shadow: 0 6px 20px rgba(0,123,255,0.18);
        transform: scale(1.04);
    }
    .fancy-btn:hover .btn-icon {
        transform: translateX(-8px) scale(1.2) rotate(-10deg);
    }
    .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3); /* ظل خلفي */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1040;
    }
    .custom-modal {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
    padding: 2rem 2.5rem;
    width: 30%;
    position: relative;
    z-index: 1050;
    animation: modalIn 0.4s cubic-bezier(.4,2.3,.3,1);
    margin: 0 auto;
    }
    .modal-title {
        color: var(--primary-color,#bc9a69);
        margin-bottom: 1.5rem;
        text-align: center;
        font-weight: bold;
        font-size: 1.3rem;
        letter-spacing: 1px;
    }
    .modal-details {
        line-height: 2.2;
        font-size: 1.1rem;
        color: #333;
        padding: 0.5rem 0.5rem 0 0.5rem;
    }
    .close-modal-circle {
        position: absolute;
        background: linear-gradient(135deg, #dc3545 0%, #ff7675 100%);
        top: 1rem;
        left: 1rem;
        border: none;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        color: #fff;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,123,255,0.13);
        cursor: pointer;
        transition: background 0.2s, color 0.2s, transform 0.2s;
        z-index: 10;
    }
    .close-modal-circle:hover {
        background: linear-gradient(135deg, #dc3545 0%, #ff7675 100%);
        color: #fff;
        transform: scale(1.1) rotate(-10deg);
    }
    .cart-total-box {
    border-radius: 18px;
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2.5rem;
    margin: 0 auto;
    width: 100%;
    margin-bottom: 2rem;
    font-family: 'IBM Plex Sans Arabic', sans-serif !important;
    }
    .cart-total-label {
        display: flex;
        align-items: center;
        font-size: 1.2rem;
        color: #bc9a69;
        font-weight: bold;
    }
    /*background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);*/
    .cart-total-value {
        color: #222;
        font-weight: bold;
        background: #bc9a6924;
        border-radius: 10px;
        padding: 0.3rem 1.2rem;
        margin: 0 0.7rem;
    }
    .pay-now-btn {
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        color: #fff;
        border: none;
        border-radius: 25px;
        padding: 0.7rem 2.2rem;
        font-size: 1.1rem;
    font-family: 'IBM Plex Sans Arabic', sans-serif !important;
    font-weight: bold;
        letter-spacing: 1px;
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .pay-now-btn:hover {
        background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
        box-shadow: 0 6px 20px rgba(0,123,255,0.18);
        transform: scale(1.04);
    }
    .status{
        color: black;
        position: absolute;
        top: 4px;
        left: -24px;18;
        rotate: -35deg;
        background: #bc9a69;
        width: 140px;
        text-align: center;
        padding: 9px;
        z-index: 9;
        font-weight: bold;
    }
        /* .h5{
        font-size:15.6px;
    } */

    .main-container {
        max-width: 1140px;
        margin: 48px auto 0 auto;
        background: #fff; 
        border-radius: 24px;
        box-shadow: 0 4px 32px #ede7f6a0;
        padding: 40px 32px 32px 32px;
        position: relative;
    }
    .cart-title {
        font-size: 1.7em;
        font-weight: bold;
        color: #222;
        margin-bottom: 32px;
    }
    .service-card {
        border: 1.5px solid #222;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 2px 8px #f3e5f5;
        padding: 28px 24px 18px 24px;
        display: flex;
        align-items: flex-start;
        gap: 50px;
        margin-bottom: 32px;
        position: relative;
    }
    .service-delete {
        color: #c7a16b;
        background: none;
        border: none;
        font-size: 2.2em;
        cursor: pointer;
        margin-top: 8px;
        margin-left: 8px;
        transition: color 0.2s;
    }
    .service-delete:hover {
        color: #a67c52;
    }
    .service-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .service-name {
        font-size: 1.2em;
        font-weight: bold;
        color: #222;
        margin-bottom: 4px;
    }
    .service-info {
        color: #444;
        font-size: 1em;
        margin-bottom: 2px;
    }
    .service-date {
        color: #222;
        font-size: 0.98em;
        font-weight: 500;
    }
    .service-price {
        color: #c7a16b;
        font-size: 1.1em;
        font-weight: bold;
        margin-top: 8px;
    }
    .service-coupon {
        display: flex;
        align-items: center;
        gap: 0;
        margin-top: 50px;
    }
    .service-coupon input {
        border: 1.5px solid #222;
        border-radius: 8px 0 0 8px;
        padding: 10px 16px;
        font-size: 1em;
        outline: none;
        min-width: 220px;
    }
    .service-coupon button {
        border: none;
        background: #c7a16b;
        color: #fff;
        font-weight: bold;
        font-size: 1em;
        border-radius: 0 8px 8px 0;
        padding: 10px 22px;
        cursor: pointer;
        margin-right: -4px;
        transition: background 0.2s;
    }
    .service-coupon button:hover {
        background: #a67c52;
    }
    .summary-section {
        margin-top: 18px;
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .summary-coupon {
        display: flex;
        align-items: center;
        gap: 0;
    }
    .summary-coupon input {
        border: 1.5px solid #222;
        border-radius: 8px 0 0 8px;
        padding: 10px 16px;
        font-size: 1em;
        outline: none;
        min-width: 220px;
    }
    .summary-coupon button {
        border: none;
        background: #c7a16b;
        color: #fff;
        font-weight: bold;
        font-size: 1em;
        border-radius: 0 8px 8px 0;
        padding: 10px 22px;
        cursor: pointer;
        margin-right: -4px;
        transition: background 0.2s;
    }
    .summary-coupon button:hover {
        background: #a67c52;
    }
    .summary-info {
        margin-top: 32px;
        margin-bottom: 18px;
    }
    .summary-label {
        font-size: 1.1em;
        color: #222;
        font-weight: bold;
    }
    .summary-value {
        font-size: 1.1em;
        color: #c7a16b;
        font-weight: bold;
    }
    .wallet-label {
        color: #222;
        font-size: 1em;
        margin-top: 8px;
    }
    .wallet-value {
        color: #c7a16b;
        font-size: 1em;
        font-weight: bold;
    }
    .pay-options {
        margin: 18px 0 32px 0;
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .pay-radio {
        accent-color: #c7a16b;
        margin-left: 6px;
    }
    .pay-label {
        font-size: 1em;
        color: #222;
        margin-left: 18px;
    }
    .pay-label:last-child {
        margin-left: 0;
    }
    .pay-btn {
        width: 100%;
        background: #c7a16b;
        color: #fff;
        font-size: 1.25em;
        font-weight: bold;
        border: none;
        border-radius: 12px;
        padding: 16px 0;
        margin-top: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: background 0.2s;
    }
    .pay-btn:hover {
        background: #a67c52;
    }
    /* Floating Buttons */
    .floating-cart {
        position: fixed;
        right: 36px;
        bottom: 120px;
        background: #c7a16b;
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        box-shadow: 0 2px 8px #c7a16b55;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2em;
        z-index: 10;
    }
    .cart-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e53935;
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 4px #b71c1c33;
    }
    .floating-btns {
        position: fixed;
        right: 36px;
        bottom: 36px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        z-index: 10;
    }
    .floating-btn {
        background: #c7a16b;
        color: #fff;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        box-shadow: 0 2px 8px #c7a16b55;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5em;
        cursor: pointer;
        border: none;
        transition: background 0.2s;
    }
    .floating-btn:hover {
        background: #a67c52;
    }
    @media (max-width: 700px) {
        .main-container { padding: 16px 4vw; }
        .service-card { flex-direction: column; gap: 8px; }
        .summary-section { flex-direction: column; gap: 12px; }
    }
    a:hover {
        color:white;
    }
    .btn:hover {
    background-color: #956e48;
    }
</style>
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

    <!-- Page Content -->
    <div class="container py-5" style="min-height: 60vh;">
        @if($cartItems->count())
             <div class="main-container">
            <div class="cart-title">{{ __('messagess.cart') }}</div>
             @foreach($cartItems as $item)
            <div class="service-card">
                <div class="service-details">
                    <div class="service-name">{{ $item->service->name }}</div>
                    <div class="service-info">{{ __('messagess.employee') }}: {{ $item->staff->name}}</div>
                    <div class="service-info">{{ __('messagess.branch') }}:{{ $item->branch }}</div>
                    <div class="service-date">{{ __('messagess.date') }}: {{ $item->date }} - {{ $item->time }}</div>
                    <div class="service-price">SR {{ $item->service->price }} :{{ __('messagess.price') }}</div>
                </div>
                <div class="service-coupon">
                    <button>{{ __('messagess.apply_coupon') }}</button>
                    <input type="text" placeholder="{{ __('messagess.enter_coupon') }}">
                </div>
                <form action="{{route('cart.destroy' ,$item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="service-delete" title="{{ __('messagess.delete_service') }}" style="position: relative;top: -29px;left: -2%;font-size: 25px;"><i class="fas fa-trash"></i>️</button>
                </form>
            </div>
             @endforeach
            
            <div class="summary-section">
                <div class="summary-coupon">
                    <button>{{ __('messagess.add_invoice_coupon') }}</button>
                    <input type="text" placeholder="{{ __('messagess.enter_invoice_coupon') }}">
                </div>
            </div>
            <div class="summary-info">
                <span class="summary-label">{{ __('messagess.total') }} :</span>
                <span class="summary-value">SR <span id="tl">{{$totalPrice}}</span></span>
            </div>
            <div class="wallet-label">
                {{ __('messagess.wallet_balance') }} : <span class="wallet-value">SR 0.00</span>
            </div>
            <div class="pay-options">
                <label class="pay-label"><input type="radio" class="pay-radio" name="pay" checked>{{ __('messagess.pay_by_card') }}</label>
                <label class="pay-label"><input type="radio" class="pay-radio" name="pay">{{ __('messagess.pay_by_wallet') }}</label>
            </div>
            <button onclick="proceedToPayment()" class="pay-btn">{{ __('messagess.continue_to_pay') }} <i class="fas fa-credit-card"></i> </button>
        </div>
        @else
            <!-- لو لم يكن هناك بيانات -->
                <div id="emptyCart" class="cart-empty">
                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                    <p>{{ __('messagess.cart_empty_message') }}</p>
                    <a href="{{ route('frontend.services') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-right"></i> {{ __('messagess.browse_services') }}
                    </a>
                </div>
        @endif
    </div>
    
    <!-- Footer -->
    @include('components.frontend.footer')
<!-- Modal & دفع -->
<script>
    function showModal(id) {
        document.getElementById(`modal-${id}`).style.display = 'block';
    }

    function proceedToPayment() {
        let total = document.getElementById('tl').textContent.trim();
        Swal.fire({
            icon: 'success',
            title: '{{ __('messagess.success_payment_title') }}',
            text: '{{ __('messagess.success_payment_text') }}',
            confirmButtonText:'{{ __('messagess.ok') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/pay-now?am=' + total;
            }
        });
    }
    
        function calculateTotal() {
        let total = 0;
        document.querySelectorAll('[data-price]').forEach(card => {
            const price = parseFloat(card.dataset.price);
            if (!isNaN(price)) total += price;
        });
        document.getElementById('total').innerText = `${total.toFixed(2)}`;
    }

    // شغّل الحساب أول ما الصفحة تجهز
    document.addEventListener('DOMContentLoaded', calculateTotal);
</script>
<!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
