@php
    $currentLocale = session('locale', app()->getLocale());
@endphp
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messagess.giftcard') }} - JOSPA</title>
    <link rel="stylesheet" href="jospa-gift-card.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<style>
 body {
      font-family: 'IBM Plex Sans Arabic', sans-serif !important;
      background: #f8f6f1;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .gift-form-wrapper {
      max-width: 1160px;
      margin: 40px auto 0 auto;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 24px #bc9a6920;
      padding: 32px 28px 24px 28px;
      animation: fadeInUp 0.7s cubic-bezier(.4,1.6,.6,1);
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px);}
      100% { opacity: 1; transform: translateY(0);}
    }
    .gift-title {
      text-align: center;
      color: #bc9a69;
      font-size: 1.7rem;
      font-weight: bold;
      margin-bottom: 30px;
      letter-spacing: 1px;
    }
    .section-title {
      color: #a8834b;
      font-size: 25px;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: right;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .section-icon {
      font-size: 1.3em;
      color: #d2b07a;
      margin-left: 6px;
      font-family: inherit;
      font-weight: bold;
      line-height: 1;
    }
    .radio-group {
      display: flex;
      gap: 18px;
      margin-bottom: 18px;
    }
    .radio-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 1.13rem;
      color: #222;
      cursor: pointer;
      background: #faf5ef;
      border-radius: 14px;
      padding: 12px 28px 12px 18px;
      font-weight: bold;
      border: none;
      transition: background 0.18s, box-shadow 0.18s;
      box-shadow: 0 1px 6px #bc9a6920;
      position: relative;
    }
    .radio-item input[type="radio"] {
      display: none;
    }
    .radio-indicator {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      border: 2.5px solid #bbb;
      background: #fff;
      display: inline-block;
      position: relative;
      transition: border 0.2s, box-shadow 0.2s;
    }
    .radio-item input[type="radio"]:checked + .radio-indicator {
      border: 2.5px solid #1877f2;
      box-shadow: 0 0 0 3px #e3eaff;
      background: #fff;
    }
    .radio-item input[type="radio"]:checked + .radio-indicator::after {
      content: '';
      display: block;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #1877f2;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    a svg{
      color:white;
    }
    .radio-item input[type="radio"]:checked ~ .radio-text {
      color: #222;
    }
    .radio-item input[type="radio"]:checked ~ .radio-indicator,
    .radio-item input[type="radio"]:checked ~ .radio-text {
      font-weight: bold;
    }
    .radio-item input[type="radio"]:checked ~ .radio-indicator {
      border-color: #1877f2;
    }
    .radio-item input[type="radio"]:checked ~ .radio-text {
      color: #222;
    }
    .radio-item:has(input[type="radio"]:checked) {
      background: #faf5ef;
      box-shadow: 0 2px 10px #e3eaff40;
    }
    .radio-text {
      font-size: 1.08rem;
      color: #222;
    }
    .section {
      margin-bottom: 24px;
    }
    .input-row {
      display: flex;
      gap: 18px;
      margin-bottom: 18px;
    }
    .input-group {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .input-label {
      font-size: 1.08rem;
      color: #bc9a69;
      margin-bottom: 6px;
      font-weight: 500;
      text-align: right;
    }
    .form-input, .form-textarea {
      border: 1.5px solid #e2c89c;
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 1.1rem;
      margin-bottom: 6px;
      background: #faf8f5;
      transition: border-color 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 4px #bc9a6920;
      resize: none;
    }
    .form-input:focus, .form-textarea:focus {
      border-color: #bc9a69;
      outline: none;
      background: #fff;
      box-shadow: 0 2px 12px #bc9a6920;
    }
    .form-textarea {
      min-height: 60px;
      max-height: 120px;
    }
    .full-width { width: 100%; }
    .services-container {
      margin-bottom: 24px;
    }
.service-notes {
      background: #f7f2eb;
      border-radius: 16px;
      border: 2px solid #ede3d3;
      padding: 32px 38px 32px 24px;
      margin-bottom: 18px;
      box-shadow: none;
      color: #555;
      font-size: 1.13rem;
      position: relative;
    }
    .notes-title {
      color: #bc9a69;
      font-weight: bold;
      font-size: 1.18rem;
      margin-bottom: 18px;
      text-align: right;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .notes-title::before {
      content: '✽';
      color: #d2b07a;
      font-size: 1.2em;
      margin-left: 7px;
      font-weight: bold;
    }
    .notes-list {
      color: #555;
      font-size: 1.13rem;
      padding-right: 18px;
      margin: 0;
      list-style: disc inside;
      text-align: right;
    }
    .notes-list li {
      margin-bottom: 12px;
      line-height: 2.1;
      font-weight: 500;
    }
    .notes-list li:last-child {
      margin-bottom: 0;
    }
     .pricing-summary {
      background: #f7f2eb;
      border-radius: 16px;
      padding: 32px 38px 32px 24px;
      margin-bottom: 18px;
      box-shadow: none;
      min-height: 80px;
    }
    .price-label {
      color: #222;
      font-size: 1.18rem;
      font-weight: bold;
      margin-left: 12px;
      text-align: right;
    }
    .price-value {
      color: #222;
      font-size: 1.18rem;
      font-weight: bold;
      margin-right: 12px;
      text-align: left;
    }
    .add-to-cart-button {
      white-space: nowrap;
      text-decoration-line: none;
      background: #c7a36a;
      color: #fff;
      border: none;
      border-radius: 32px;
      padding: 16px 44px 16px 38px;
      font-size: 1.18rem;
      font-weight: bold;
      width: 239px;
      margin: 0;
      box-shadow: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      transition: background 0.22s, transform 0.18s;
    }

    .add-to-cart-button svg {
   width: 20px;
    }
    
    .add-to-cart-button:hover {
      background: #b8934d;
      transform: scale(1.04);
    }
    
            .container {
            border-radius: 15px;
        }

        .clickable-div {
            color: black !important;
            padding: 15px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 1px 1px #a8834b;
            margin-bottom: 20px;
        }

        .clickable-div:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px #a8834b; 
        }

        .clickable-div:active {
            transform: translateY(0);
        }

        .checkbox-list {
            display: none;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 15px;
            border: 2px solid #e9ecef;
        }

        .checkbox-list.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .checkbox-item:hover {
            background-color: #e9ecef;
        }

        .checkbox-item:last-child {
            margin-bottom: 0;
        }

        .checkbox-item input[type="checkbox"] {
            margin-left: 10px;
            transform: scale(1.2);
            accent-color: #4CAF50;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 16px;
            color: #333;
            flex: 1;
        }

        .icon {
            margin-left: 10px;
            font-size: 20px;
        }
    
    .view-counter {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
      color: #b6a07a;
      font-size: 1.08rem;
      margin-top: 8px;
      margin-bottom: 0;
    }
    .view-dots {
      font-size: 1.2rem;
      letter-spacing: 2px;
    }
    .page-footer {
      background: #fff;
      border-radius: 0 0 24px 24px;
      box-shadow: 0 -2px 12px #bc9a6920;
      margin-top: 32px;
      padding: 18px 0;
      text-align: center;
    }
    .footer-link {
      color: #bc9a69;
      font-size: 1.1rem;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.2s;
    }
    .footer-link:hover {
      color: #a8834b;
      text-decoration: underline;
    }
    @media (max-width: 900px) {
        .input-row {flex-wrap: wrap;}
      .main-container { flex-direction: column; }
      .product-gallery { border-left: none; border-bottom: 1.5px solid #f3e6d7; }
      .form-container { padding: 24px 10px; }
    }
    @media (max-width: 600px) {
        .input-row {flex-wrap: wrap;}
      .main-container { border-radius: 0; box-shadow: none; }
      .product-gallery { padding: 12px 2px; }
      .form-container { padding: 10px 2px; }
    }
     .slider-track {
    display: flex;
    width: max-content;
    animation: scroll-left 20s linear infinite;
  }

  .slider-item {
    flex-shrink: 0;
    margin-right: 16px;
  }

  .slider-item img {
     height: 192px;
    width: 288px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    transition: transform 0.3s;
    cursor: pointer;
  }

  .slider-item img:hover {
    transform: scale(1.07) rotate(-2deg);
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(-50%);
    }
  }

    @media (max-width: 700px) {
      .slider-img { width: 120px; height: 70px; }
      .slider-container { height: 80px; }
      .slider-track { height: 80px; }
    }
    .form-container {
      background: #fff;
      border-radius: 22px;
      box-shadow: 0 6px 32px #bc9a6920, 0 1.5px 8px #bc9a6910;
      padding: 38px 32px 32px 32px;
      margin: 0 auto 32px auto;
      max-width: 700px;
      min-width: 1160px;
      position: relative;
      z-index: 2;
      animation: fadeInUp 0.7s cubic-bezier(.4,1.6,.6,1);
    }
    .page-title {
      text-align: center;
      color: #bc9a69;
      font-size: 2.1rem;
      font-weight: bold;
      margin-bottom: 32px;
      letter-spacing: 1px;
      margin: 30px;
    }
    @media (max-width: 900px) {
      .form-container {
        padding: 22px 6px;
        max-width: 98vw;
      }
    }
    @media (max-width: 600px) {
      .form-container {
        padding: 8px 2px;
        min-width: unset;
      }
    }
    
    .section-title::before { 
        content: "❀";
        font-size: 1rem;
        color: rgb(191, 148, 87);
        opacity: 0.8;
    }
</style>

</head>
<body dir="{{ $currentLocale === 'ar' ? 'rtl' : 'ltr' }}" lang="{{ $currentLocale }}">
    @include('components.frontend.navbar')
    @include('components.frontend.second-navbar')
    <div style="background-image: url(https://jospa.tayasmart.com/images/frontend/slider2.webp);background-position: top;background-repeat: no-repeat;background-size: cover;width: 100%;height: 293px;"> 
    </div>

     <div style="position: relative; overflow: hidden; background: white; direction: ltr; width: 1520px;" class="d-none d-md-block">
      <div class="slider-track" style="padding: 25px;">
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/6d2e0c3d-fe2f-4c8e-b539-4cadc279f73f-1.jpeg" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/83e49680-69b5-4d8d-b152-5fcb2a1b1efe-1.jpeg.webp" alt="Image 2"></div>
        <div class="slider-item"><img src="{{ asset('images/gph1.webp') }}" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/6d2e0c3d-fe2f-4c8e-b539-4cadc279f73f-1.jpeg" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/83e49680-69b5-4d8d-b152-5fcb2a1b1efe-1.jpeg.webp" alt="Image 2"></div>
        <div class="slider-item"><img src="{{ asset('images/gph2.webp') }}" alt="Image 2"></div>
        <!-- كرر الصور -->
                <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/6d2e0c3d-fe2f-4c8e-b539-4cadc279f73f-1.jpeg" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/83e49680-69b5-4d8d-b152-5fcb2a1b1efe-1.jpeg.webp" alt="Image 2"></div>
        <div class="slider-item"><img src="{{ asset('images/gph2.webp') }}" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/6d2e0c3d-fe2f-4c8e-b539-4cadc279f73f-1.jpeg" alt="Image 1"></div>
        <div class="slider-item"><img src="https://jospa-sa.com/wp-content/uploads/2023/02/83e49680-69b5-4d8d-b152-5fcb2a1b1efe-1.jpeg.webp" alt="Image 2"></div>
        <div class="slider-item"><img src="{{ asset('images/gph2.webp') }}" alt="Image 2"></div>
      </div>
    </div>

  
    <div class="main-container">
        <div class="gift-card-container">

                <h1 class="page-title">{{ __('messagess.perfect_gift') }}</h1>
            <!-- Right side - Form --> 
            <div class="form-container">
        <form method="post" action= "{{route('gift.create')}}">
            @csrf
                <!-- Delivery Method Section -->
                <div class="section delivery-section">
                    <h3 class="section-title fw-bold">{{ __('messagess.delivery_method') }}</h3>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="delivery_method" value="traditional" checked>
                            <span class="radio-indicator"></span>
                            <span class="radio-text">{{ __('messagess.traditional_gift_card') }}</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="delivery_method" value="email">
                            <span class="radio-indicator"></span>
                            <span class="radio-text">{{ __('messagess.email_delivery') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Card Information Section -->
                <div class="section card-info-section">
                    <h3 class="section-title fw-bold">{{ __('messagess.card_info') }}</h3>
                    
                    <div class="input-row">
                        <div class="input-group">
                            <label class="input-label">{{ __('messagess.gifter_name') }}</label>
                            <input type="text" class="form-input" required>
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{ __('messagess.recipient_name') }}</label>
                            <input type="text" class="form-input" required>
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label class="input-label">{{ __('messagess.gifter_phone') }}</label>
                            <input type="tel" class="form-input">
                        </div>
                        <div class="input-group">
                            <label class="input-label">{{ __('messagess.recipient_phone') }}</label>
                            <input type="tel" class="form-input">
                        </div>
                    </div>

                    <div class="input-group full-width">
                        <label class="input-label">{{ __('messagess.optional_services') }}</label>
                        <textarea class="form-textarea" maxlength="100" placeholder="{{ __('messagess.optional_services') }}..."></textarea>
                    </div>
                </div>

                <!-- Services Selection -->
                <div class="services-container">
                    <h3 class="section-title fw-bold">{{ __('messagess.service_selection') }}</h3>

                    <!-- 1 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.skincare')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.skin_cleaning') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.skin_moisturizing') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item3">
                                <label for="item3">{{ __('messagess.skin_treatment') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.facial_care')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.face_mask') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.face_scrub') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.bleaching')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.teeth_whitening') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.skin_whitening') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 4 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.wax_services')}}</div>
                        <div class="checkbox-list" >
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.wax_hair_removal') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.eyebrow_shaping') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 5 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.hair_services')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.hair_cut') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.hair_dye') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item3">
                                <label for="item3">{{ __('messagess.hair_styling') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 6 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.bath_services')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.moroccan_bath') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.turkish_bath') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 7 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.cosmetics')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.daily_makeup') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.evening_makeup') }}</label>
                            </div>
                        </div>
                    </div>
                    <!-- 8 -->
                    <div class="container" >
                        <div class="clickable-div" onclick="toggleList(this)">{{ __('messagess.makeup')}}</div>
                        <div class="checkbox-list">
                            <div class="checkbox-item">
                                <input type="checkbox" id="item1">
                                <label for="item1">{{ __('messagess.natural_makeup') }}</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="item2">
                                <label for="item2">{{ __('messagess.professional_makeup') }}</label>
                            </div>
                        </div>
                    </div>
                    
                
                </div>

                <!-- Service Notes -->
                <div class="service-notes">
                    <p class="notes-title"> {{ __('messagess.soft_notes') }}</p>
                    <ul class="notes-list">
                        <li>{{ __('messagess.note_1') }}</li>
                        <li>{{ __('messagess.note_2') }}</li>
                        <li>{{ __('messagess.note_3') }}</li>
                        <li>{{ __('messagess.note_4') }}</li>
                    </ul>
                </div>

                <!-- Pricing Section -->
                <div class="pricing-summary">
                    
                    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
                        <h3>{{ __('messagess.total_amount') }}</h3>
                    <h3 >SR<span id="displayAmount">0.00</span></h3>
                    </div>
                <button onclick="payNow()" class="add-to-cart-button">
                    <svg class="svg-inline--fa fa-credit-card ml-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="credit-card" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path fill="currentColor" d="M64 32C28.7 32 0 60.7 0 96l0 32 576 0 0-32c0-35.3-28.7-64-64-64L64 32zM576 224L0 224 0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-192zM112 352l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z"></path>
                    </svg>
                    {{ __('messagess.proceed_to_payment') }}
                </button>
                </div>

                </form>
            </div>
            @include('components.frontend.footer')
        </div>

    </div>
    
    <script>

    function payNow() {
    
        let displayText = document.getElementById("displayAmount").innerText;

        let amount = displayText.trim();

        window.location.href = "/pay-now?am=" + encodeURIComponent(amount);
}


