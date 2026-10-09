
<div class="container-xxl flex-grow-1 container-p-y">
          
  <div class="row">
    <div class="col-xxl-8 mb-6 order-0">
      <div class="card">
        <div class="d-flex align-items-start row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary mb-3">Welcome back, {{ session('username') }} ! 👋</h5>
              <p class="mb-6">Your dashboard is up to date.<br> Keep up the great leadership!</p>

              <a href="javascript:0;" class="btn btn-sm btn-label-primary ajax-link" data-url="profile">Your Profile</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-6">
              <img src="{{ asset('assets/img/man-with-laptop.png') }}" height="175" class="scaleX-n1-rtl" alt="View Badge User" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xxl-4 col-lg-12 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-6 mb-6">
          <div class="card h-100">
            <div class="card-body pb-4">
              <span class="d-block fw-medium mb-1">Orders Month</span>
              <h4 class="card-title mb-0" id="totalOrders"></h4>
            </div>
            <div id="orderChart" class="pb-3 pe-1"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
   {{--  <div class="col-12 col-xxl-12 order-2 order-md-3 order-xxl-2 mb-6">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-lg-8">
            <div class="card-header d-flex align-items-center justify-content-between">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Total Revenue</h5>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="totalRevenue" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-base bx bx-dots-vertical-rounded icon-lg text-body-secondary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                  <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                </div>
              </div>
            </div>
            <div id="totalRevenueChart" class="px-3"></div>
          </div>
          <div class="col-lg-4">
            <div class="card-body px-xl-9 py-12 d-flex align-items-center flex-column">
              <div class="text-center mb-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-label-primary">
                    <script>
                      document.write(new Date().getFullYear() - 1);
                    </script>
                  </button>
                  <button type="button" class="btn btn-label-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0);">2021</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">2020</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">2019</a></li>
                  </ul>
                </div>
              </div>

              <div id="growthChart"></div>
              <div class="text-center fw-medium my-6">62% Company Growth</div>

              <div class="d-flex gap-11 justify-content-between">
                <div class="d-flex">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded-2 bg-label-primary"><i class="icon-base bx bx-dollar icon-lg text-primary"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>
                      <script>
                        document.write(new Date().getFullYear() - 1);
                      </script>
                    </small>
                    <h6 class="mb-0">$32.5k</h6>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded-2 bg-label-info"><i class="icon-base bx bx-wallet icon-lg text-info"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>
                      <script>
                        document.write(new Date().getFullYear() - 2);
                      </script>
                    </small>
                    <h6 class="mb-0">$41.2k</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!--/ Total Revenue -->

  </div>
  <div class="row">
    <div class="col-12 col-xl-8 mb-6">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Order Statistics</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="topic" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-base bx bx-dots-vertical-rounded icon-lg text-body-secondary"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
              <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
              <a class="dropdown-item" href="javascript:void(0);">See All</a>
            </div>
          </div>
        </div>
        <div class="card-body row g-3">
          <div class="col-md-8">
            <div id="horizontalBarChart"></div>
          </div>
          <div class="col-md-4 d-flex justify-content-around align-items-center">
            <div>
              <div class="d-flex align-items-baseline">
                <span class="text-primary me-2"><i class="icon-base bx bxs-circle icon-12px"></i></span>
                <div>
                  <p class="mb-0">Online Order</p>
                  <h5 id="Online Order">0%</h5>
                </div>
              </div>
              <div class="d-flex align-items-baseline my-12">
                <span class="text-success me-2"><i class="icon-base bx bxs-circle icon-12px"></i></span>
                <div>
                  <p class="mb-0">Online Payement</p>
                  <h5 id="Online Payement">0%</h5>
                </div>
              </div>

            </div>

            <div>
              <div class="d-flex align-items-baseline">
                <span class="text-info me-2"><i class="icon-base bx bxs-circle icon-12px"></i></span>
                <div>
                  <p class="mb-0">Normal Orde</p>
                  <h5 id="Normal Order">0%</h5>
                </div>
              </div>
              <div class="d-flex align-items-baseline my-12">
                <span class="text-secondary me-2"><i class="icon-base bx bxs-circle icon-12px"></i></span>
                <div>
                  <p class="mb-0">Normal Payement</p>
                  <h5 id="Normal Payement">0%</h5>
                </div>
              </div>
           
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Transactions -->
    <div class="col-12 col-xl-4 mb-6">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">Top 5 Menus</h5>
          </div>
          
        </div>
        <div class="px-5 py-4 border border-start-0 border-end-0">
          <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0 text-uppercase">Menus</p>
            <p class="mb-0 text-uppercase">Orders</p>
          </div>
        </div>
        <div class="card-body" id="top_menus">


        </div>
      </div>
    </div>
    <!--/ Transactions -->
  
  </div>
</div>


