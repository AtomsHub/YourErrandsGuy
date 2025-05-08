
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
                                <a href="dashboard" class="d-flex align-items-center gap-4">
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
                                <a href="dispatchers" class="d-flex align-items-center gap-4 active">
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
                                <button class="btn btn-a-outline" data-bs-toggle="collapse" data-bs-target="#unapprovedSection" aria-expanded="true" aria-controls="unapprovedSection">
                                    Unapproved
                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="collapse" data-bs-target="#disapprovedSection" aria-expanded="false" aria-controls="disapprovedSection">
                                    Disapproved
                                </button>




                            </p>
                        </div>

                        <!-- Approved Table -->
                        <div class="rounded-col mt-4 collapse multi-collapse show" id="approvedSection">
                            <p class="headline-small text-p">Approved Dispatcher</p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="approvedDispatcher">
                                    <thead>
                                        <tr class="table-light text-center">
                                            <th>Dispatcher Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approved as $dispatcher)
                                        <tr data-bs-toggle="modal" data-bs-target="#approvedDispatcherModal" onclick='showDispatcherDetail(@json($dispatcher))'>
                                            <td>{{ $dispatcher->full_name }}</td>
                                            <td>{{ $dispatcher->email }}</td>
                                            <td>{{ $dispatcher->phone_number }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDispatcherModal">
                                Register New Dispatcher
                            </button>
                        </div>




                        <!-- Unapproved Table -->
                        <div class="rounded-col mt-4 collapse multi-collapse" id="unapprovedSection">
                            <p class="headline-small text-d">Unapproved Dispatcher</p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="unApprovedDispatcher">
                                    <thead>
                                        <tr class="table-light two text-center">
                                            <th>Dispatcher Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unapproved as $dispatcher)
                                        <tr data-bs-toggle="modal" data-bs-target="#unapprovedDispatcherModal" onclick='showDispatcherDetails(@json($dispatcher))'>
                                            <td>{{ $dispatcher->full_name }}</td>
                                            <td>{{ $dispatcher->email }}</td>
                                            <td>{{ $dispatcher->phone_number }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDispatcherModal">
                                Register New Dispatcher
                            </button>
                        </div>
                    </div>


                        <!-- disapproved Table -->
                        <div class="rounded-col mt-4 collapse multi-collapse" id="disapprovedSection">
                            <p class="headline-small text-d">Unapproved Dispatcher</p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="disApprovedDispatcher">
                                    <thead>
                                        <tr class="table-light two text-center">
                                            <th>Dispatcher Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($disapproved as $dispatcher)
                                        <tr data-bs-toggle="modal" data-bs-target="#disapprovedDispatcherModal" onclick='showDispatcherDetail2(@json($dispatcher))'>
                                            <td>{{ $dispatcher->full_name }}</td>
                                            <td>{{ $dispatcher->email }}</td>
                                            <td>{{ $dispatcher->phone_number }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDispatcherModal">
                                Register New Dispatcher
                            </button>
                        </div>
                    </div>


                     <!-- Unapproved Dispatcher Modal -->
                    <div class="modal fade" id="unapprovedDispatcherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="unapprovedDispatcherModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content p-3 py-5 p-md-5">
                                <div class="modal-header d-flex justify-content-between mx-1 mx-md-3 mb-3">
                                    <p class="headline-small">Dispatcher</p>
                                    <button type="button" class="btn-close mb-3 border rounded-md p-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body mx-1 mx-md-3">
                                    <div class="modal-text-2 text-center">
                                        <div class="modal-details-box">
                                            <p class="label-medium">Driver License Number</p>
                                            <p id="modal-license" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">License Expiration Date</p>
                                            <p id="modal-license-expiration" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Plate Number</p>
                                            <p id="modal-plate" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Dispatcher Name</p>
                                            <p id="modal-full-name" class="title-medium text-end">
                                                <img src="{{ asset('assets/img/user.png') }}" class="rounded-5" height="20" width="20" alt="">
                                            </p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Email Address</p>
                                            <p id="modal-email" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Phone Number</p>
                                            <p id="modal-phone" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Home Address</p>
                                            <p id="modal-address" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Date Of Birth</p>
                                            <p id="modal-dob" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">National ID Number</p>
                                            <p id="modal-national-id" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Number</p>
                                            <p id="modal-bank-account-number" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Name</p>
                                            <p id="modal-bank-account-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Bank</p>
                                            <p id="modal-bank-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">ID Uploaded</p>
                                            <p id="modal-id-document" class="title-medium text-end viewImage">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Hackney Permit</p>
                                            <p id="modal-hackney-permit" class="title-medium text-end viewImage">N/A</p>
                                        </div>

                                        <div class="stack gap-5 text-center mt-5">
                                            <button id="approve-button" class="btn btn-p px-5 me-2">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                     <!-- Disapproved Dispatcher Modal -->
                     <div class="modal fade" id="disapprovedDispatcherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="disapprovedDispatcherModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content p-3 py-5 p-md-5">
                                <div class="modal-header d-flex justify-content-between mx-1 mx-md-3 mb-3">
                                    <p class="headline-small">Dispatcher</p>
                                    <button type="button" class="btn-close mb-3 border rounded-md p-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body mx-1 mx-md-3">
                                    <div class="modal-text-2 text-center">
                                        <div class="modal-details-box">
                                            <p class="label-medium">Driver License Number</p>
                                            <p id="modal3-license" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">License Expiration Date</p>
                                            <p id="modal3-license-expiration" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Plate Number</p>
                                            <p id="modal3-plate" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Dispatcher Name</p>
                                            <p id="modal3-full-name" class="title-medium text-end">
                                                <img src="{{ asset('assets/img/user.png') }}" class="rounded-5" height="20" width="20" alt="">
                                            </p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Email Address</p>
                                            <p id="modal3-email" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Phone Number</p>
                                            <p id="modal3-phone" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Home Address</p>
                                            <p id="modal3-address" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Date Of Birth</p>
                                            <p id="modal3-dob" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">National ID Number</p>
                                            <p id="modal3-national-id" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Number</p>
                                            <p id="modal3-bank-account-number" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Name</p>
                                            <p id="modal3-bank-account-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Bank</p>
                                            <p id="modal3-bank-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">ID Uploaded</p>
                                            <p id="modal3-id-document" class="title-medium text-end viewImage">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Hackney Permit</p>
                                            <p id="modal3-hackney-permit" class="title-medium text-end viewImage">N/A</p>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                     <!-- Approved Dispatcher Modal -->
                     <div class="modal fade" id="approvedDispatcherModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approvedDispatcherModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content p-3 py-5 p-md-5">
                                <div class="modal-header d-flex justify-content-between mx-1 mx-md-3 mb-3">
                                    <p class="headline-small">Dispatcher</p>
                                    <button type="button" class="btn-close mb-3 border rounded-md p-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body mx-1 mx-md-3">
                                    <div class="modal-text-2 text-center">
                                        <div class="modal-details-box">
                                            <p class="label-medium">Driver License Number</p>
                                            <p id="modal2-license" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">License Expiration Date</p>
                                            <p id="modal2-license-expiration" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Plate Number</p>
                                            <p id="modal2-plate" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Dispatcher Name</p>
                                            <p id="modal2-full-name" class="title-medium text-end">
                                                <img src="{{ asset('assets/img/user.png') }}" class="rounded-5" height="20" width="20" alt="">
                                            </p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Email Address</p>
                                            <p id="modal2-email" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Phone Number</p>
                                            <p id="modal2-phone" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Home Address</p>
                                            <p id="modal2-address" class="title-medium">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Date Of Birth</p>
                                            <p id="modal2-dob" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">National ID Number</p>
                                            <p id="modal2-national-id" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Number</p>
                                            <p id="modal2-bank-account-number" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Account Name</p>
                                            <p id="modal2-bank-account-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Bank</p>
                                            <p id="modal2-bank-name" class="title-medium text-end">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">ID Uploaded</p>
                                            <p id="modal2-id-document" class="title-medium text-end viewImage">N/A</p>
                                        </div>
                                        <div class="modal-details-box">
                                            <p class="label-medium">Hackney Permit</p>
                                            <p id="modal2-hackney-permit" class="title-medium text-end viewImage">N/A</p>
                                        </div>

                                        <div class="stack gap-5 text-center mt-5">
                                            <button id="disapprove-button" class="btn btn-danger px-5 me-2">Disapprove</button>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- Show Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Register Dispatcher Modal -->
                    <div class="modal fade" id="addDispatcherModal" tabindex="-1" aria-labelledby="addDispatcherModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.dispatchers.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addDispatcherModalLabel">New Dispatcher</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">

                                        <div class="col-md-6">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            <input type="date" name="date_of_birth" class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="home_address" class="form-label">Home Address</label>
                                            <textarea name="home_address" class="form-control" required></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="national_id_number" class="form-label">National ID Number</label>
                                            <input type="text" name="national_id_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="driver_license_number" class="form-label">Driver's License Number</label>
                                            <input type="text" name="driver_license_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="license_expiration_date" class="form-label">License Expiration Date</label>
                                            <input type="date" name="license_expiration_date" class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="id_document" class="form-label">Upload ID Document</label>
                                            <input type="file" name="id_document" class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="hackney_permit" class="form-label">Upload Hackney Permit</label>
                                            <input type="file" name="hackney_permit" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="motorbike_license_plate_number" class="form-label">Motorbike Plate Number</label>
                                            <input type="text" name="motorbike_license_plate_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="bank_account_name" class="form-label">Bank Account Name</label>
                                            <input type="text" name="bank_account_name" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                            <input type="text" name="bank_account_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save Dispatcher</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- JavaScript to handle modal population and approval -->
                    <script>
                    function showDispatcherDetails(dispatcher) {
                        document.getElementById('modal-full-name').innerHTML = ` ${dispatcher.full_name ?? 'N/A'}`;
                        document.getElementById('modal-email').innerText = dispatcher.email ?? 'N/A';
                        document.getElementById('modal-phone').innerText = dispatcher.phone_number ?? 'N/A';
                        document.getElementById('modal-address').innerText = dispatcher.home_address ?? 'N/A';
                        document.getElementById('modal-dob').innerText = dispatcher.date_of_birth ?? 'N/A';
                        document.getElementById('modal-license').innerText = dispatcher.driver_license_number ?? 'N/A';
                        document.getElementById('modal-license-expiration').innerText = dispatcher.license_expiration_date ?? 'N/A';
                        document.getElementById('modal-national-id').innerText = dispatcher.national_id_number ?? 'N/A';
                        document.getElementById('modal-plate').innerText = dispatcher.motorbike_license_plate_number ?? 'N/A';
                        document.getElementById('modal-bank-account-number').innerText = dispatcher.bank_account_number ?? 'N/A';
                        document.getElementById('modal-bank-account-name').innerText = dispatcher.bank_account_name ?? 'N/A';
                        document.getElementById('modal-bank-name').innerText = dispatcher.bank_name ?? 'N/A';

                        const idLink = document.getElementById('modal-id-document');
                        if (dispatcher.id_document_path) {

                            idLink.innerHTML = `<a href="/${dispatcher.id_document_path}" target="_blank">View Document</a>`;

                        } else {
                            idLink.innerText = 'N/A';
                        }

                        const hackneyLink = document.getElementById('modal-hackney-permit');
                        if (dispatcher.hackney_permit) {

                            hackneyLink.innerHTML = `<a href="/${dispatcher.hackney_permit}" target="_blank">View Document</a>`;

                        } else {
                            hackneyLink.innerText = 'N/A';
                        }

                         document.getElementById('approve-button').onclick = function () {
                            approveDispatcher(dispatcher.id);
                        };
                    }

                    function showDispatcherDetail(dispatcher) {
                        document.getElementById('modal2-full-name').innerHTML = ` ${dispatcher.full_name ?? 'N/A'}`;
                        document.getElementById('modal2-email').innerText = dispatcher.email ?? 'N/A';
                        document.getElementById('modal2-phone').innerText = dispatcher.phone_number ?? 'N/A';
                        document.getElementById('modal2-address').innerText = dispatcher.home_address ?? 'N/A';
                        document.getElementById('modal2-dob').innerText = dispatcher.date_of_birth ?? 'N/A';
                        document.getElementById('modal2-license').innerText = dispatcher.driver_license_number ?? 'N/A';
                        document.getElementById('modal2-license-expiration').innerText = dispatcher.license_expiration_date ?? 'N/A';
                        document.getElementById('modal2-national-id').innerText = dispatcher.national_id_number ?? 'N/A';
                        document.getElementById('modal2-plate').innerText = dispatcher.motorbike_license_plate_number ?? 'N/A';
                        document.getElementById('modal2-bank-account-number').innerText = dispatcher.bank_account_number ?? 'N/A';
                        document.getElementById('modal2-bank-account-name').innerText = dispatcher.bank_account_name ?? 'N/A';
                        document.getElementById('modal2-bank-name').innerText = dispatcher.bank_name ?? 'N/A';

                        const idLink = document.getElementById('modal2-id-document');
                        if (dispatcher.id_document_path) {

                            idLink.innerHTML = `<a href="/${dispatcher.id_document_path}" target="_blank">View Document</a>`;

                        } else {
                            idLink.innerText = 'N/A';
                        }

                        const hackneyLink = document.getElementById('modal2-hackney-permit');
                        if (dispatcher.hackney_permit) {

                            hackneyLink.innerHTML = `<a href="/${dispatcher.hackney_permit}" target="_blank">View Document</a>`;

                        } else {
                            hackneyLink.innerText = 'N/A';
                        }

                        document.getElementById('disapprove-button').onclick = function () {
                            disapproveDispatcher(dispatcher.id);
                        };

                    }


                    function showDispatcherDetail2(dispatcher) {
                        document.getElementById('modal3-full-name').innerHTML = ` ${dispatcher.full_name ?? 'N/A'}`;
                        document.getElementById('modal3-email').innerText = dispatcher.email ?? 'N/A';
                        document.getElementById('modal3-phone').innerText = dispatcher.phone_number ?? 'N/A';
                        document.getElementById('modal3-address').innerText = dispatcher.home_address ?? 'N/A';
                        document.getElementById('modal3-dob').innerText = dispatcher.date_of_birth ?? 'N/A';
                        document.getElementById('modal3-license').innerText = dispatcher.driver_license_number ?? 'N/A';
                        document.getElementById('modal3-license-expiration').innerText = dispatcher.license_expiration_date ?? 'N/A';
                        document.getElementById('modal3-national-id').innerText = dispatcher.national_id_number ?? 'N/A';
                        document.getElementById('modal3-plate').innerText = dispatcher.motorbike_license_plate_number ?? 'N/A';
                        document.getElementById('modal3-bank-account-number').innerText = dispatcher.bank_account_number ?? 'N/A';
                        document.getElementById('modal3-bank-account-name').innerText = dispatcher.bank_account_name ?? 'N/A';
                        document.getElementById('modal3-bank-name').innerText = dispatcher.bank_name ?? 'N/A';

                        const idLink = document.getElementById('modal3-id-document');
                        if (dispatcher.id_document_path) {

                            idLink.innerHTML = `<a href="/${dispatcher.id_document_path}" target="_blank">View Document</a>`;

                        } else {
                            idLink.innerText = 'N/A';
                        }

                        const hackneyLink = document.getElementById('modal3-hackney-permit');
                        if (dispatcher.hackney_permit) {

                            hackneyLink.innerHTML = `<a href="/${dispatcher.hackney_permit}" target="_blank">View Document</a>`;

                        } else {
                            hackneyLink.innerText = 'N/A';
                        }

                    }



                    function approveDispatcher(id) {
                        fetch(`/admin/dispatchers/${id}/approve`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                location.reload();
                            } else {
                                alert('Failed to approve dispatcher.');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            alert('An error occurred.');
                        });
                    }


                    function disapproveDispatcher(id) {
                        fetch(`/admin/dispatchers/${id}/disapprove`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                location.reload();
                            } else {
                                alert('Failed to disapprove dispatcher.');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            alert('An error occurred.');
                        });
                    }
                    </script>




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
            const disapprovedButton = document.querySelector('button[data-bs-target="#disapprovedSection"]');

            const approvedSection = document.getElementById('approvedSection');
            const unapprovedSection = document.getElementById('unapprovedSection');
            const disapprovedSection = document.getElementById('disapprovedSection');

            // Function to toggle sections
            const toggleSections = (section) => {
              // Hide all sections first
              approvedSection.classList.remove('show');
              unapprovedSection.classList.remove('show');
              disapprovedSection.classList.remove('show');

              approvedButton.classList.remove('btn-p');
              approvedButton.classList.add('btn-p-outline');

              unapprovedButton.classList.remove('btn-a');
              unapprovedButton.classList.add('btn-a-outline');

              disapprovedButton.classList.remove('btn-danger');
              disapprovedButton.classList.add('btn-outline-danger');


              // Show selected section and style corresponding button
              switch (section) {
                case 'approved':
                  approvedSection.classList.add('show');
                  approvedButton.classList.add('btn-p');
                  approvedButton.classList.remove('btn-p-outline');
                  break;
                case 'unapproved':
                  unapprovedSection.classList.add('show');
                  unapprovedButton.classList.add('btn-a');
                  unapprovedButton.classList.remove('btn-a-outline');
                  break;
                case 'disapproved':
                  disapprovedSection.classList.add('show');
                  disapprovedButton.classList.add('btn-danger');
                  disapprovedButton.classList.remove('btn-outline-danger');

                  break;
              }
            };

            // Event listeners
            approvedButton.addEventListener('click', () => {
              if (!approvedSection.classList.contains('show')) {
                toggleSections('approved');
              }
            });

            unapprovedButton.addEventListener('click', () => {
              if (!unapprovedSection.classList.contains('show')) {
                toggleSections('unapproved');
              }
            });

            disapprovedButton.addEventListener('click', () => {
              if (!disapprovedSection.classList.contains('show')) {
                toggleSections('disapproved');
              }
            });
          </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>