// drop down

        function toggleList($par) {
            console.log()
            const list = $par.nextElementSibling;
            list.classList.toggle('show');
        }


    
// JOSPA Gift Card Interface JavaScript

// Image gallery functionality
function switchMainImage(thumbnailElement) {
    const mainImage = document.getElementById('mainProductImage');
    const allThumbnails = document.querySelectorAll('.thumbnail-img');
    
    // Update main image source
    const newImageSrc = thumbnailElement.src.replace('w=100&h=80', 'w=600&h=400');
    mainImage.src = newImageSrc;
    
    // Update active thumbnail
    allThumbnails.forEach(thumb => thumb.classList.remove('active'));
    thumbnailElement.classList.add('active');
}


// Service dropdown functionality
function toggleServiceDropdown(dropdownId) {
    const dropdownMenu = document.getElementById(dropdownId);
    const dropdownHeader = dropdownMenu.previousElementSibling;
    const allDropdowns = document.querySelectorAll('.dropdown-menu');
    const allHeaders = document.querySelectorAll('.dropdown-header');
    
    // Close all other dropdowns
    allDropdowns.forEach(menu => {
        if (menu.id !== dropdownId) {
            menu.classList.remove('show');
        }
    });
    
    // Remove active class from all headers
    allHeaders.forEach(header => {
        if (header !== dropdownHeader) {
            header.classList.remove('active');
        }
    });
    
    // Toggle current dropdown
    dropdownMenu.classList.toggle('show');
    dropdownHeader.classList.toggle('active');
}

