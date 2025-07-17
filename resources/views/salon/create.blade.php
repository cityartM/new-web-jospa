<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messagess.booking_system') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
            background-color: #f8f6f1;
            color: #333;
        }

        /* Header Styles */
        .header {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #C8A882, #D4B896);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #C8A882;
        }

        .logo-subtitle {
            font-size: 12px;
            color: #666;
            margin-top: -5px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .language-btn {
            background: none;
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-btn {
            background: #C8A882;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-btn:hover {
            background: #B8986F;
        }

        /* Main Container */
        .container {
            width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            display: flex;
            gap: 30px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: white;
            border-radius: 22px;
            padding: 24px 0 24px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
            margin-top: 0;
            animation: fadeInRight 0.8s cubic-bezier(.4,1.6,.6,1);
        }
    @keyframes fadeInRight {
      0% { opacity: 0; transform: translateX(-40px); }
      100% { opacity: 1; transform: translateX(0); }
    }
    .step {
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 32px;
    border-bottom: 1px solid #f3e6d7;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 1.13rem;
    color: #b6a07a;
    background: transparent;
    position: relative;
    }

    .step:last-child { border-bottom: none; }
    .step.active {
      color: #fff;
      background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%);
      margin: 0;
      border-radius: 0 30px 30px 0;
      font-weight: bold;
      box-shadow: 0 4px 18px #bc9a6920;
      animation: stepPulse 0.5s;
    }
    @keyframes stepPulse {
      0% { box-shadow: 0 0 0 0 #bc9a6940; }
      70% { box-shadow: 0 0 0 10px #bc9a6920; }
      100% { box-shadow: 0 4px 18px #bc9a6920; }
    }
    .step-number {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: #e2c89c;
      border: 2px solid #fff;
      box-shadow: 0 1px 4px #bc9a6920;
      transition: background 0.3s;
    } 
    .step.active .step-number {
      background: #fff;
      border: 2px solid #bc9a69;
    }
    .step:hover:not(.active) {
      background: #f7f3ee;
      color: #bc9a69;
      transform: translateX(6px) scale(1.03);
    }
    #step1 {
  animation: fadeInUp 0.7s cubic-bezier(.4,1.6,.6,1);
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 24px #bc9a6920;
  padding: 32px 24px 24px 24px;
  margin-bottom: 32px;
}


        /* Content Area */
        .content {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Progress Bar */
        .progress-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            gap: 10px;
        }

        .progress-step {
            white-space: nowrap;
            padding: 8px 20px;
            border-radius: 25px;
            background: #e9ecef;
            color: #6c757d;
            font-size: 14px;
            min-width: 100px;
            text-align: center;
        }

        .progress-step.active {
            background: #C8A882;
            color: white;
        }

        .progress-step.completed {
            background: #28a745;
            color: white;
        }

        /* Gender Selection */
        .gender-selection {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin: 50px 0;
        }

        .gender-card {
            background: rgba(224, 247, 250, 0.5);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .gender-card:hover {
            border-color: #C8A882;
            transform: translateY(-5px);
        }

        .gender-card.selected {
            border-color: #C8A882;
            background: rgba(200, 168, 130, 0.1);
        }

        .gender-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .gender-icon.male {
            background: linear-gradient(135deg, #4a90e2, #7b68ee);
        }

        .gender-icon.female {
            background: linear-gradient(135deg, #ff6b9d, #c44569);
        }

        /* Service Grid */
       .service-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 بوكس جنب بعض */
  gap: 16px;
  padding: 10px;
}

.service-card {
  background: #f9f9f9;
  border-radius: 10px;
  padding: 12px;
  text-align: center;
  cursor: pointer;
  transition: 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.service-card:hover {
  background: #f0f0f0;
}

.service-card.selected {
  border: 2px solid #3498db;
}

.image-wrapper {
  width: 80px;
  height: 80px;
  margin: 0 auto 8px;
  overflow: hidden;
  border-radius: 50%;
  background: #ddd;
}

.image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.service-card h4 {
  font-size: 15px;
  margin: 6px 0 0;
  line-height: 1.3;
}

        .service-card:hover {
            border-color: #C8A882;
            transform: translateY(-5px);
        }

        .service-card.selected {
            border-color: #C8A882;
            background: rgba(200, 168, 130, 0.1);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
        }

        .service-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .service-description {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }

        /* Staff Selection */
        .staff-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        .staff-card {
            background: rgba(224, 247, 250, 0.3);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .staff-card:hover {
            border-color: #C8A882;
            transform: translateY(-5px);
        }

        .staff-card.selected {
            border-color: #C8A882;
            background: rgba(200, 168, 130, 0.1);
        }

        .staff-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .staff-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Time Slots */
        .time-slots {
            margin-top: 30px;
        }

        .time-period {
            margin-bottom: 20px;
        }

        .time-period-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }

        .time-grid {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .time-slot {
            padding: 8px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .time-slot:hover {
            border-color: #C8A882;
        }

        .time-slot.selected {
            background: #C8A882;
            color: white;
            border-color: #C8A882;
        }

        /* Calendar */
        .calendar {
            background: #C8A882;
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-nav {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .calendar-title {
            font-size: 20px;
            font-weight: bold;
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 10px;
        }

        .calendar-weekday {
            text-align: center;
            padding: 10px 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.1);
        }

        .calendar-day:hover {
            background: rgba(255,255,255,0.2);
        }

        .calendar-day.selected {
            background: white;
            color: #C8A882;
            font-weight: bold;
        }

        .calendar-day.other-month {
            opacity: 0.5;
        }

        /* Service Detail */
        .service-detail {
            display: flex;
            gap: 30px;
            align-items: center;
            margin: 40px 0;
        }

        .service-image {
            width: 300px;
            height: 200px;
            border-radius: 15px;
            background-size: cover;
            background-position: center;
        }

        .service-info {
            flex: 1;
        }

        .service-info h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .service-info p {
            color: #666;
            line-height: 1.6;
            font-size: 16px;
        }

        /* Location Form */
        .location-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #C8A882;
        }

        /* Navigation Buttons */
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #C8A882;
            color: white;
        }

        .btn-primary:hover {
            background: #B8986F;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .container {
                flex-direction: column;
                padding: 0 12px;
                gap: 20px;
            }
            .sidebar {
                width: 100%;
                border-radius: 16px;
                padding: 16px;
                margin-bottom: 20px;
            }
            .content {
                padding: 18px 8px;
                border-radius: 12px;
            }
            .step {
                padding: 12px 18px;
                font-size: 1rem;
            }
            .service-grid {
                grid-template-columns: 1fr;
            }
            .staff-grid {
                gap: 12px;
            }
            .calendar {
                padding: 16px;
                border-radius: 10px;
            }
            .service-detail {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
            .service-image {
                width: 100%;
                height: 180px;
                border-radius: 10px;
            }
            .header {
                width: 307%;
            }
        }
        @media (max-width: 600px) {
            .container {
                padding: 0 4px;
                gap: 10px;
            }
            .sidebar {
                padding: 8px 2px;
                border-radius: 8px;
            }
            .content {
                padding: 8px 2px;
                border-radius: 8px;
            }
            .step {
                padding: 8px 8px;
                font-size: 0.95rem;
            }
            .service-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .staff-grid {
                gap: 6px;
            }
            .calendar {
                padding: 8px;
                border-radius: 6px;
            }
            .service-detail {
                flex-direction: column;
                gap: 6px;
                align-items: flex-start;
            }
            .service-image {
                width: 100%;
                height: 120px;
                border-radius: 6px;
            }
        }

        /* Hidden class */
        .hidden {
            display: none !important;
        }

        /* Special styling for massage service cards */
        .massage-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .massage-card {
            background: rgba(248, 246, 241, 0.3);
            border: 2px solid #C8A882;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .massage-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(200, 168, 130, 0.2);
        }

        .massage-card.selected {
            background: rgba(200, 168, 130, 0.1);
        }

        .massage-duration {
            background: rgba(200, 168, 130, 0.1);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            color: #C8A882;
            margin-bottom: 10px;
            display: inline-block;
        }

        .massage-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .massage-location {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .massage-price {
            font-size: 16px;
            color: #C8A882;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .massage-book-btn {
            background: #C8A882;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s ease;
        }

        .massage-book-btn:hover {
            background: #B8986F;
        }

        .most-wanted {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ffc107;
            color: #333;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            transform: rotate(15deg);
        }
        #staffGrid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
    }
    
    .staff-card {
      background: #f1f1f1;
      border-radius: 8px;
      padding: 12px;
      text-align: center;
      cursor: pointer;
    }
    
    .staff-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      margin: 0 auto 8px;
    }
        .branch-options input[type="radio"]:checked + img {
        border-color: #007bff;
        box-shadow: 0 0 5px #007bff;
    }
    </style>
</head>
<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">
<!-- Header -->
 <header class="header" style="box-shadow: 0 4px 24px #bc9a6920; border-radius: 0 0 36px 36px; padding: 20px 0 0; text-align: center; position: relative; overflow: hidden;">
  <div class="header-container" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 0 20px;">

    <!-- الشعار -->
    <div class="logo" style="display: flex; align-items: center; gap: 12px; animation: fadeDown 0.8s cubic-bezier(.4,1.6,.6,1);">
        <a href="/">
            <img src="/logo.webp" alt="JO SPA Logo" style="height: 60px; width: auto; border-radius: 12px; object-fit: contain;">
        </a>
    </div>

    <!-- العنوان -->
    <div class="header-title" style="animation: fadeUp 0.9s cubic-bezier(.4,1.6,.6,1);">
      <h2 style="font-size: 2.2rem; color: #a8834b; font-weight: bold; letter-spacing: 1.5px; margin: 0;">{{ __('messagess.salon_booking') }}</h2>
    </div>

    <!-- زر اللغة -->
    <div class="header-right">
    <li class="nav-item list-unstyled">
        @php
            $currentLocale = session('locale', app()->getLocale());
            $targetLocale = $currentLocale === 'ar' ? 'en' : 'ar';
            $translationKey = $targetLocale === 'ar' ? 'messagess.nav_lang_ar' : 'messagess.nav_lang_en';
        @endphp

        <form id="change-lang-form" action="{{ route('change.lang', $targetLocale) }}" method="GET" style="display: none;"></form>

        <button type="button"
            onclick="document.getElementById('change-lang-form').submit();"
            class="btn btn-sm btn-outline-light rounded-pill px-3 fw-semibold"
            style="transition: 0.3s;">
            {{ __($translationKey) }}
        </button>
    </li>
</div>


  </div>
</header>

  

<!-- Main Container -->
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="step active" data-step="1">
            <div class="step-number"></div>
            <span>{{ __('messagess.location') }}</span>
        </div>
        <!--<div class="step" data-step="2">-->
        <!--    <div class="step-number"></div>-->
        <!--    <span>{{ __('messagess.gender') }}</span>-->
        <!--</div>-->
        <div class="step" data-step="3">
            <div class="step-number"></div>
            <span> {{ __('messagess.group') }}</span>
        </div>
        <div class="step" data-step="4">
            <div class="step-number"></div>
            <span>{{ __('messagess.service') }}</span>
        </div>
        <div class="step" data-step="5">
            <div class="step-number"></div>
            <span>{{ __('messagess.date') }}</span>
        </div>
        <div class="step" data-step="6">
            <div class="step-number"></div>
            <span>{{ __('messagess.staff') }}</span>
        </div>
        <div class="step" data-step="7">
            <div class="step-number"></div>
            <span>{{ __('messagess.time') }}</span>
        </div>
        <div class="step" data-step="8">
            <div class="step-number"></div>
            <span>{{ __('messagess.cart') }}</span>
        </div>
    </div>
    <!-- Content -->
    <div class="content">
        <!-- Progress Bar -->
        <div class="progress-bar">
    <div class="progress-step active">{{ __('messagess.location') }}</div>
    <!--
    <div class="progress-step">{{ __('messagess.gender') }}</div>
    -->
        <div class="progress-step">{{ __('messagess.group') }}</div>
        <div class="progress-step">{{ __('messagess.services') }}</div>
        <div class="progress-step">{{ __('messagess.date') }}</div>
        <div class="progress-step">{{ __('messagess.staff') }}</div>
        <div class="progress-step">{{ __('messagess.time') }}</div>
        <div class="progress-step">{{ __('messagess.cart') }}</div>
        </div>

        <!-- Step 1: Location -->
            <div id="step1" class="step-content">
                <div class="location-form">
                    <div class="form-group">
                        <label style="font-weight: bold; font-size: 16px; display: block; text-align: center;">
                            {{ __('messagess.select_branch') }}
                        </label>
            <br>
            <div class="branch-options mt-3" style="display: flex; gap: 150px;">
            @foreach ($branches as $branche)
                <label class="form-check" style="text-align: center; cursor: pointer; position: relative; margin-left:100px;">
                    <input class="form-check-input" type="radio" name="branch" value="{{$branche->slug}}" style="position: absolute; opacity: 0; pointer-events: none;">
                    <img src="/images/av3.webp" alt="Manfuha" style="width: 120px; height: 100px; border: 2px solid #ccc; border-radius: 10px; padding: 5px; transition: all 0.3s;">
                    <div style="margin-top: 8px;">{{ app()->getLocale() == 'ar' ? $branche->name : $branche->slug }}</div>
                </label>
            @endforeach
            </div>
        </div>
    </div>
</div>
        <!-- Step 3: Service Categories -->
        <div id="step3" class="step-content hidden">
            <div class="service-grid">
                <!-- الخدمات يتم تحميلها هنا ديناميكيًا -->
            </div>
        </div>

        <!-- Step 4: Specific Services (Massage example) -->
        <div id="step4" class="step-content hidden">
            <div class="massage-cards">

            </div>

        </div>

        <!-- Step 5: Date Selection -->
        <div id="step5" class="step-content hidden">
            <div class="calendar">
                <div class="calendar-header">
                    <button class="calendar-nav" id="prevMonth">‹</button>
                    <div class="calendar-title" id="calendarTitle">{{ __('messagess.month_title') }}</div>
                    <button class="calendar-nav" id="nextMonth">›</button>
                </div>
                <div class="calendar-weekdays">
            @foreach(__('messagess.weekdays') as $day)
                <div class="calendar-weekday">{{ $day }}</div>
            @endforeach
                </div>
                <div class="calendar-days" id="calendarDays">
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Step 6: Staff Selection -->
        <div id="step6" class="step-content hidden">
            <div  id ="staffGrid"  class="staff-grid">

            </div>
        </div>
            <!-- Time Slots -->
       <div id="step7" class="step-content hidden">
    <div class="time-slots">
        <div class="time-period">
            <div class="time-period-title">{{ __('messagess.select_time') }}</div>
            <div class="time-grid" id="time">
              
            </div>
        </div>
    </div>
</div>

<div class="step-content hidden" id="summaryCard">
 
</div>

        <!-- Navigation -->
        <div class="navigation">
            <button class="btn btn-secondary" id="prevBtn" disabled>{{ __('messagess.previous') }}</button>
            <button class="btn btn-primary" id="nextBtn">{{ __('messagess.next') }}</button>
        </div>
    </div>
</div>

<form id="bookingForm" action="{{ route('cart.store') }}" method="POST" style="display: none;">
    @csrf
    
    <input type="hidden" name="customer_id" id="inputCustomerName">
    <input type="hidden" name="mobile_no" id="inputMobileNo">
    <input type="hidden" name="neighborhood" id="inputNeighborhood">
    <input type="hidden" name="branch" id="inputBranch">
    <input type="hidden" name="gender" id="inputGender">
    <input type="hidden" name="service_group_id" id="inputServiceGroup">
    <input type="hidden" name="service_id" id="inputServiceId">
    <input type="hidden" name="date" id="inputDate">
    <input type="hidden" name="time" id="inputTime">
    <input type="hidden" name="staff_id" id="inputStaffId">
    <input type="hidden" name="status" id="inputStatus">
    <input type="hidden" name="agreed" id="inputAgreed">
    <input type="hidden" name="auto_change_staff" id="inputAutoChangeStaff">
</form>

<script>

        const translations = {
        next: "{{ __('messagess.next') }}",
        complete: "{{ __('messagess.complete') }}"
    };
    // Application State
    let currentStep = 1;
    let maxSteps = 7;
    let selectedData = {
        gender: null,
        location: {},
        service: null,
        massage: null,
        date: null,
        staff: null,
        time: null
    };

    // DOM Elements
    const steps = document.querySelectorAll('.step');
    const stepContents = document.querySelectorAll('.step-content');
    const progressSteps = document.querySelectorAll('.progress-step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Initialize Calendar
    let currentDate = new Date();
    let selectedDate = null;

    function initializeApp() {
        updateUI();
        setupEventListeners();
        generateCalendar();


    }

function updateUI() {
    // Update sidebar
    steps.forEach((step, index) => {
        step.classList.toggle('active', index + 1 === currentStep);
    });

    // Update progress bar
    progressSteps.forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 < currentStep) {
            step.classList.add('completed');
        } else if (index + 1 === currentStep) {
            step.classList.add('active');
        }
    });

    // Update step content
    stepContents.forEach((content, index) => {
        content.classList.toggle('hidden', index + 1 !== currentStep);
    });

    // ✅ عند الخطوة 8، نخفي كل شيء ونظهر كارت الملخص
   
    // Update navigation buttons
    prevBtn.disabled = currentStep === 1;
    nextBtn.textContent = currentStep === maxSteps ? translations.complete : translations.next;
}

    function setupEventListeners() {
        // Navigation buttons
        prevBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateUI();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (validateCurrentStep()) {
                if (currentStep < maxSteps) {
                    currentStep++;
                    updateUI();
                } else {
                    completeBooking();
                }
            }
        });

        // Gender selection
        document.querySelectorAll('.gender-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.gender-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                selectedData.gender = card.dataset.gender;
                fetchServiceGroups(selectedData.gender);

            });
        });

        // Service selection
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                selectedData.service = card.dataset.service;

                fetchServicesByGroup(selectedData.service);

            });
        });

        // Massage selection
        document.querySelectorAll('.massage-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.massage-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                selectedData.massage = card.dataset.massage;
            });
        });

        // Staff selection
        document.querySelectorAll('.staff-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.staff-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                selectedData.staff = card.dataset.staff;
            });
        });

        // Time slot selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', () => {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                slot.classList.add('selected');
                selectedData.time = slot.textContent;

            });
        });

        // Calendar navigation
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar();
        });

        // Sidebar step navigation
        steps.forEach((step, index) => {
            step.addEventListener('click', () => {
                if (index + 1 <= currentStep || index === 0) {
                    currentStep = index + 1;
                    updateUI();
                }
            });
        });
    }
    
    document.addEventListener('DOMContentLoaded', function () {
    fetchServiceGroups(); // سيتم تحميل الخدمات تلقائيًا
});
    function fetchServiceGroups() {
        fetch(`/service-groups/1`)
            .then(response => response.json())
            .then(data => {
                const serviceGrid = document.querySelector('.service-grid');
                serviceGrid.innerHTML = ''; // Clear previous content

                data.forEach(service => {
                    const card = document.createElement('div');
                    card.className = 'service-card';
                    card.dataset.service = service.id;
                    card.innerHTML = `
                    <div class="image-wrapper">
                        <img src="${service.image}" alt="${service.name}">
                    </div>
                    <h4>${service.name}</h4>
                `;

                    card.addEventListener('click', () => {
                        document.querySelectorAll('.service-card').forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedData.service = card.dataset.service;

                        fetchServicesByGroup(selectedData.service);

                    });

                    serviceGrid.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error fetching services:', error);
            });
    }
   function fetchServicesByGroup(serviceGroupId) {
    fetch(`/services/${serviceGroupId}`)
        .then(response => response.json())
        .then(data => {
            const massageContainer = document.querySelector('.massage-cards');
            massageContainer.innerHTML = '';

            data.forEach(service => {
                const card = document.createElement('div');
                card.className = 'massage-card';
                card.dataset.massage = service.id;

                card.innerHTML = `
                    ${service.mostWanted ? `<div class="most-wanted">MOST WANTED</div>` : ''}
                    <div class="massage-duration">${service.duration} Minutes</div>
                    <div class="massage-name">${service.name}</div>
                    <div class="massage-location">${service.location}</div>
                    <div class="massage-price">${service.price} SAR</div>
                    <button class="massage-book-btn">Book Now</button>
                `;

                // حدث على الكارد: اختيار الخدمة
                card.addEventListener('click', (e) => {
                    // إذا تم الضغط على الزر "Book Now"، لا تكمل تفعيل الكارد مرتين
                    if (e.target.classList.contains('massage-book-btn')) return;

                    document.querySelectorAll('.massage-card').forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    selectedData.massage = card.dataset.massage;
                });

                // حدث مخصص على زر "Book Now"
                card.querySelector('.massage-book-btn').addEventListener('click', () => {
                    // فعل تحديد الكارد
                    document.querySelectorAll('.massage-card').forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    selectedData.massage = card.dataset.massage;

                    // فعل الزر التالي
                    document.getElementById('nextBtn').click();

                    // تحميل الموظفين
                    fetchStaffMembers();
                });

                massageContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error fetching services:', error);
        });
}
    function fetchStaffMembers() {
        fetch('/staff')
            .then(response => response.json())
            .then(data => {
                const staffGrid = document.getElementById('staffGrid');
                console.log(staffGrid);
                if (!staffGrid) {
                    console.error('ما في عنصر بالـ id = "staffGrid"');
                    return;
                }
                staffGrid.innerHTML = ''; // clear old cards

                data.forEach(staff => {
                    const card = document.createElement('div');
                    card.className = 'staff-card';
                    card.dataset.staff = staff.id;

                    const initials = staff.name.split(' ').map(word => word[0]).join('').substring(0, 2).toUpperCase();

                    card.innerHTML = `
                    <div class="staff-avatar" style="background: linear-gradient(45deg, ${staff.color1 || '#4a90e2'}, ${staff.color2 || '#7b68ee'}); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                        👨
                    </div>
                    <div class="staff-name">${staff.name}</div>
                `;

                    card.addEventListener('click', () => {
                        document.querySelectorAll('.staff-card').forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedData.staff = staff.id;
                        
                        fetchAvailableTimes();

                    });

                    staffGrid.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Error fetching staff:', error);
            });
    }
    function generateCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        // Update calendar title
        const months = ['{{ __("messagess.january") }}', '{{ __("messagess.february") }}', '{{ __("messagess.march") }}', '{{ __("messagess.april") }}', '{{ __("messagess.may") }}', '{{ __("messagess.june") }}',
            '{{ __("messagess.july") }}', '{{ __("messagess.august") }}', '{{ __("messagess.september") }}', '{{ __("messagess.october") }}', '{{ __("messagess.november") }}', '{{ __("messagess.december") }}'];
        document.getElementById('calendarTitle').textContent = `${months[month]} ${year}`;

        // Generate calendar days
        const daysContainer = document.getElementById('calendarDays');
        daysContainer.innerHTML = '';

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - firstDay.getDay());

        for (let i = 0; i < 42; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);

            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = date.getDate();

            if (date.getMonth() !== month) {
                dayElement.classList.add('other-month');
            }

            if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                dayElement.classList.add('selected');
            }

            dayElement.addEventListener('click', () => {
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                dayElement.classList.add('selected');
                selectedDate = new Date(date);
                selectedData.date = selectedDate;
            });

            daysContainer.appendChild(dayElement);
        }
    }
function fetchAvailableTimes() {
    const date = selectedData.date.toISOString().split('T')[0];
    const staffId = selectedData.massage;

    const apiUrl = `/available/${date}/${staffId}`;
    console.log('Fetching available times from:', apiUrl);

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
const container = document.querySelector('#time');
            
            if (!container) {
                console.error('❌ .time-slots-container not found in the page.');
                return;
            }

            container.innerHTML = '';

            data.forEach(time => {
                const slot = document.createElement('div');
                slot.className = 'time-slot';
                slot.textContent = time;
                slot.addEventListener('click', () => {
                    document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                    slot.classList.add('selected');
                    selectedData.time = time;
                    
                });

                container.appendChild(slot);
            });
        })
        .catch(err => console.error('Error fetching times:', err));
        
        
}


