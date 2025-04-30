
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
        <title>Kero - Foods</title>

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
                                <a href="foods" class="d-flex align-items-center gap-4 active">
                                    <i class="fa-solid fa-bowl-food"></i>
                                    <p>Items</p>
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


                    <div class="row g-4 mt-4">

                        <div class="col">
                            <div class="rounded-col">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="headline-small">Item List</p>

                                   <!-- <div class="btn btn-p text-white">
                                        <i class="fa-solid fa-plus"></i>
                                        <a href="" class="text-white" data-bs-toggle="modal" data-bs-target="#food">Add Food</a>
                                    </div>-->
                                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                                        Add Item
                                    </button>
                                </div>
                                <div class="mt-4">

                                    <div class="table-responsive">
                                        <table class="table table-hover" id="">
                                            <thead>
                                                <tr class="table-light text-center">
                                                    <th>Item Name</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td>{{  $item->name }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                                    </td>

                                                    <td>
                                                        <div class="d-flex">
                                                            <!-- View Icon
                                                            <a href="#" class="text-decoration-none me-2" data-bs-toggle="modal" data-bs-target="#food">
                                                                <i class="fas fa-eye text-primary"></i>
                                                            </a>-->

                                                            <!-- Edit Icon -->
                                                            <a href="#"
                                                                class="text-decoration-none me-2 edit-item"
                                                                data-id="{{ $item->id }}"
                                                                data-name="{{ $item->name }}"
                                                                data-url="{{ route('admin.items.update', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editItemModal">
                                                                <i class="fas fa-edit text-success"></i>
                                                            </a>


                                                            <!-- Delete Icon
                                                            <a href="#" class="text-decoration-none">
                                                                <i class="fas fa-trash-alt text-danger"></i>
                                                            </a>-->
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const editButtons = document.querySelectorAll('.edit-item');
                            const form = document.getElementById('editItemForm');
                            const nameInput = document.getElementById('editItemName');

                            editButtons.forEach(button => {
                                button.addEventListener('click', function () {
                                    const itemId = this.getAttribute('data-id');
                                    const itemName = this.getAttribute('data-name');
                                    const updateUrl = this.getAttribute('data-url');

                                    nameInput.value = itemName;
                                    form.action = updateUrl;
                                });
                            });
                        });
                        </script>




            </div>
        </section>

        <!-- Modal
        <div class="modal fade" id="food" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewUnApprovedDriverLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content p-3 py-5 p-md-5">
                    <div class="modal-header d-flex justify-content-between mx-1 mx-md-3 mb-3">
                        <p class="headline-small">Add Food</p>
                        <button type="button" class="btn-close mb-3 border rounded-md p-1" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body mx-1 mx-md-3">
                        <div class="modal-form">
                            <form action="" class="row gy-4">
                                Food Name
                                <div class="col-md-6">
                                    <label for="foodName" class="form-label fw-bold">Food Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control " name="foodName" id="foodName" placeholder="Enter food name">
                                        <i class="fas fa-utensils position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>

                                Select Restaurant
                                <div class="col-md-6">
                                    <label for="restaurant" class="form-label fw-bold">Select Restaurant</label>
                                    <div class="position-relative">
                                        <select class="form-select select2" name="restaurant" id="restaurant" placeholder="Select a restaurant">
                                            <option value="">Select a restaurant</option>
                                            <option value="1">Restaurant 1</option>
                                            <option value="2">Restaurant 2</option>
                                            <option value="3">Restaurant 3</option>
                                        </select>
                                        <i class="fas fa-store position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>

                                Food Rate
                                <div class="col-md-4">
                                    <label for="foodRate" class="form-label fw-bold">Food Rate</label>
                                    <div class="position-relative">
                                        <input type="number" class="form-control " name="foodRate" id="foodRate" placeholder="Enter food rate">
                                        <i class="fas fa-dollar-sign position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>

                                 Food Image
                                <div class="col-md-4">
                                    <label for="foodImg" class="form-label fw-bold">Food Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control " name="foodImg" id="foodImg" placeholder="Upload food image">
                                    </div>
                                </div>

                                 Food Rate Per
                                <div class="col-md-4">
                                    <label for="foodRatePer" class="form-label fw-bold">Food Rate Per</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control " name="foodRatePer" id="foodRatePer" placeholder="e.g., per plate, per spoon">
                                        <i class="fas fa-weight position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>

                                Food Description
                                <div class="col-12">
                                    <label for="foodDescription" class="form-label fw-bold">Food Description</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control " name="foodDescription" id="foodDescription" placeholder="Enter the food description">
                                        <i class="fas fa-align-left position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>

                                 Submit Button
                                <input type="submit" value="Add" class="btn btn-p w-100 mt-4 modal-button">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>-->




            <!-- Add Vendor Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addVendorModalLabel">Add Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label for="vendorDescription" class="form-label">Name</label>
                <input type="text" class="form-control" id="ItemName" name="name" required>
              </div>
            <div class="mb-3">
              <label for="Category" class="form-label">Category</label>
              <select class="form-select" id="category" name="category" required>

                <option value="restaurant">Restaurant</option>
                <option value="laundry">Laundry</option>
                <option value="shopping mall">SuperMarket</option>
              </select>
            </div>
            <div class="mb-3">
                <label for="Image" class="form-control-file">Image</label>
                <input id="image" type="file" class="form-control-file" name="image" >
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary mb-3">Add Item</button>
          </div>
        </div>
      </form>
    </div>
  </div>


<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" id="editItemForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editItemId">
            <div class="mb-3">
              <label for="editItemName" class="form-label">Item Name</label>
              <input type="text" class="form-control" id="editItemName" name="name" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
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

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Custom JS -->
        <script src="assets/js/main.js"></script>
        <script>
            $(document).ready(function() {
                // Reinitialize Select2 when the modal is shown
                $('#food').on('shown.bs.modal', function () {
                    $('#restaurant').select2({
                        dropdownParent: $('#food') // Ensure the dropdown is appended to the modal
                    });
                });
            });
        </script>

    </body>
</html>
