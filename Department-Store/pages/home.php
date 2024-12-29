<main class="app-main">
  <div class="container-fluid bg-light">
    <section id="dashboard" class="mt-4 mb-5">
      <div class="row">
        <div class="col-12 mb-3">
          <h4 class="text-uppercase fw-bold text-primary">Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <!-- Total Sell Card -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card shadow-sm rounded-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-cash-coin text-success fs-1"></i>
                <a href="#" class="text-muted d-block mt-2">Show Details</a>
              </div>
              <div class="text-right">
                <h5 class="fw-semibold text-dark">Total Sell</h5>
                <h4 class="text-success fw-bold">$00.00</h4>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Cost Card -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card shadow-sm rounded-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-cash-coin text-warning fs-1"></i>
                <a href="#" class="text-muted d-block mt-2">Show Details</a>
              </div>
              <div class="text-right">
                <h5 class="fw-semibold text-dark">Total Cost</h5>
                <h4 class="text-warning fw-bold">$00.00</h4>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Profit Card -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card shadow-sm rounded-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-cash-stack text-primary fs-1"></i>
                <a href="#" class="text-muted d-block mt-2">Show Details</a>
              </div>
              <div class="text-right">
                <h5 class="fw-semibold text-dark">Total Profit</h5>
                <h4 class="text-primary fw-bold">$00.00</h4>
              </div>
            </div>
          </div>
        </div>

        <!-- Today Sell Card -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="card shadow-sm rounded-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-calendar-check text-info fs-1"></i>
                <a href="#" class="text-muted d-block mt-2">Show Details</a>
              </div>
              <div class="text-right">
                <h5 class="fw-semibold text-dark">Today Sell</h5>
                <h4 class="text-info fw-bold">$00.00</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<style>
  .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .card-body {
    padding: 20px;
  }
  .card .text-right {
    text-align: right;
  }
  .text-muted {
    color: #6c757d;
  }
  .text-dark {
    color: #343a40;
  }
  .text-primary {
    color: #007bff;
  }
  .text-success {
    color: #28a745;
  }
  .text-warning {
    color: #ffc107;
  }
  .text-info {
    color: #17a2b8;
  }
  .bi {
    font-size: 2.5rem;
  }
  .fw-bold {
    font-weight: 700;
  }
  .fw-semibold {
    font-weight: 600;
  }
  .mt-2 {
    margin-top: 10px;
  }
</style>


    <!-- Additional Information Section -->
    <section>
      <div class="row">
        <!-- Total Medicine -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="d-flex justify-content-around align-items-center p-3" style="background-color:rgb(78, 37, 3); border-radius: 15px;">
            <div>
              <i class="bi bi-bag-heart text-info-emphasis fs-1 d-block px-3 py-2 bg-light rounded-circle"></i>
            </div>
            <div class="d-flex flex-column align-items-center">
              <h4 class="fw-semibold text-white">Total Product</h4>
              <h2 class="text-center text-white">55</h2>
              <a href="#" class="text-info">Show Details</a>
            </div>
          </div>
        </div>

        <!-- Out of Stock -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="d-flex justify-content-around align-items-center p-3" style="background-color:rgb(78, 37, 3); border-radius: 15px;">
            <div>
              <i class="bi bi-cart-x text-warning-emphasis fs-1 d-block px-3 py-2 bg-light rounded-circle"></i>
            </div>
            <div class="d-flex flex-column align-items-center">
              <h4 class="fw-semibold text-white">Out of Stock</h4>
              <h2 class="text-center text-white">00</h2>
              <a href="#" class="text-info">Show Details</a>
            </div>
          </div>
        </div>

        <!-- Expired Medicine -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="d-flex justify-content-around align-items-center p-3" style="background-color:rgb(78, 37, 3); border-radius: 15px;">
            <div>
              <i class="bi bi-exclamation-triangle text-danger fs-1 d-block px-3 py-2 bg-light rounded-circle"></i>
            </div>
            <div class="d-flex flex-column align-items-center">
              <h4 class="fw-semibold text-white">Expired Medicine</h4>
              <h2 class="text-center text-white">00</h2>
              <a href="#" class="text-info">Show Details</a>
            </div>
          </div>
        </div>

        <!-- Due Customer -->
        <div class="col-xl-3 col-sm-6 col-12 mb-4">
          <div class="d-flex justify-content-around align-items-center p-3" style="background-color:rgb(78, 37, 3); border-radius: 15px;">
            <div>
              <i class="bi bi-person-exclamation text-primary-emphasis fs-1 d-block px-3 py-2 bg-light rounded-circle"></i>
            </div>
            <div class="d-flex flex-column align-items-center">
              <h4 class="fw-semibold text-white">Due Customer</h4>
              <h2 class="text-center text-white">00</h2>
              <a href="#" class="text-info">Show Details</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<!-- Add Bootstrap JS and dependencies (Optional for functionality like tooltips or modals) -->