function showSummary() {
    const summaryCard = document.getElementById('summaryCard');
    summaryCard.innerHTML = `
            <div class="summary-details" style="padding: 20px; background-color: #f7f7f7; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="color: #a8834b;">{{ __('messagess.booking_summary') }}:</h3>
            <p><strong>{{ __('messagess.branch') }}:</strong> ${selectedData.branch}</p>
            <p><strong>{{ __('messagess.service_group') }}:</strong> ${selectedData.service}</p>
            <p><strong>{{ __('messagess.service') }}:</strong> ${selectedData.massage}</p>
            <p><strong>{{ __('messagess.staff') }}:</strong> ${selectedData.staff}</p>
            <p><strong>{{ __('messagess.date') }}:</strong> ${selectedData.date ? selectedData.date.toISOString().split('T')[0] : ''}</p>
            <p><strong>{{ __('messagess.time') }}:</strong> ${selectedData.time}</p>
        </div>
                <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="termsCheck">
            <label class="form-check-label" for="termsCheck">
                {{ __('messagess.agree_terms') }}
            </label>
        </div>

        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="flexibleStaff">
            <label class="form-check-label" for="flexibleStaff">
                {{ __('messagess.flexible_staff') }}
            </label>
        </div>
    `;
}


   function validateCurrentStep() {
    switch (currentStep) {
        case 1:
            const selectedBranch = document.querySelector('input[name="branch"]:checked');
            if (!selectedBranch) {
                alert('{{ __("messagess.please_select_branch") }}');
                return false;
            }
            selectedData.branch = selectedBranch.value;
            break;

        case 3:
            if (!selectedData.service) {
                alert('Please select a service category');
                return false;
            }
            break;

        case 4:
            if (!selectedData.massage) {
                alert('Please select a specific service');
                return false;
            }
            break;

        case 5:
            if (!selectedData.date) {
                alert('Please select a date');
                return false;
            }
            break;

        case 6:
            if (!selectedData.staff) {
                alert('Please select a staff member');
                return false;
            }
            showSummary();
            break;

        case 7:
            if (!selectedData.time) {
                alert('يرجى اختيار وقت');
                return false;
            }

                document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
                document.getElementById('summaryCard').classList.remove('hidden');
            
                nextBtn.textContent = translations.complete;
            break;
            case 8:
                            completeBooking();
                            break;
           }

    return true;
}


