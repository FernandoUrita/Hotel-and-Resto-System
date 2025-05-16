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
    <title>Dashboard</title>
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

    <div class="wrapper">
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
                    <br>
                    <div class="p-4 card dashboard-heading">
                        <h3>Dashboard</h3>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding">
                                                <h1 class="bi bi-xl bi-door-open" style="color: #30a5ff;"></h1>
                                                <div class="large">
                                                    <?php include 'counters/room-count.php'?>
                                                </div>
                                                <div class="text-muted">Total Rooms</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-bookmark" style="color: #ffb53e;"></h1>
                                                <div class="large"><?php include 'counters/reserve-count.php'?></div>
                                                <div class="text-muted">Reservations</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-journal-plus" style="color: #f9243f;"></h1>
                                                <div class="large"><?php include 'counters/bookedroom-count.php'?></div>
                                                <div class="text-muted">Booked Rooms</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-check-circle" style="color: #14b700;"></h1>
							                    <div class="large"><?php include 'counters/avrooms-count.php'?></div>
							                    <div class="text-muted">Available Rooms</div>
						                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-check2-square" style="color: #ca41b2;"></h1>
                                                <div class="large"><?php include 'counters/checkedin-count.php'?></div>
                                                <div class="text-muted">Checked In</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-plus-circle-dotted" style="color: #30a5ff;"></h1>
                                                <div class="large"><?php include 'counters/pendingpay-count.php'?></div>
                                                <div class="text-muted">Total Pending Payments</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col">
                                                  <h5 class="card-title text-uppercase text-muted mb-0">Customer</h5>
                                                  <span class="h2 font-weight-bold mb-0"><?php include 'counters/product-count.php'?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <h1 class="bi bi-xl bi-file-person" style="color: #30a5ff;"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col">
                                                  <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                                                  <span class="h2 font-weight-bold mb-0"><?php include 'counters/orders.php'?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <h1 class="bi bi-xl bi-cart4" style="color: #14b700;"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col">
                                                  <h5 class="card-title text-uppercase text-muted mb-0">Product Sales</h5>
                                                  <span class="h2 font-weight-bold mb-0">Php.<?php include 'counters/sales-income.php'?></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <h1 class="bi bi-xl bi-receipt-cutoff" style="color: #ffb53e;"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-cash" style="color: #f9243f;"></h1>
                                                <div class="large">Php.<?php include 'counters/income-count.php'?></div>
                                                <div class="text-muted">Total Earnings</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="row no-padding"><h1 class="bi bi-xl bi-credit-card" style="color: #5e459a;"></h1>
                                                <div class="large">Php.<?php include 'counters/pendingpayment.php'?></div>
                                                <div class="text-muted">Pending Payment</div>
                                            </div>
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
    </div>
    


<!-- SCRIPT.PHP -->
    <?php require('inc/scripts.php'); ?>
    
    <script src="scripts/script.js"></script>
    
</body>
</html>