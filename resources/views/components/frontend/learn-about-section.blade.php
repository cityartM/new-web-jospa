<section class="py-5" style="margin-top: 100px;">
    <div class="container" style="padding:0 5rem">
        <div class="row align-items-center g-5">
            <!-- Left: Text -->
            <div class="col-12 col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <h2 class="fw-bold mb-4" style=" font-size: 3rem;">
                   <span style="color: var(--primary-color);">Learn about</span> Jo Spa
                </h2>
                <p class="mb-4" style="font-size: 1.2rem; line-height: 1.8; color: #222;">
                    We specialize in providing a unique luxury experience for our valued guests. We strive to provide an unparalleled feeling of happiness and joy by enjoying a distinctive atmosphere of calm and relaxation, in addition to a variety of luxurious spa treatments that help achieve inner balance and purity. Thanks to our specialized team concerned with the comfort of our guests, we guarantee a unique and comfortable experience that leaves a long-lasting positive impression.
                </p>
                @include('components.frontend.gift-button', [
                    'text' => 'Read More',
                    'href' => '#',
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
