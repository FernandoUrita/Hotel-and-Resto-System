<?php
    require('inc/essentials.php');
    adminLogin();

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
                                <a href="#" class="dropdown-item">Setting</a>
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
                            <h3>CAROUSEL</h3>
                        </div>
                        <!-- Carousel section -->     

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5 class="card-title m-0">Images</h5>
                                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                        <i class="bi bi-plus-square"></i> Add
                                    </button>
                                </div>
                    
                                <div class="row" id="carousel-data">        
                                </div>

                            </div>
                        </div>

                        <!-- Carousel Modal -->
                        <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form id="carousel_s_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                <h5 class="modal-title">Add Image</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Picture</label>
                                                <input type="file" name="carousel_picture" id="carousel_picture_inp" accept="[.jpg, .png, .webp, .jpeg]" class="form-control shadow-none" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="carousel_picture.value=''" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                            <button type="submit" class="btn custom-bg text-dark shadow-none">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
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

    <script src="scripts/carousel.js"></script>
    
</body>
</html>