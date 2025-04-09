
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
        <title>Kero - Dispatcher</title>

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

        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                <a href="index.html" class="d-flex align-items-center gap-4">
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
                                <a href="dispatchers.html" class="d-flex align-items-center gap-4 active">
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
                    

                    <div class="row g-4 mt-4">
                        
                        <div class="rounded-col">
                            <p class="d-inline-flex gap-3 mb-3 mt-1">
                                <button class="btn btn-p" data-bs-toggle="collapse" data-bs-target="#approvedSection" aria-expanded="true" aria-controls="approvedSection">
                                  Approved
                                </button>
                                <button class="btn btn-a-outline" data-bs-toggle="collapse" data-bs-target="#unapprovedSection" aria-expanded="false" aria-controls="unapprovedSection">
                                  Unapproved
                                </button>
                            </p>
                        </div>
  
                        <div class="rounded-col mt-4 collapse multi-collapse show" id="approvedSection">
                            <p class="headline-small text-p">Approved Dispatcher</p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="approvedDispatcher">
                                    <thead>
                                        <tr class="table-light text-center">
                                            <th>Vehicle No</th>
                                            <th>Vehicle Type</th>
                                            <th>Drivers Name</th>                                    
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>No of Dispatch</th>
                                            <th>Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-bs-toggle="modal" data-bs-target="#dispatcherModal">
                                            <td>#675895</td>
                                            <td>#675895</td>
                                            <td>Sulaimon Yusuf</td>
                                            <td>sulaimong@gmail.com</td>
                                            <td>08054194279</td>
                                            <td>5</td>
                                            <td>₦32,000.00</td>
                                        </tr>
                                                
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    
                        <div class="rounded-col mt-4 collapse multi-collapse" id="unapprovedSection">
                            <p class="headline-small text-a">Unapproved Dispatcher</p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="unApprovedDispatcher">
                                    <thead>
                                        <tr class="table-light two text-center">
                                            <th>Vehicle No</th>
                                            <th>Vehicle Type</th>
                                            <th>Drivers Name</th>                                    
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>No of Dispatch</th>
                                            <th>Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-bs-toggle="modal" data-bs-target="#dispatcherModal">
                                            <td>#675895</td>
                                            <td>#675895</td>
                                            <td>Sulaimon Yusuf</td>
                                            <td>sulaimong@gmail.com</td>
                                            <td>08054194279</td>
                                            <td>5</td>
                                            <td>₦32,000.00</td>
                                        </tr>
                                                
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                       
                    </div>
                    


                    
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="dispatcherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dispatcherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content p-3 py-5 p-md-5">
                    <div class="modal-header d-flex justify-content-between mx-1 mx-md-3 mb-3">
                        <p class="headline-small">Dispatcher</p>
                        <button type="button" class="btn-close mb-3 border rounded-md p-1" data-bs-dismiss="modal" aria-label="Close"></button>
    
                    </div>
                    
                    <div class="modal-body mx-1 mx-md-3">
                        <div class="modal-text-2 text-center">
                            <div class="modal-details-box">
                                <p class="label-medium">Vehicle No</p>
                                <p class="title-medium text-end">${driver.vehicle?.licensePlate  || 'N/A'}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Vehicle Type</p>
                                <p class="title-medium text-end">${driver.vehicle?.model || 'N/A'} ${driver.vehicle?.year || ''}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Driver Name</p>
                                <p class="title-medium text-end">
                                    <img src="assets/img/user.png" class="rounded-5" height="20" width="20" alt="">
                                    ${driver.firstname || ''} ${driver.lastname || ''}
                                </p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Email Address</p>
                                <p class="title-medium">${driver.email || 'N/A'}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Phone Number</p>
                                <p class="title-medium">${driver.phone || 'N/A'}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">No of Trip</p>
                                <p class="title-medium">${driver.tripsCount || 0}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Ratings</p>
                                <p class="title-medium text-end">
                                    <img src="assets/img/svg/Star 4.svg" alt="">
                                    ${driver.rating || 0}
                                </p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Earning</p>
                                <p class="title-medium text-end">₦${driver.earnings?.toFixed(2) || '0.00'}</p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Driver's License</p>
                                <p class="title-medium text-end viewImage">
                                    ${driver.vehicle?.driverLicense ? 
                                        `<a href="${driver.vehicle.driverLicense}" target="_blank">View Image</a>` : 
                                        'N/A'}
                                </p>
                            </div>
                            <div class="modal-details-box">
                                <p class="label-medium">Hackney Permit</p>
                                <p class="title-medium text-end viewImage">
                                    ${driver.vehicle?.hackneyPermit ? 
                                        `<a href="${driver.vehicle.hackneyPermit}" target="_blank">View Image</a>` : 
                                        'N/A'}
                                </p>
                            </div>

                            <div class="stack gap-5 text-center mt-5">
                                <button class="btn btn-p px-5 me-2" onclick="verifyDriver('${driver._id}', 'approved')">Approve</button>
                                <button class="btn btn-a px-5 ms-2" onclick="verifyDriver('${driver._id}', 'rejected')">Reject</button>
                            </div>
                        </div>
                    </div>
                            
                </div>
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

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Custom JS -->
        <script src="assets/js/main.js"></script>
        <script>
            const approvedButton = document.querySelector('button[data-bs-target="#approvedSection"]');
            const unapprovedButton = document.querySelector('button[data-bs-target="#unapprovedSection"]');
  
            const approvedSection = document.getElementById('approvedSection');
            const unapprovedSection = document.getElementById('unapprovedSection');
  
            // Function to toggle collapsibles
            const toggleSections = (showApproved) => {
              if (showApproved) {
                // Show the approved, hide the unapproved
                approvedSection.classList.add('show');
                unapprovedSection.classList.remove('show');
                approvedButton.classList.remove('btn-p-outline');
                approvedButton.classList.add('btn-p');

                unapprovedButton.classList.remove('btn-a');
                unapprovedButton.classList.add('btn-a-outline');
              } else {
                // Show the unapproved, hide the approved
                unapprovedSection.classList.add('show');
                approvedSection.classList.remove('show');
                unapprovedButton.classList.remove('btn-a-outline');
                unapprovedButton.classList.add('btn-a');

                approvedButton.classList.remove('btn-p');
                approvedButton.classList.add('btn-p-outline');
              }
            };
  
            // Event listeners for button clicks
            approvedButton.addEventListener('click', () => {
              if (!approvedSection.classList.contains('show')) {
                toggleSections(true);
              }
            });
  
            unapprovedButton.addEventListener('click', () => {
              if (!unapprovedSection.classList.contains('show')) {
                toggleSections(false);
              }
            });

        </script>

    </body>
</html>