<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    body{
font-family: 'IBM Plex Sans Arabic', sans-serif !important;
}
</style>
<section class="py-5">
    <div class="container" style="padding: 0 5rem;font-family: 'IBM Plex Sans Arabic', sans-serif !important;">
        <h2 class="mb-5 mt-3 text-center" style="font-size: 45px;color: var(--primary-color);font-weight: bold;">
            {{ __('messagess.our_service_categories') }}
        </h2>
<div style="display: flex; align-items: center; justify-content: center; width: 100%; margin: 30px 0 45px;">
  <div style="height: 2px; width: 50px; background: #bc9a69; border-radius: 2px;"></div>
  <div style="margin: 0 10px; color: #bc9a69; font-size: 25px;">
    &#10048;
  </div>
  <div style="height: 2px; width: 50px; background: #bc9a69; border-radius: 2px;"></div>
</div>
        @if(isset($categories) && $categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $index => $category)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        @include('components.frontend.category-card', [
                            'image' => asset('images/frontend/slider' . (($index % 3) + 1) . '.webp'),
                            'name' => $category->name,
                            'price_range' => $category->services && $category->services->count() > 0 && $category->services->whereNotNull('default_price')->count() > 0 ?
                                'SR ' . number_format($category->services->whereNotNull('default_price')->min('default_price'), 2) . ' - SR ' . number_format($category->services->whereNotNull('default_price')->max('default_price'), 2) :
                                __('messagess.contact_for_pricing'),
                            'category_id' => $category->id
                        ])
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">{{ __('messagess.no_service_categories') }}</p>
            </div>
        @endif
    </div>
</section>

<!-- Pricing Modal -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pricingModalLabel">{{ __('messagess.category_services_pricing') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messagess.close') }}"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <div id="pricingTable">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('messagess.loading_services') }}</span>
                        </div>
                        <p class="mt-2">{{ __('messagess.loading_services') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Details Modal -->
<div class="modal fade" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceDetailsModalLabel">{{ __('messagess.service_details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messagess.close') }}"></button>
            </div>
            <div class="modal-body">
                <div id="serviceDetailsContent">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('messagess.loading_service_details') }}</span>
                        </div>
                        <p class="mt-2">{{ __('messagess.loading_service_details') }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messagess.close') }}</button>
                <button type="button" class="btn btn-primary">{{ __('messagess.book_this_service') }}</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });

    function showCategoryServices(categoryId) {
        const modal = new bootstrap.Modal(document.getElementById('pricingModal'));
        const contentDiv = document.getElementById('pricingTable');

        contentDiv.innerHTML = `
      <div class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">{{ __('messagess.loading_services') }}</span>
        </div>
        <p class="mt-2">{{ __('messagess.loading_services') }}</p>
      </div>
    `;

        modal.show();

        fetch(`/api/v1/services?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status && data.data && data.data.length > 0) {
                    const services = data.data;
                    let tableRows = '';

                    services.forEach(service => {
                        tableRows += `
              <tr>
                <td>${service.name}</td>
                <td>${service.category ? service.category.name : '{{ __('messagess.general') }}'}</td>
                <td>${parseFloat(service.default_price).toFixed(2)}</td>
                <td>${service.duration_min}</td>
              </tr>
            `;
                    });

                    contentDiv.innerHTML = `
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>{{ __('messagess.service') }}</th>
                  <th>{{ __('messagess.category') }}</th>
                  <th>{{ __('messagess.price') }}</th>
                  <th>{{ __('messagess.duration') }}</th>
                </tr>
              </thead>
              <tbody>
                ${tableRows}
              </tbody>
            </table>
          `;
                } else {
                    contentDiv.innerHTML = `<div class="text-center text-muted"><p>{{ __('messagess.no_services_available') }}</p></div>`;
                }
            })
            .catch(() => {
                contentDiv.innerHTML = `<div class="text-center text-danger"><p>{{ __('messagess.error_loading_services') }}</p></div>`;
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const pricingModal = document.getElementById('pricingModal');

        if (pricingModal) {
            pricingModal.addEventListener('hidden.bs.modal', function () {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.paddingRight = '';
                document.body.style.overflow = '';

                const contentDiv = document.getElementById('pricingTable');
                if (contentDiv) {
                    contentDiv.innerHTML = `
            <div class="text-center">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">{{ __('messagess.loading_services') }}</span>
              </div>
              <p class="mt-2">{{ __('messagess.loading_services') }}</p>
            </div>
          `;
                }
            });
        }
    });

    function showServiceDetails(serviceId) {
        const modal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));
        const contentDiv = document.getElementById('serviceDetailsContent');

        contentDiv.innerHTML = `
      <div class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">{{ __('messagess.loading_service_details') }}</span>
        </div>
        <p class="mt-2">{{ __('messagess.loading_service_details') }}</p>
      </div>
    `;

        modal.show();

        fetch(`/api/v1/services/${serviceId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status && data.data) {
                    const service = data.data;
                    contentDiv.innerHTML = `
            <div class="row">
              <div class="col-md-6">
                <img src="${service.feature_image}" alt="${service.name}" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
              </div>
              <div class="col-md-6">
                <h4 class="text-primary mb-3">${service.name}</h4>
                <p class="text-muted mb-3">${service.description || '{{ __('messagess.no_description_available') }}'}</p>
                <div class="row mb-3">
                  <div class="col-6">
                    <strong>{{ __('messagess.price_label') }}</strong><br>
                    <span class="text-primary h5">SR ${parseFloat(service.default_price).toFixed(2)}</span>
                  </div>
                  <div class="col-6">
                    <strong>{{ __('messagess.duration_label') }}</strong><br>
                    <span class="text-muted">${service.duration_min} {{ __('messagess.minutes') }}</span>
                  </div>
                </div>
                <div class="mb-3">
                  <strong>{{ __('messagess.category') }}</strong><br>
                  <span class="badge bg-secondary">${service.category ? service.category.name : '{{ __('messagess.general') }}'}</span>
                </div>
                ${service.sub_category ? `
                <div class="mb-3">
                  <strong>{{ __('messagess.sub_category') }}</strong><br>
                  <span class="badge bg-light text-dark">${service.sub_category.name}</span>
                </div>` : ''}
              </div>
            </div>
          `;
                } else {
                    contentDiv.innerHTML = `<div class="text-center text-danger"><p>{{ __('messagess.error_loading_services') }}</p></div>`;
                }
            })
            .catch(() => {
                contentDiv.innerHTML = `<div class="text-center text-danger"><p>{{ __('messagess.error_loading_services') }}</p></div>`;
            });
    }
</script>
