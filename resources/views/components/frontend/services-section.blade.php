<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<section class="py-5">
    <div class="container" style="padding: 0 5rem;">
        <h2 class="mb-5 text-center" style="color: var(--primary-color); font-size: 2.5rem; font-weight: bold;">
            Our Service Categories
        </h2>

        @if(isset($categories) && $categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $index => $category)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        @include('components.frontend.category-card', [
                            'image' => asset('images/frontend/slider' . (($index % 3) + 1) . '.webp'),
                            'name' => $category->name,
                            'description' => Str::limit($category->description ?? 'Explore our ' . $category->name . ' services', 100),
                            'services_count' => $category->services ? $category->services->count() : 0,
                            'price_range' => $category->services && $category->services->count() > 0 && $category->services->whereNotNull('default_price')->count() > 0 ?
                                'SR ' . number_format($category->services->whereNotNull('default_price')->min('default_price'), 2) . ' - SR ' . number_format($category->services->whereNotNull('default_price')->max('default_price'), 2) :
                                'Contact for pricing',
                            'category_id' => $category->id
                        ])
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No service categories available at the moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- Pricing Modal -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="pricingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pricingModalLabel">Category Services & Pricing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <div id="pricingTable">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading services...</p>
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
        <h5 class="modal-title" id="serviceDetailsModalLabel">Service Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="serviceDetailsContent">
          <div class="text-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading service details...</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Book This Service</button>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once: true
  });

  // Function to show category services in pricing modal
  function showCategoryServices(categoryId) {
    const modal = new bootstrap.Modal(document.getElementById('pricingModal'));
    const contentDiv = document.getElementById('pricingTable');

    // Show loading state
    contentDiv.innerHTML = `
      <div class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading services...</p>
      </div>
    `;

    modal.show();

    // Fetch category services from API
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
                <td>${service.category ? service.category.name : 'General'}</td>
                <td>${parseFloat(service.default_price).toFixed(2)}</td>
                <td>${service.duration_min}</td>
              </tr>
            `;
          });

          contentDiv.innerHTML = `
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Service</th>
                  <th>Category</th>
                  <th>Price (SR)</th>
                  <th>Duration (minutes)</th>
                </tr>
              </thead>
              <tbody>
                ${tableRows}
              </tbody>
            </table>
          `;
        } else {
          contentDiv.innerHTML = `
            <div class="text-center text-muted">
              <p>No services available in this category.</p>
            </div>
          `;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        contentDiv.innerHTML = `
          <div class="text-center text-danger">
            <p>Error loading services. Please try again.</p>
          </div>
        `;
      });
  }

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

        // Reset modal content
        const contentDiv = document.getElementById('pricingTable');
        if (contentDiv) {
          contentDiv.innerHTML = `
            <div class="text-center">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <p class="mt-2">Loading services...</p>
            </div>
          `;
        }
      });
    }
  });

  // Function to show service details
  function showServiceDetails(serviceId) {
    const modal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));
    const contentDiv = document.getElementById('serviceDetailsContent');

    // Show loading state
    contentDiv.innerHTML = `
      <div class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading service details...</p>
      </div>
    `;

    modal.show();

    // Fetch service details from API
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
                <p class="text-muted mb-3">${service.description || 'No description available.'}</p>
                <div class="row mb-3">
                  <div class="col-6">
                    <strong>Price:</strong><br>
                    <span class="text-primary h5">SR ${parseFloat(service.default_price).toFixed(2)}</span>
                  </div>
                  <div class="col-6">
                    <strong>Duration:</strong><br>
                    <span class="text-muted">${service.duration_min} minutes</span>
                  </div>
                </div>
                <div class="mb-3">
                  <strong>Category:</strong><br>
                  <span class="badge bg-secondary">${service.category ? service.category.name : 'General'}</span>
                </div>
                ${service.sub_category ? `
                <div class="mb-3">
                  <strong>Sub Category:</strong><br>
                  <span class="badge bg-light text-dark">${service.sub_category.name}</span>
                </div>
                ` : ''}
              </div>
            </div>
          `;
        } else {
          contentDiv.innerHTML = `
            <div class="text-center text-danger">
              <p>Error loading service details. Please try again.</p>
            </div>
          `;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        contentDiv.innerHTML = `
          <div class="text-center text-danger">
            <p>Error loading service details. Please try again.</p>
          </div>
        `;
      });
  }
</script>
