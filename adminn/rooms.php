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
                            <h3>Rooms</h3>
                        </div>

                        <!-- Features section -->     

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">

                                <div class="text-end mb-4">
                                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                        <i class="bi bi-plus-square"></i> Add
                                    </button>
                                </div>
                    
                                <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                                    <table class="table table-hover borber text-center">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Area</th>
                                                <th scope="col">Guests</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="room-data">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Add room Modal -->
            <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form id="add_room_form" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Room</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Area</label>
                                    <input type="number" min="1" name="area" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" min="1" name="price" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Adult (Max.)</label>
                                    <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Children (Max.)</label>
                                    <input type="number" min="1" name="children" class="form-control shadow-none" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Features</label>
                                    <div class="row">
                                        <?php
                                            $res = selectAll('features');
                                            while($opt = mysqli_fetch_assoc($res)){
                                                echo"
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Facilities</label>
                                    <div class="row">
                                        <?php
                                            $res = selectAll('facilities');
                                            while($opt = mysqli_fetch_assoc($res)){
                                                echo"
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" row="4" class="form-control shadow-none" required></textarea>
                                </div>      
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" name="send" class="btn custom-bg text-dark shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>

            <!-- Edit room Modal -->
            <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <form id="edit_room_form" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Room</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Area</label>
                                    <input type="number" min="1" name="area" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" min="1" name="price" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Adult (Max.)</label>
                                    <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Children (Max.)</label>
                                    <input type="number" min="1" name="children" class="form-control shadow-none" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Features</label>
                                    <div class="row">
                                        <?php
                                            $res = selectAll('features');
                                            while($opt = mysqli_fetch_assoc($res)){
                                                echo"
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Facilities</label>
                                    <div class="row">
                                        <?php
                                            $res = selectAll('facilities');
                                            while($opt = mysqli_fetch_assoc($res)){
                                                echo"
                                                    <div class='col-md-3 mb-1'>
                                                        <label>
                                                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                            $opt[name]
                                                        </label>
                                                    </div>
                                                ";
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" row="4" class="form-control shadow-none" required></textarea>
                                </div>  
                                <input type="hidden" name="room_id">
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
            
            <!--Manage room images Modal -->
            <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title">Room Name</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                            <button class="btn custom-bg text-dark shadow-none">Add</button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover borber text-center">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">
                            </tbody>
                        </table>
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

    <script src="scripts/rooms.js"></script>

</body>
</html>