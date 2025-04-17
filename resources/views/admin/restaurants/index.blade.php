
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta tag -->
        <meta charset="UTF-8">
        <meta name="author" content="" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <!-- favicon -->
        <link rel="shortcut icon" href="assets/img/favicons/favicon.png" />
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons//apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-touch-icon-114x114.png" />

        <!-- Title -->
        <title>YourErrandsGuy - Dashboard</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Data Table CSS -->
        <link href="assets/css/datatables.min.css" rel="stylesheet">

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <!-- Custom CSS -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/responsive.css" rel="stylesheet">

    </head>
    <body class="dashboard">
        <section class="main-content flex-grow-1">
            <div class="p-0 h-100 d-flex align-items-stretch">

                <div class="sidebar offcanvas-md offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header d-flex justify-content-md-center justify-content-between my-4 align-items-center">
                        <div class="text-center d-flex d-md-block align-items-center">
                            <div class="top-logo text-center mx-md-auto mb-md-1">
                                <img src="assets/img/logo.png" alt="Kero">
                            </div>
                            <h4 class="text-body-primary">YourErrandsGuy</h4>
                        </div>
                        <button type="button" class="btn-close text-light d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>

                    <div class="top-sidebar">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="dashboard" class="d-flex align-items-center gap-4 ">
                                    <i class="fa-solid fa-house"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <li>
                                <a href="orders" class="d-flex align-items-center gap-4 ">
                                    <i class="fa-solid fa-list"></i>
                                    <p>Orders</p>
                                </a>
                            </li>

                            <li>
                                <a href="customers" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Customer</p>
                                </a>
                            </li>

                            <li>
                                <a href="analytics.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <p>Analytics</p>
                                </a>
                            </li>

                            <li>
                                <a href="reviews.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-star"></i>
                                    <p>Reviews</p>
                                </a>
                            </li>

                            <li>
                                <a href="foods" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-bowl-food"></i>
                                    <p>Foods</p>
                                </a>
                            </li>

                            <li>
                                <a href="dispatchers.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-truck"></i>
                                    <p>Dispatcher</p>
                                </a>
                            </li>

                            <li>
                                                                <a href="restaurants" class="d-flex align-items-center gap-4 active">
                                        <i class="fa-solid fa-utensils"></i>
                                        <p>Vendor</p>
                                    </a>
                            </li>

                            <li>
                                <a href="#" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-comment-dots"></i>
                                    <p>Chat</p>
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>

                <div class="dashboard-content p-3 p-md-4">

                    <div class="top-bar d-flex flex-row-reverse flex-md-row gap-4 justify-content-between">

                        <input type="search" class="d-none d-md-flex form-control" name="search" placeholder="Search" id="">
                        <hr class="d-none d-md-flex"/>
                        <div class="d-flex gap-3">
                            <a href="#" class="badge-con d-none d-md-flex">
                                <i class="fa-solid fa-bell"></i>
                                <span class="badge">92</span>
                            </a>
                            <a href="#" class="badge-con d-none d-md-flex">
                                <i class="fa-solid fa-comment-dots"></i>
                                <span class="badge">5</span>
                            </a>
                            <a href="#" class="badge-con d-none d-md-flex">
                                <i class="fa-solid fa-gear"></i>
                                <span class="badge">76</span>
                            </a>
                            <button class="d-flex justify-content-center align-items-center d-md-none toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive" >
                                <i class="fa-solid fa-bars-staggered"></i>
                            </button>

                        </div>
                        <hr  />
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <img src="./assets/img/user.png" class="rounded-circle" alt="" height="46" width="46">
                            <div class="">
                                <p class="">Admin</p>
                                <p class="fw-semibold fs-5">Sheriff</p>
                            </div>
                        </div>
                    </div>


                    <h5 class="headline-small pt-4 mb-3">Vendors List</h5>

                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                        Add Vendor
                    </button>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="rounded-col table-responsive">
                                <table class="table table-hover" id="ride">
                                    <thead>
                                        <tr class="table-light text-center">
                                            <th>Restaurant Name</th>
                                            <th>Location</th>
                                            <th>Service Type</th>
                                            <th>Rating</th>
                                            <th>Total Sales</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($restaurants as $restaurant)
                                        <tr onclick="window.location.href='{{ route('admin.restaurants.show', $restaurant->id) }}'" style="cursor:pointer">
                                            <td>{{ $restaurant->name }}</td>
                                            <td>{{ $restaurant->address }}</td>
                                            <td>{{ $restaurant->service_type }}</td>
                                            <td><img src="../assets/img/svg/Star 4.svg" alt="">4</td>
                                            <td>389</td>
                                            <td>₦341,000.00</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                   <!-- Add Vendor Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('admin.restaurants.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addVendorModalLabel">Add Vendor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="vendorName" class="form-label">Vendor Name</label>
              <input type="text" class="form-control" id="vendorName" name="name" required>
            </div>
            <div class="mb-3">
                <label for="vendorEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="vendorEmail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="vendorPhone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="vendorPhone" name="phone" required>
              </div>
            <div class="mb-3">
              <label for="vendorAddress" class="form-label">Location</label>
              <input type="text" class="form-control" id="vendorAddress" name="address" required>
            </div>
            <div class="mb-3">
                <label for="vendorDescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="vendorDescription" name="description" required>
              </div>
            <div class="mb-3">
              <label for="serviceType" class="form-label">Service Type</label>
              <select class="form-select" id="serviceType" name="service_type" required>
                <option value="">Select service type</option>
                <option value="restaurant">Restaurant</option>
                <option value="laundry">Laundry</option>
                <option value="shopping mall">Shopping Mall</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary mb-3">Add Vendor</button>
          </div>
        </div>
      </form>
    </div>
  </div>


                    <!-- jQuery -->
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

                    <!-- Chart JS -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <!-- Data Table JS-->
                    <script src="assets/js/datatables.min.js"></script>

                    <!-- Swiper JS -->
                    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

                    <!-- Custom JS -->
                    <script src="assets/js/main.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const swiper = new Swiper('.swiper', {
                                slidesPerView: 3,
                                spaceBetween: 20,
                                loop: true,
                                autoplay: {
                                    delay: 3000,
                                    disableOnInteraction: false,
                                },
                                breakpoints: {
                                    320: {
                                        slidesPerView: 1,
                                    },
                                    768: {
                                        slidesPerView: 2,
                                    },
                                    992: {
                                        slidesPerView: 3,
                                    },
                                },
                            });
                        });
                    </script>
                               </div>
        </section>

        <!-- Modal -->


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Chart JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Data Table JS-->
        <script src="assets/js/datatables.min.js"></script>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Custom JS -->
        <script src="assets/js/main.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const swiper = new Swiper('.swiper', {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        // Responsive breakpoints
                        320: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                        },
                        992: {
                            slidesPerView: 3,
                        },
                    },
                });
            });
        </script>

    </body>
</html>
