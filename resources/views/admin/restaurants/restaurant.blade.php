
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
        <link rel="shortcut icon" href="../assets/img/favicons/favicon.png" />
        <link rel="apple-touch-icon" href="../assets/img/favicons/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../assets/img/favicons//apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../assets/img/favicons/apple-touch-icon-114x114.png" />

        <!-- Title -->
        <title>YourErrandsGuy - Restaurant</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Data Table CSS -->
        <link href="../assets/css/datatables.min.css" rel="stylesheet">

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <!-- Custom CSS -->
        <link href="../assets/css/style.css" rel="stylesheet">
        <link href="../assets/css/responsive.css" rel="stylesheet">

    </head>
    <body class="dashboard">
        <section class="main-content flex-grow-1">
            <div class="p-0 h-100 d-flex align-items-stretch">
                
                <div class="sidebar offcanvas-md offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header d-flex justify-content-md-center justify-content-between my-4 align-items-center">
                        <div class="text-center d-flex d-md-block align-items-center">
                            <div class="top-logo text-center mx-md-auto mb-md-1">
                                <img src="../assets/img/logo.png" alt="Kero">
                            </div>
                            <h4 class="text-body-primary">YourErrandsGuy</h4>
                        </div>
                        <button type="button" class="btn-close text-light d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    
                    <div class="top-sidebar">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="../index.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-house"></i>       
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <li>
                                <a href="../orders/" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-list"></i>      
                                    <p>Orders</p>
                                </a>
                            </li>

                            <li>
                                <a href="../customers/" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Customer</p>
                                </a>
                            </li>

                            <li>
                                <a href="../analytics.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-chart-line"></i>   
                                    <p>Analytics</p>
                                </a>
                            </li>

                            <li>
                                <a href="../reviews.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-star"></i>     
                                    <p>Reviews</p>
                                </a>
                            </li>

                            <li>
                                <a href="../foods.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-star"></i>     
                                    <p>Foods</p>
                                </a>
                            </li>

                            <li>
                                <a href="../dispatchers.html" class="d-flex align-items-center gap-4">
                                    <i class="fa-solid fa-truck"></i>     
                                    <p>Dispatcher</p>
                                </a>
                            </li>

                            <li>
                                <a href="../restaurants" class="d-flex align-items-center gap-4 active">
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
                            <img src="./../assets/img/user.png" class="rounded-circle" alt="" height="46" width="46">
                            <div class="">
                                <p class="">Admin</p>
                                <p class="fw-semibold fs-5">Sheriff</p>
                            </div>
                        </div>
                    </div>
                

                    <h5 class="headline-small mb-1 pt-4">Restaurant Details</h5>
                    <p class="label-medium mb-4">Restaurant ID #675895</p>

                    <div class="row gap-4">
                        <div class="col-12">
                            <div class="rounded-col">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="global-img profile-pic">
                                        <img src="../assets/img/user.png" alt="" class="img-thumbnail border-0">
                                    </div>
                                    <div class="">
                                        <div class="d-flex gap-2 align-items-center">
                                            <h3 class="text-p fw-bold">Iya Rerunner Restaurant</h3>
                                            <span><img src="../assets/img/svg/Star 4.svg" alt="">4</span>
                                        </div>
                                        <div class="d-md-flex gap-md-3">
                                            <div class="d-flex gap-2 my-1">
                                                <i class="fa-solid fa-envelope caption-larger text-p"></i>
                                                <p class="caption-larger">codewithemperor@gmai.com</p>
                                            </div>
                                            <div class="d-flex gap-2 my-1">
                                                <i class="fa-solid fa-phone caption-larger text-p"></i>
                                                <p class="caption-larger">+234 805 419 4279</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <i class="fa-solid fa-location-dot caption-larger text-p"></i>
                                            <p class="caption-larger">Street 11, Rumuokoro Road, Rumuokoro, Port Harcourt.</p>
                                        </div>

                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row flex-row-reverse gy-4">
                                <div class="col-md-3">
                                    <div class="row row-cols-2 row-cols-md-1 gy-4">
        
                                        <div class="col">
                                            <div class="dashboard-card">
                                                <p class="dashboard-card_subtitle">No of Sales</p>
                                                <p class="dashboard-card_title">0</p>
                                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>0</span></p>
        
                                            </div>
                                        </div>
        
                                        <div class="col">
                                            <div class="dashboard-card">
                                                <p class="dashboard-card_subtitle">Total Income</p>
                                                <p class="dashboard-card_title">₦77k</p>
                                                <p class="dashboard-card_subtitle small">vs last 24hrs: <span>₦0.00</span></p>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="rounded-col">
                                        <p class="headline-small">Restaurant Sales</p>
                                        <div class="mt-4">
                                            <!-- Dropdown to select time period -->
                                            <select id="timePeriod" class="form-select mb-4">
                                                <option value="week">Week</option>
                                                <option value="month">Month</option>
                                                <option value="year">Year</option>
                                            </select>
                                            <!-- Canvas for the chart -->
                                            <canvas id="salesChart" width="400" height="400"></canvas>
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
        <script src="../assets/js/datatables.min.js"></script>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Custom JS -->
        <script src="../assets/js/main.js"></script>
        <script>
            $(document).ready(function() {
                // Data for the chart
                const salesData = {
                    week: {
                        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                        data: [12000, 15000, 18000, 20000, 25000, 30000, 28000],
                        backgroundColor: 'rgba(0, 168, 89, 0.2)', // Lighter green for week
                        borderColor: '#00a859', // Solid green for border
                        borderWidth: 1
                    },
                    month: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        data: [80000, 95000, 110000, 105000],
                        backgroundColor: 'rgba(253, 205, 17, 0.2)', // Lighter yellow for month
                        borderColor: '#fdcd11', // Solid yellow for border
                        borderWidth: 1
                    },
                    year: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        data: [300000, 320000, 350000, 340000, 360000, 380000, 400000, 410000, 420000, 430000, 440000, 450000],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Lighter teal for year
                        borderColor: 'rgba(75, 192, 192, 1)', // Solid teal for border
                        borderWidth: 1
                    }
                };

                // Get the canvas element
                const ctx = document.getElementById('salesChart').getContext('2d');

                // Initialize the chart with default data (week)
                const salesChart = new Chart(ctx, {
                    type: 'bar', // Use 'line' for a line chart
                    data: {
                        labels: salesData.week.labels,
                        datasets: [{
                            label: 'Amount Made (₦)',
                            data: salesData.week.data,
                            backgroundColor: salesData.week.backgroundColor,
                            borderColor: salesData.week.borderColor,
                            borderWidth: salesData.week.borderWidth
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Amount (₦)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Time Period'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Weekly Sales Report'
                            }
                        }
                    }
                });

                // Add event listener to the dropdown
                document.getElementById('timePeriod').addEventListener('change', function() {
                    const selectedPeriod = this.value;

                    // Update chart data based on the selected period
                    salesChart.data.labels = salesData[selectedPeriod].labels;
                    salesChart.data.datasets[0].data = salesData[selectedPeriod].data;
                    salesChart.data.datasets[0].backgroundColor = salesData[selectedPeriod].backgroundColor;
                    salesChart.data.datasets[0].borderColor = salesData[selectedPeriod].borderColor;

                    // Update the chart title
                    salesChart.options.plugins.title.text = `${selectedPeriod.charAt(0).toUpperCase() + selectedPeriod.slice(1)} Sales Report`;

                    // Update the chart
                    salesChart.update();
                });
            });
        </script>
    </body>
</html>