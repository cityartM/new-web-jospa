@php
    $currentLocale = session('locale', app()->getLocale());
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - {{ __('messagess.category_details') }}</title>
    <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    
        body{
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        }
        body, .container, .row, .col-12, .col-md-6, .col-lg-4, h2, p, div, span, th, td, button, a, label, input, select, textarea {
            font-size: 16px !important;
        }
        .service-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
            transition: transform 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
        .category-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .booking-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .booking-btn:hover {
            background: #a67c3f;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        .price-badge {
            background: var(--primary-color);
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .category-badge {
            background: #f5f5f5;
            color: var(--primary-color);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .service-info {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .service-info i {
            color: var(--primary-color);
            width: 20px;
            margin-right: 0.5rem;
        }
        .service-image {
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 1rem;
        }
        .category-description {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .category-image {
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
        @media (max-width: 768px) {
            .category-title { font-size: 1.8rem; }
            .service-card { padding: 1rem; }
        }
        .img-zoom-hover {
            transition: transform 0.5s cubic-bezier(.4,1.6,.6,1);
        }
        .img-zoom-hover:hover {
            transform: scale(1.08);
            z-index: 2;
            box-shadow: 0 8px 32px #00000030;
        }
        .why-card:hover {
            box-shadow: 0 8px 32px #9b7a4a30 !important;
            transform: translateY(-6px) scale(1.03);
        }
        .why-icon {
            transition: background 0.3s, transform 0.3s;
        }
        .why-card:hover .why-icon {
            background: #7a5c2e !important;
            transform: rotate(-6deg) scale(1.12);
        }
        .container {
            width: 1008px;
        }
        
        
        .header-section {
            text-align: center;
            margin: 90px;
        }
        .header-title {
            color: #a3835b;
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .header-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px 0 20px 0;
        }
        .divider-line {
            width: 80px;
            height: 2px;
            background: #a3835b;
            border-radius: 3px;
        }
        .divider-icon {
            margin: 0 25px;
            font-size: 32px;
            color: #a3835b;
            animation: spin 5s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .header-desc {
            color: #444;
            font-size: 24px;
            margin-bottom: 40px;
        }
        .cta-btn {
            background: #a3835b;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 18px 45px;
            font-size: 24px;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 24px rgba(163, 131, 91, 0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
        }
        .cta-btn:hover {
            background: #8a6b4a;
        }
        .cta-btn .icon {
            font-size: 22px;
        }
    </style>
</head>
<body dir="{{ $currentLocale === 'ar' ? 'rtl' : 'ltr' }}" lang="{{ $currentLocale }}">
    <!-- Lightning Progress Bar -->
    @include('components.frontend.progress-bar')   

    <!-- Hero/Header Section (like About page) -->
    <div class="position-relative" style="height: 35vh; min-height: 220px;">
        <img src="{{ asset('images/frontend/slider1.webp') }}" alt="Category Hero" class="w-100 h-100" style="object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.35);"></div>
        @include('components.frontend.navbar')
        @include('components.frontend.second-navbar')
    </div>
    <main class="container" style="margin-top: -60px; z-index: 2; position: relative;">
        <!-- Title and Booking Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
        </div>
        <!-- Description and Image Section -->
        <div class="container my-5">
                <div class="header-section">
        <h1 style="font-weight:bold">خدمات الحمام المغربي</h1>
        <div class="header-divider">
            <div class="divider-line"></div>
            <span class="divider-icon">
                <svg class="animate-spin-slow" style="color: #ba9368;width: 25px;height: 40px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true" role="img">
                    <path d="M258.6 0c-1.7 0-3.4 .1-5.1 .5C168 17 115.6 102.3 130.5 189.3c2.9 17 8.4 32.9 15.9 47.4L32 224l-2.6 0C13.2 224 0 237.2 0 253.4c0 1.7 .1 3.4 .5 5.1C17 344 102.3 396.4 189.3 381.5c17-2.9 32.9-8.4 47.4-15.9L224 480l0 2.6c0 16.2 13.2 29.4 29.4 29.4c1.7 0 3.4-.1 5.1-.5C344 495 396.4 409.7 381.5 322.7c-2.9-17-8.4-32.9-15.9-47.4L480 288l2.6 0c16.2 0 29.4-13.2 29.4-29.4c0-1.7-.1-3.4-.5-5.1C495 168 409.7 115.6 322.7 130.5c-17 2.9-32.9 8.4-47.4 15.9L288 32l0-2.6C288 13.2 274.8 0 258.6 0zM256 224a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"></path>
                </svg>

            </span>
            <div class="divider-line"></div>
        </div>
        <div class="header-desc">رحلة استجمام وتجديد</div>
        <div style="display: flex; justify-content: center;">
            <button class="cta-btn">
                احجزي الآن
                <span class="icon"><svg data-v-eec84f9e="" style="width: 15.2px;font-family: 'IBM Plex Sans Arabic', sans-serif !important;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path class="" fill="currentColor" d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"></path></svg></span>
            </button>
        </div>
    </div>
            <div class="row align-items-center justify-content-center">
                <!-- النص -->
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-left" data-aos-duration="1200">
                    <div style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #00000015; padding: 40px 32px; text-align: right;">
                        <p style="font-size: 1.25rem; line-height: 2;">
                        {{ $category->description ?? __('messagess.category_description_default', ['name' => $category->name]) }}
                    </div>
                </div>
                <!-- الصورة -->
                <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1200">
                    <img src="{{ asset('images/frontend/slider' . (rand(1, 3)) . '.webp') }}" alt="خدمات العناية بالبشرة" style="max-width: 90%; border-radius: 24px; box-shadow: 0 4px 24px #00000015;" class="img-zoom-hover">
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row align-items-center justify-content-center">
                                <!-- الصورة -->
                <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-right" data-aos-duration="1200">
                    <img src="{{ asset('images/frontend/slider' . (rand(1, 3)) . '.webp') }}" alt="خدمات العناية بالبشرة" style="max-width: 90%; border-radius: 24px; box-shadow: 0 4px 24px #00000015;" class="img-zoom-hover">
                </div>
                <!-- النص -->
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-left" data-aos-duration="1200">
                    <div style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #00000015; padding: 40px 32px; text-align: right;">
                        <p style="font-size: 1.25rem; line-height: 2;">
                        {{ $category->description ?? __('messagess.category_description_default', ['name' => $category->name]) }}
                    </div>
                </div>
            </div>
        </div>
        
        <h1 style="text-align:center;margin:50px 0">{{ __('messagess.prices_and_services') }}</h1>
        
        <!-- Services Section -->
        @if($category->services && $category->services->count() > 0)
            <div class="row g-4">
                @foreach($category->services as $service)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="service-card">
                            <img src="{{ $service->feature_image ?? asset('images/frontend/slider1.webp') }}"
                                 alt="{{ $service->name }}"
                                 class="service-image">

                            <h5 class="mb-3">{{ $service->name }}</h5>

                            @if($service->description)
                                <p class="text-muted small mb-3">{{ Str::limit($service->description, 100) }}</p>
                            @endif

                            <div class="price-badge" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                SR {{ number_format($service->default_price ?? 0, 2) }}
                            </div>

                            <div class="service-info">
                                <i class="fas fa-clock"></i>
                                <span>{{ $service->duration_min ?? 0 }} minutes</span>
                            </div>

                            @if($service->sub_category)
                                <div class="service-info">
                                    <i class="fas fa-tags"></i>
                                    <span class="category-badge">{{ $service->sub_category->name }}</span>
                                </div>
                            @endif

                            @if($service->branches && $service->branches->count() > 0)
                                <div class="service-info">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="small">{{ $service->branches->pluck('name')->implode(', ') }}</span>
                                </div>
                            @endif

                            <div class="mt-3">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No services available in this category.</p>
            </div>
        @endif
    </main>
 
    <!-- Pricing Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pricingModalLabel">{{ $category->name }} - Services & Pricing</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
            @if($category->services && $category->services->count() > 0)
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Service</th>
                      <th>Sub Category</th>
                      <th>Price (SR)</th>
                      <th>Duration (minutes)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($category->services as $service)
                        <tr>
                          <td>{{ $service->name }}</td>
                          <td>{{ $service->sub_category ? $service->sub_category->name : 'N/A' }}</td>
                          <td>{{ number_format($service->default_price, 2) }}</td>
                          <td>{{ $service->duration_min }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            @else
                <div class="text-center text-muted">
                    <p>No services available in this category.</p>
                </div>
            @endif   
          </div>
        </div>
      </div>
    </div>
    
    <div class="container my-5" style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
    <div class="why-jo-box p-5" style="background: #fafbfc; border-radius: 18px; box-shadow: 0 8px 32px #00000010;font-size:18px !important">
        <h2 class="text-center mb-5" style="font-weight: bold;font-size: 2.7rem !important;color: #181d29;">
           {{ __('messagess.why_jospa_best') }}
        </h2>
        <div class="row g-4">
            <!-- كارت 1 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="why-card d-flex align-items-center justify-content-between p-4" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #00000010; transition: box-shadow 0.3s, transform 0.3s;">
                        <div>
                            <div class="why-title mb-2" style="font-size: 1.7rem; font-weight: 600;">{{ __('messagess.high_quality_products') }}</div>
                            <div class="why-desc" style="color: #6c757d;">{{ __('messagess.safe_effective_products') }}</div>
                        </div>
                    <div class="why-icon ms-3 d-flex align-items-center justify-content-center" style="background: #9b7a4a; border-radius: 8px; width: 70px; height: 70px;">
                        <i class="fas fa-box-open fa-2x text-white"></i>
                    </div>
                </div>
            </div>
            <!-- كارت 2 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="why-card d-flex align-items-center justify-content-between p-4" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #00000010; transition: box-shadow 0.3s, transform 0.3s;">
                        <div>
                            <div class="why-title mb-2" style="font-size: 1.7rem; font-weight: 600;">
                                {{ __('messagess.expert_specialists') }}
                            </div>
                            <div class="why-desc" style="color: #6c757d;">
                                {{ __('messagess.trained_professional_team') }}
                            </div>
                        </div>
                    <div class="why-icon ms-3 d-flex align-items-center justify-content-center" style="background: #9b7a4a; border-radius: 8px; width: 70px; height: 70px;">
                        <i class="fas fa-user-tie fa-2x text-white"></i>
                    </div>
                </div>
            </div>
            <!-- كارت 3 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="why-card d-flex align-items-center justify-content-between p-4" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #00000010; transition: box-shadow 0.3s, transform 0.3s;">
                    <div>
                        <div class="why-title mb-2" style="font-size: 1.7rem; font-weight: 600;">
                            {{ __('messagess.personalized_experience') }}
                        </div>
                        <div class="why-desc" style="color: #6c757d;">
                            {{ __('messagess.tailored_services') }}
                        </div>
                    </div>
                    <div class="why-icon ms-3 d-flex align-items-center justify-content-center" style="background: #9b7a4a; border-radius: 8px; width: 70px; height: 70px;">
                        <i class="fas fa-sliders-h fa-2x text-white"></i>
                    </div>
                </div>
            </div>
            <!-- كارت 4 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="why-card d-flex align-items-center justify-content-between p-4" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #00000010; transition: box-shadow 0.3s, transform 0.3s;">
                    <div>
                        <div class="why-title mb-2" style="font-size: 1.7rem; font-weight: 600;">
                            {{ __('messagess.comfortable_environment') }}
                        </div>
                        <div class="why-desc" style="color: #6c757d;">
                            {{ __('messagess.unmatched_relaxation') }}
                        </div>
                    </div>
                    <div class="why-icon ms-3 d-flex align-items-center justify-content-center" style="background: #9b7a4a; border-radius: 8px; width: 70px; height: 70px;">
                        <i class="fas fa-leaf fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<h5 style="text-align:center; margin: 44px 0;">
    {!! __('messagess.skin_pampering_text') !!}
</h5>
            <button class="cta-btn">
                احجزي الآن
                <span class="icon"><svg data-v-eec84f9e="" style="width: 15.2px;font-family: 'IBM Plex Sans Arabic', sans-serif !important;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path class="" fill="currentColor" d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"></path></svg></span>
            </button>
</div>

    @include('components.frontend.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });

        // Fix modal backdrop issue
        document.addEventListener('DOMContentLoaded', function() {
            const pricingModal = document.getElementById('pricingModal');

            if (pricingModal) {
                pricingModal.addEventListener('hidden.bs.modal', function () {
                    // Remove any remaining backdrop
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());

                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                    document.body.style.overflow = '';
                });
            }
        });
    </script>
</body>
</html>
