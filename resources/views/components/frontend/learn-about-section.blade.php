<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<section class="py-5" style="margin-top: 100px;">
    <div class="container" style="padding:0 5rem">
        <div class="row align-items-center g-5">
            <!-- Left: Text -->
            <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <h2 class="fw-bold mb-4" style="font-size: 44.8px;margin-bottom: 15px;font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
                    <span style="color: var(--primary-color);">
                        {{ __('messagess.title_part1') }}
                    </span>
                    {{ __('messagess.title_part2') }}
                </h2>
                    <div style="display: flex; align-items: center;width: 100%;">
        <div style="height: 2px; width: 50px; background: #bc9a69; border-radius: 2px;"></div>
        <div style="margin: 0 10px; color: #bc9a69; font-size: 25px;">
          &#10048;
        </div>
        <div style="height: 2px; width: 50px; background: #bc9a69; border-radius: 2px;"></div>
      </div>
                <p class="mb-4" style="margin-top: 47px;color: #000;font-size: 17.6px;line-height: 1.8;margin-bottom: 30px !important;font-weight: 400;font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
  {{ __('messagess.description2') }}                </p>
                @include('components.frontend.gift-button', [
                    'text' => __('messagess.read_more'),
                    'href' =>  route('frontend.about'),
                    'class' => 'fs-4 px-5 py-3 border-0',
                ])
            </div>
            <!-- Right: Image -->
            <div class="col-12 col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                <img src="{{ asset('images/frontend/learn.webp') }}" alt="Learn about Jo Spa" class="img-fluid rounded-4 shadow" style="max-width: 90%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ once: true });
</script>
