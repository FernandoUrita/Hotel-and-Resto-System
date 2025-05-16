<?php
    require ('inc/essentials.php');
    require ('inc/db_config.php');
    adminLogin();

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features & Facilities</title>
    <link rel="apple-touch-icon" sizes="180x180" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="32x32" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="16x16" href="image/ph-logo.webp">
    <style>
    .dashboard-heading {
        text-align: left;
        margin: 10px;
        background-color: white;
        padding: 10px;
        border-radius: 8px;
    }

    .dashboard-heading h3 {
        display: inline-block;
        margin: 0;
        font-size: 20px;
        font-weight: bold;
        position: relative;
        padding-left: 20px;
    }

    .dashboard-heading h3::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        width: 5px;
        height: 30px;
        background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%);
        transform: translateY(-50%);
    }
</style>
<!-- LINK.PHP -->
    <?php require('inc/links.php'); ?>

</head>
<body>
    
    <div class="wrapper ">
        <?php require('inc/header.php') ?>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="change_profile.php" class="dropdown-item">Profile</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <div class="container-fluid" id="main-content">
                <div class="row">
                    <div class="ms-auto p-4 overflow-hidden">     
                        <div class="p-4 card dashboard-heading">
                            <h3>FEATURES & FACILITIES</h3>
                        </div>

                                <!-- Features section -->     

                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">

                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="card-title m-0">Features</h5>
                                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                                                <i class="bi bi-plus-square"></i> Add
                                            </button>
                                        </div>
                    
                                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                            <table class="table table-hover borber table-bordered">
                                                <thead class="striky-top">
                                                    <tr class="bg-dark text-light">
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="features-data">
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Facilities section -->     

                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">

                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="card-title m-0">Facilities</h5>
                                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                                                <i class="bi bi-plus-square"></i> Add
                                            </button>
                                        </div>
                    
                                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                            <table class="table table-hover borber table-bordered">
                                                <thead class="striky-top">
                                                    <tr class="bg-dark text-light">
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Icon</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col" width="40%">Description</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="facilities-data">
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                    </div>
                </div>
            </div>

            <!-- Feature Modal -->
            <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="feature_s_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Feature</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="feature_name" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn custom-bg text-dark shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>

            <!-- Facilities Modal -->
            <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form id="facility_s_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Facilities</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="facility_name" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Icon</label>
                                <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="facility_desc" class="form-control shadow-none" row="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn custom-bg text-dark shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>

        </div>
            <a href="#" class="theme-toggle">
                <i class="bi bi-moon"></i>
                <i class="bi bi-sun"></i>
            </a>
    </div>
   

    <!-- SCRIPT.PHP -->
<?php require('inc/scripts.php'); ?>

<script src="scripts/script.js"></script>

<script src="scripts/features_facilities.js"></script>

</body>
</html>