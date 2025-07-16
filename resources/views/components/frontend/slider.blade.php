<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<style>
#carouselExampleSlidesOnly,
#carouselExampleSlidesOnly .carousel-inner,
#carouselExampleSlidesOnly .carousel-item,
#carouselExampleSlidesOnly img {
    height: 100vh;
}
#carouselExampleSlidesOnly img {
    object-fit: cover;
}
.body{
font-family: 'IBM Plex Sans Arabic', sans-serif !important;
    
}
@keyframes cardFadeIn {
  0% { opacity: 0; transform: translateY(40px) scale(0.97); }
  100% { opacity: 1; transform: translateY(0) scale(1); }
}
.book-btn:hover {
  background: linear-gradient(90deg, #a8834b 60%, #bc9a69 100%) !important;
  box-shadow: 0 8px 32px #bc9a6970;
  transform: scale(1.07);
}
.book-btn:hover .icon-move {
  transform: translateX(7px) scale(1.15) rotate(-8deg);
}
.service-card:hover {
  box-shadow: 0 12px 40px #bc9a6970, 0 2px 12px #0002;
  transform: translateY(-6px) scale(1.025);
}
</style>

<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade position-relative" data-bs-ride="carousel">
    <div class="position-absolute top-0 start-0 w-100 bg-black" style="opacity: 0.4; height: 100%; z-index: 5"></div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/frontend/slider1.webp') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/frontend/slider2.webp') }}" class="d-block w-100" alt="...">
        </div>
    </div>

    {{ $slot }}