// Form validation function
function validateFormData() {
    const requiredInputs = document.querySelectorAll('input[required]');
    let isFormValid = true;
    
    requiredInputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#e74c3c';
            input.style.boxShadow = '0 0 0 2px rgba(231, 76, 60, 0.1)';
            isFormValid = false;
        } else {
            input.style.borderColor = '#e0e0e0';
            input.style.boxShadow = 'none';
        }
    });
    
    return isFormValid;
}

// Add to cart functionality
function addToCart() {
    const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked').value;
    const senderName = document.querySelector('input[placeholder="اسم المهدي"]').value;
    const recipientName = document.querySelector('input[placeholder="اسم المهدى إليه"]').value;
    const senderPhone = document.querySelector('input[placeholder="رقم الهاتف المهدي"]').value;
    const recipientPhone = document.querySelector('input[placeholder="رقم الهاتف المهدى إليه"]').value;
    const requestedServices = document.querySelector('textarea').value;

    // اجمع الخدمات المختارة
    const selectedServices = [];
    document.querySelectorAll('.dropdown-menu a.active').forEach(item => {
        selectedServices.push(item.textContent.trim());
    });

    fetch('/gift-cards', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            delivery_method: deliveryMethod,
            sender_name: senderName,
            recipient_name: recipientName,
            sender_phone: senderPhone,
            recipient_phone: recipientPhone,
            requested_services: requestedServices,
            selected_services: selectedServices,
            options_amount: 0,
            subtotal: 0
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error('Error:', error));
}

