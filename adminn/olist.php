<?php
    require ('order/order_mana/config/config.php');
    require ('inc/essentials.php');
    adminLogin();
    
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="apple-touch-icon" sizes="180x180" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="32x32" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="16x16" href="image/ph-logo.webp">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="order/order_mana/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="order/order_mana/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }
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

        .badge
        {
            font-size: 66%;
            font-weight: 600;
            line-height: 1;
            display: inline-block;
            padding: .35rem .375rem;
            text-align: center;
            vertical-align: baseline;
            white-space: nowrap;
            border-radius: .375rem;
        }

        .badge-success
        {
            color: #1aae6f;
            background-color: rgb(26, 174, 111);
        }
        .badge-success[href]:hover,
        .badge-success[href]:focus
        {
            text-decoration: none;
            color: #fff;
            background-color: #24a46d;
        }

        .badge-danger
        {
            color: #f80031;
            background-color: rgb(248, 0, 49);
        }
        .badge-danger[href]:hover,
        .badge-danger[href]:focus
        {       
            text-decoration: none;
            color: #fff;
            background-color: #ec0c38;
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
                            <h3>Orders Records</h3>
                        </div>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a class="btn btn-success shadow-none btn-sm" href="order/admin/">
                                        <i class="bi bi-plus-square"></i> Make Order
                                    </a>
                                </div>
                                <div class="table-responsive-md" style="height: 300px; overflow-y: scroll;">
                                    <table class="table table-hover borber table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th class="text-success" scope="col">Code</th>
                                                <th scope="col">Customer</th>
                                                <th class="text-success" scope="col">Product</th>
                                                <th scope="col">Unit Price</th>
                                                <th class="text-success" scope="col">Qty</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ret = "SELECT * FROM  rpos_orders ORDER BY `created_at` DESC  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                while ($order = $res->fetch_object()) {
                                                $total = ($order->prod_price * $order->prod_qty);
                                            ?>
                                                <tr>
                                                    <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                                    <td><?php echo $order->customer_name; ?></td>
                                                    <td class="text-success"><?php echo $order->prod_name; ?></td>
                                                    <td>₱ <?php echo $order->prod_price; ?></td>
                                                    <td class="text-success"><?php echo $order->prod_qty; ?></td>
                                                    <td>₱ <?php echo $total; ?></td>
                                                    <td><?php if ($order->order_status == '') {
                                                            echo "<span class='badge badge-danger'>Not Paid</span>";
                                                        } else {
                                                            echo "<span class='badge badge-success'>$order->order_status</span>";
                                                        } ?></td>
                                                    <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 card dashboard-heading">
                            <h3>Orders Receipts</h3>
                        </div>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="table-responsive-md" style="height: 300px; overflow-y: scroll;">
                                    <table class="table table-hover borber table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th class="text-success" scope="col">Code</th>
                                                <th scope="col">Customer</th>
                                                <th class="text-success" scope="col">Product</th>
                                                <th scope="col">Unit Price</th>
                                                <th class="text-success" scope="col">Qty</th>
                                                <th scope="col">Total Price</th>
                                                <th class="text-success" scope="col">Date</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ret = "SELECT * FROM  rpos_orders WHERE order_status = 'Paid' ORDER BY `rpos_orders`.`created_at` DESC  ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                while ($order = $res->fetch_object()) {
                                                $total = ($order->prod_price * $order->prod_qty);
                                            ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->order_code; ?></th>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td class="text-success"><?php echo $order->prod_name; ?></td>
                                            <td>₱ <?php echo $order->prod_price; ?></td>
                                            <td class="text-success"><?php echo $order->prod_qty; ?></td>
                                            <td>₱ <?php echo $total; ?></td>
                                            <td><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                            <td>
                                                <a target="_blank" href="order/order_mana/print_receipt.php?order_code=<?php echo $order->order_code; ?>">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="fas fa-print"></i>
                                                        Print Receipt
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                            require_once('order/order_mana/partials/_scripts.php');
                        ?>
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
</body>
</html>