</div>
<div class="container my-5">
    <div class="row justify-content-center g-4">
          <!-- كارد فرع تمكين -->
        <div class="col-12 col-md-4">
            <div class="card text-center shadow h-100 border-0">
                <div class="card-body">
                    <div class="service-card" style="text-align: center;width: 350px;border-radius: 22px;overflow: hidden;box-shadow: 0 6px 32px #bc9a6920, 0 1.5px 8px #0001;background: #fff;display: flex;flex-direction: column;align-items: center;transition: box-shadow 0.3s, transform 0.3s;opacity: 0;transform: translateY(40px);animation: cardFadeIn 0.8s cubic-bezier(.4,1.6,.6,1) 0.2s forwards;">
                        <div style="width: 100%; height: 180px; overflow: hidden; border-radius: 22px 22px 0 0; box-shadow: 0 2px 16px #bc9a6940 inset;">
                            <img src="{{ asset('images/avs2.webp') }}" alt="تمكين" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </div>
                        <div style="padding: 20px 20px 6px 20px;width: 100%;text-align: center;font-size: 1.3rem;font-weight: bold;color: #222;font-family: 'IBM Plex Sans Arabic', sans-serif !important;letter-spacing: 0.5px;">
                        {{ __('messagess.tamkeen_branch') }}
                        </div>
                        <div style="padding: 0 20px 12px 20px; width: 100%; text-align: right; font-size: 1.05rem; color: #7a6c5c; font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
                          خدمات تجميلية متكاملة في فرع تمكين بأجواء راقية واحترافية.
                        </div>
                        <a href="{{ route('salon.create') }}" class="book-btn" target="_blank"  style="direction: ltr;margin: 0 0 24px 0; background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%); color: #fff; border: none; border-radius: 30px; padding: 13px 44px; font-size: 1.13rem; font-weight: bold; box-shadow: 0 4px 18px #bc9a6930; cursor: pointer; transition: all 0.22s; font-family: 'IBM Plex Sans Arabic', sans-serif !important; display: flex; align-items: center; gap: 10px; position: relative; overflow: hidden;">
                            <span class="icon-move" style="display: flex; align-items: center; transition: transform 0.22s;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#fff" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                            </span>
                            {{ __('messagess.book_now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        
          <!-- كارد فرع الضيافة -->
        <div class="col-12 col-md-4">
            <div class="card text-center shadow h-100 border-0">
                <div class="card-body">
                  <div class="service-card" style="text-align: center;width: 350px;border-radius: 22px;overflow: hidden;box-shadow: 0 6px 32px #bc9a6920, 0 1.5px 8px #0001;background: #fff;display: flex;flex-direction: column;align-items: center;transition: box-shadow 0.3s, transform 0.3s;opacity: 0;transform: translateY(40px);animation: cardFadeIn 0.8s cubic-bezier(.4,1.6,.6,1) 0.2s forwards;">
                    <div style="width: 100%; height: 180px; overflow: hidden; border-radius: 22px 22px 0 0; box-shadow: 0 2px 16px #bc9a6940 inset;">
                      <img src="{{ asset('images/avs1.webp') }}" alt="الضيافة" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                    <div style="padding: 20px 20px 6px 20px;width: 100%;text-align: center;font-size: 1.3rem;font-weight: bold;color: #222;font-family: 'IBM Plex Sans Arabic', sans-serif !important;letter-spacing: 0.5px;">
                {{ __('messagess.hospitality_branch') }}
                    </div>
                    <div style=";padding: 0 20px 12px 20px; width: 100%; text-align: right; font-size: 1.05rem; color: #7a6c5c; font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
                      استمتعي بتجربة فريدة في فرع الضيافة مع أفضل خدمات العناية والجمال.
                    </div>
                    <a href="{{ route('salon.create') }}" target="_blank" class="book-btn" style="direction: ltr;margin: 0 0 24px 0; background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%); color: #fff; border: none; border-radius: 30px; padding: 13px 44px; font-size: 1.13rem; font-weight: bold; box-shadow: 0 4px 18px #bc9a6930; cursor: pointer; transition: all 0.22s; font-family: 'IBM Plex Sans Arabic', sans-serif !important; display: flex; align-items: center; gap: 10px; position: relative; overflow: hidden;">
                      <span class="icon-move" style="display: flex; align-items: center; transition: transform 0.22s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#fff" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                      </span>
                      {{ __('messagess.book_now') }}
                    </a>
                    </div>
                </div>
            </div>
        </div>
        
  <!-- كارد الخدمات المنزلية -->
          <div class="col-12 col-md-4">
            <div class="card text-center shadow h-100 border-0"> 
                <div class="card-body">
                  <div class="service-card" style="text-align: center;width: 350px;border-radius: 22px;overflow: hidden;box-shadow: 0 6px 32px #bc9a6920, 0 1.5px 8px #0001;background: #fff;display: flex;flex-direction: column;align-items: center;transition: box-shadow 0.3s, transform 0.3s;opacity: 0;transform: translateY(40px);animation: cardFadeIn 0.8s cubic-bezier(.4,1.6,.6,1) 0.2s forwards;">
                    <div style="width: 100%; height: 180px; overflow: hidden; border-radius: 22px 22px 0 0; box-shadow: 0 2px 16px #bc9a6940 inset;">
                      <img src="{{ asset('images/s3.jpg') }}" alt="الخدمات المنزلية" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                    <div style="padding: 20px 20px 6px 20px;width: 100%;text-align: center;font-size: 1.3rem;font-weight: bold;color: #222;font-family: 'IBM Plex Sans Arabic', sans-serif !important;letter-spacing: 0.5px;">
                        {{ __('messagess.home_services') }}
                    </div>
                    <div style="padding: 0 20px 12px 20px; width: 100%; text-align: right; font-size: 1.05rem; color: #7a6c5c; font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
                      راحة ورفاهية في بيتك مع خدماتنا المنزلية المتنوعة من خبراء التجميل.
                    </div>
                    <a  href="{{ route('home.create') }}" target="_blank"  class="book-btn" style="direction: ltr;margin: 0 0 24px 0; background: linear-gradient(90deg, #bc9a69 60%, #e2c89c 100%); color: #fff; border: none; border-radius: 30px; padding: 13px 44px; font-size: 1.13rem; font-weight: bold; box-shadow: 0 4px 18px #bc9a6930; cursor: pointer; transition: all 0.22s; font-family: 'IBM Plex Sans Arabic', sans-serif !important; display: flex; align-items: center; gap: 10px; position: relative; overflow: hidden;">
                      <span class="icon-move" style="display: flex; align-items: center; transition: transform 0.22s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#fff" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                      </span>
                        {{ __('messagess.book_now') }}
                        </a>
                  </div>
                </div>
                    </a>
                    </div>
                </div>
            </div>
        </div>
</div>