// Collect all form data
function collectFormData() {
    const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked')?.value;
    const senderName = document.querySelectorAll('.form-input')[0]?.value;
    const recipientName = document.querySelectorAll('.form-input')[1]?.value;
    const senderPhone = document.querySelectorAll('.form-input')[2]?.value;
    const recipientPhone = document.querySelectorAll('.form-input')[3]?.value;
    const serviceMessage = document.querySelector('.form-textarea')?.value;
    
    const selectedServices = Array.from(document.querySelectorAll('.dropdown-item.selected'))
        .map(item => item.textContent.trim());
    
    return {
        deliveryMethod,
        senderName,
        recipientName,
        senderPhone,
        recipientPhone,
        serviceMessage,
        selectedServices,
        timestamp: new Date().toISOString()
    };
}

// Show notification messages
function showNotificationMessage(message, type = 'info') {
    // Remove any existing notifications
    const existingNotification = document.querySelector('.custom-notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `custom-notification ${type}`;
    
    const colors = {
        success: '#27ae60',
        error: '#e74c3c',
        info: '#3498db',
        warning: '#f39c12'
    };
    
    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-text">${message}</span>
            <button class="notification-close" onclick="closeNotification(this)">&times;</button>
        </div>
    `;
    
    // Style the notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${colors[type] || colors.info};
        color: white;
        padding: 15px 20px;
        border-radius: 6px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        max-width: 350px;
        font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        animation: slideInRight 0.3s ease;
        direction: rtl;
    `;
    
    // Add notification styles if not already present
    if (!document.querySelector('#notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            .notification-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
            }
            .notification-close {
                background: none;
                border: none;
                color: white;
                font-size: 20px;
                cursor: pointer;
                padding: 0;
                width: 25px;
                height: 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                transition: background-color 0.3s ease;
            }
            .notification-close:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            closeNotification(notification.querySelector('.notification-close'));
        }
    }, 5000);
}