function completeBooking() {
    const customer_id = {{ auth()->user()->id }};

    const bookingData = {
        customer_id,
        mobile_no: '0500000000',
        neighborhood: 'الربوة',
        branch: selectedData.branch,
        gender: 'women',
        service_group_id: selectedData.service,
        service_id: selectedData.massage,
        date: selectedData.date ? selectedData.date.toISOString().split('T')[0] : null,
        time: selectedData.time,
        staff_id: selectedData.staff,
        status: 'Salon',
        agreed: document.getElementById('termsCheck').checked ? 1 : 0,
        auto_change_staff: document.getElementById('flexibleStaff').checked ? 1 : 0,

    };



    document.getElementById('inputCustomerName').value = bookingData.customer_id;
    document.getElementById('inputMobileNo').value = bookingData.mobile_no;
    document.getElementById('inputNeighborhood').value = bookingData.neighborhood;
    document.getElementById('inputBranch').value = bookingData.branch;
    document.getElementById('inputGender').value = bookingData.gender;
    document.getElementById('inputServiceGroup').value = bookingData.service_group_id;
    document.getElementById('inputServiceId').value = bookingData.service_id;
    document.getElementById('inputDate').value = bookingData.date;
    document.getElementById('inputTime').value = bookingData.time;
    document.getElementById('inputStaffId').value = bookingData.staff_id;
    document.getElementById('inputStatus').value = bookingData.status;
    document.getElementById('inputAgreed').value = bookingData.agreed;
    document.getElementById('inputAutoChangeStaff').value = bookingData.auto_change_staff;

console.log(bookingData.auto_change_staff);
console.log( bookingData.agreed);

    document.getElementById('bookingForm').submit();
}


    // Initialize the application
    document.addEventListener('DOMContentLoaded', initializeApp);
</script>
</body>
</html>
