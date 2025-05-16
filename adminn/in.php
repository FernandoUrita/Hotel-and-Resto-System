<?php
    require ('inc/essentials.php');
    require ('inc/db_config.php');
    adminLogin();


    $query = "SELECT * FROM booking,room, customer WHERE booking.room_id = room.room_id AND booking.customer_id = customer.customer_id";
    $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECK-OUT</title>
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
                            <h3>Customer List of Booked</h3>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5 class="card-title">Paid Customers</h5>
                                </div>
                                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                    <table class="table table-hover border table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th scope="col">No.</th>
                                                <th scope="col" class="text-success">Name</th>
                                                <th scope="col" class="text-success">Room Type and Number</th>
                                                <th scope="col">Check-In</th>
                                                <th scope="col">Check-Out</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col" class="text-success">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                mysqli_data_seek($result, 0); // Reset result pointer
                                                while($row = mysqli_fetch_array($result)){
                                                    if($row['remaining_price'] == 0) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td class="text-success"><?php echo $row['customer_name']; ?></td>
                                                <td class="text-success"><?php echo $row['room_no'] ?></td>
                                                <td><?php echo $row['check_in']; ?></td>
                                                <td><?php echo $row['check_out']; ?></td>
                                                <td><?php echo $row['total_price']; ?></td>
                                                <td><span class='text-success'>Paid</span></td>
                                            </tr>
                                            <?php
                                                        $i++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5 class="card-title">Not Paid Customers</h5>
                                </div>
                                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                                    <table class="table table-hover border table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th scope="col">No.</th>
                                                <th scope="col" class="text-success">Name</th>
                                                <th scope="col" class="text-success">Room Type and Number</th>
                                                <th scope="col">Check-In</th>
                                                <th scope="col">Check-Out</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Remaining Balance</th>
                                                <th scope="col" class="text-danger">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                mysqli_data_seek($result, 0); // Reset result pointer
                                                while($row = mysqli_fetch_array($result)){
                                                    if($row['remaining_price'] != 0) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td class="text-success"><?php echo $row['customer_name']; ?></td>
                                                <td class="text-success"><?php echo $row['room_no'] ?></td>
                                                <td><?php echo $row['check_in']; ?></td>
                                                <td><?php echo $row['check_out']; ?></td>
                                                <td><?php echo $row['total_price']; ?></td>
                                                <td><?php echo $row['remaining_price']; ?></td>
                                                <td><span class='text-danger'>Not Paid</span></td>
                                            </tr>
                                            <?php
                                                        $i++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <script src="scripts/in.js"></script>

</body>
</html>