// Close notification
function closeNotification(button) {
    const notification = button.closest('.custom-notification');
    notification.style.animation = 'slideOutRight 0.3s ease';
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 300);
}

// Update pricing display
function updatePricingDisplay() {
    const selectedServices = document.querySelectorAll('.dropdown-item.selected');
    const basePrice = 400; // Base gift card price in SAR
    let optionsAmount = selectedServices.length * 50; // 50 SAR per additional service
    
    const optionsAmountElement = document.querySelector('.price-row:first-child .price-value');
    const subtotalElement = document.querySelector('.price-row:last-child .price-value');
    
    if (optionsAmountElement && subtotalElement) {
        optionsAmountElement.textContent = `${optionsAmount.toFixed(2)} ريال`;
        subtotalElement.textContent = `${(basePrice + optionsAmount).toFixed(2)} ريال`;
    }
}

// Service item selection
function selectServiceItem(serviceElement) {
    serviceElement.classList.toggle('selected');
    serviceElement.style.backgroundColor = serviceElement.classList.contains('selected') 
        ? '#e8f4f8' : '';
    updatePricingDisplay();
}

// Phone number formatting for Saudi numbers
function formatSaudiPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length > 0) {
        if (value.startsWith('966')) {
            value = '+' + value;
        } else if (value.startsWith('05') && value.length === 10) {
            value = '+966' + value.substring(1);
        } else if (value.length === 9 && value.startsWith('5')) {
            value = '+966' + value;
        }
    }
    
    input.value = value;
}

