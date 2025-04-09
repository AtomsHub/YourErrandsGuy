
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
                                <a href="index.html" class="d-flex align-items-center gap-4 active">
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
                                <a href="foods.html" class="d-flex align-items-center gap-4">
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
                                                                <a href="restaurants" class="d-flex align-items-center gap-4">
                                        <i class="fa-solid fa-utensils"></i>     
                                        <p>Restaurant</p>
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
                

                    <h5 class="headline-small pt-4 mb-3">Dashboard</h5>
                    <div class="row row-cols-2 row-cols-lg-4 g-3 g-md-4">
                        <div class="col">
                            <div class="dashboard-card h-100">
                                <p class="dashboard-card_subtitle">Total Vendors</p>
                                <p class="dashboard-card_title">{{$totalVendors  }}</p>
                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>0</span></p>

                            </div>
                        </div>

                        
                        <div class="col">
                            <div class="dashboard-card">
                                <p class="dashboard-card_subtitle">Total Orders</p>
                                <p class="dashboard-card_title">{{$totalOrders  }}</p>
                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>0</span></p>

                            </div>
                        </div>

                        <div class="col">
                            <div class="dashboard-card">
                                <p class="dashboard-card_subtitle">Total Customers</p>
                                <p class="dashboard-card_title">{{$totalCustomers  }}</p>
                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>0</span></p>

                            </div>
                        </div>

                        <div class="col">
                            <div class="dashboard-card">
                                <p class="dashboard-card_subtitle">Total Income</p>
                                <p class="dashboard-card_title">₦0.00</p>
                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>₦0.00</span></p>

                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mt-4">
                        
                        <div class="col-md-6">
                            <div class="rounded-col">
                                <p class="headline-small">Order Chart</p>
                                <div class="mt-4">
                                    <canvas id="singleValueChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="rounded-col">
                                <p class="headline-small">Customer Chart</p>
                                <div class="mt-4">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="rounded-col">
                                <p class="headline-small">Earning Overview</p>
                                <div class="mt-4 d-flex gap-5">
                                    <div class="earning-card">
                                        <p class="caption-large">Income</p>
                                        <p class="title-medium">₦124k</p>
                                    </div>
                                    <div class="earning-card two">
                                        <p class="caption-large">Income</p>
                                        <p class="title-medium">₦124k</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <canvas id="incomePayoutChart"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-4 mt-4">

                        <div class="col">
                            <div class="rounded-col">
                                <p class="headline-small">Customer Review</p>
                                <div class="mt-4">

                                    <!-- Swiper Container -->
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            <!-- Swiper Slides -->
                                            <div class="swiper-slide">
                                                <div class="card review">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <img src="assets/img/user.png" alt="" height="40" width="40">
                                                            <div class="">
                                                                <h5 class="card-title">Shola John</h5>
                                                                <h6 class="card-subtitle">2 days ago</h6>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add more slides -->
                                            <div class="swiper-slide">
                                                <div class="card review">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <img src="assets/img/user.png" alt="" height="40" width="40">
                                                            <div class="">
                                                                <h5 class="card-title">Jane Doe</h5>
                                                                <h6 class="card-subtitle">3 days ago</h6>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">Another example of card content.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="card review">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <img src="assets/img/user.png" alt="" height="40" width="40">
                                                            <div class="">
                                                                <h5 class="card-title">Jane Doe</h5>
                                                                <h6 class="card-subtitle">3 days ago</h6>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">Another example of card content.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="swiper-slide">
                                                <div class="card review">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center gap-3 mb-3">
                                                            <img src="assets/img/user.png" alt="" height="40" width="40">
                                                            <div class="">
                                                                <h5 class="card-title">Jane Doe</h5>
                                                                <h6 class="card-subtitle">3 days ago</h6>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">Another example of card content.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Repeat as needed -->
                                        </div>
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    


                    
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