// Character counter for textarea
function updateCharacterCount(textarea) {
    const maxLength = parseInt(textarea.getAttribute('maxlength'));
    const currentLength = textarea.value.length;
    
    let counter = textarea.parentNode.querySelector('.char-counter');
    if (!counter) {
        counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = `
            font-size: 0.75rem;
            color: #888;
            text-align: left;
            margin-top: 4px;
            direction: ltr;
        `;
        textarea.parentNode.appendChild(counter);
    }
    
    counter.textContent = `${currentLength}/${maxLength}`;
    counter.style.color = currentLength > maxLength * 0.9 ? '#e74c3c' : '#888';
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            formatSaudiPhoneNumber(this);
        });
        
        input.addEventListener('blur', function() {
            if (this.value && !this.value.match(/^\+966[5-9]\d{8}$/)) {
                this.style.borderColor = '#f39c12';
                this.title = 'يرجى إدخال رقم هاتف سعودي صحيح';
            } else {
                this.style.borderColor = '#e0e0e0';
                this.title = '';
            }
        });
    });
    
    // Character counter for textarea
    const textarea = document.querySelector('.form-textarea');
    if (textarea) {
        textarea.addEventListener('input', function() {
            updateCharacterCount(this);
        });
        updateCharacterCount(textarea); // Initialize counter
    }
    
    // Service item selection
    const serviceItems = document.querySelectorAll('.dropdown-item');
    serviceItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            selectServiceItem(this);
        });
    });
    
    // Form validation on blur
    const requiredInputs = document.querySelectorAll('input[required]');
    requiredInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.style.borderColor = '#e74c3c';
            } else {
                this.style.borderColor = '#e0e0e0';
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.service-dropdown')) {
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            const allHeaders = document.querySelectorAll('.dropdown-header');
            
            allDropdowns.forEach(menu => menu.classList.remove('show'));
            allHeaders.forEach(header => header.classList.remove('active'));
        }
    });
    
    // Initialize pricing display
    updatePricingDisplay();
    
    // Handle form submission with Enter key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
            e.preventDefault();
            
            // Find next input or submit if last field
            const inputs = Array.from(document.querySelectorAll('input, textarea'));
            const currentIndex = inputs.indexOf(e.target);
            
            if (currentIndex < inputs.length - 1) {
                inputs[currentIndex + 1].focus();
            } else {
                addToCart();
            }
        }
        
        // Close dropdowns with Escape key
        if (e.key === 'Escape') {
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            const allHeaders = document.querySelectorAll('.dropdown-header');
            
            allDropdowns.forEach(menu => menu.classList.remove('show'));
            allHeaders.forEach(header => header.classList.remove('active'));
        }
    });
});

// Export/Import functionality (for future use)
function exportGiftCardData() {
    const data = collectFormData();
    const dataStr = JSON.stringify(data, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = `jospa-gift-card-${Date.now()}.json`;
    link.click();  
}

// Print gift card (for future use)
function printGiftCard() {
    const printContent = document.querySelector('.gift-card-container').innerHTML;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <!DOCTYPE html>
        <html dir="rtl">
        <head>
            <title>JOSPA Gift Card</title>
            <style>
                body { font-family: 'IBM Plex Sans Arabic', sans-serif !important; direction: rtl; }
                .no-print { display: none; }
                @media print {
                    .dropdown-menu { display: none !important; }
                    .add-to-cart-button { display: none; }
                }
            </style>
        </head>
        <body>
            ${printContent}
        </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.print();
}
    </script>
</body>
</html>