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
    <title>Booking</title>
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
                            <h3>Food Lists</h3>
                        </div>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="card-header border-0">
                                    <a href="order/order_mana/add_product.php" class="btn btn-outline-success">
                                    <i class="fas fa-user-plus"></i>
                                        Add New Menu
                                    </a>
                                </div>
                                <div class="table-responsive-md" style="height: 550px; overflow-y: scroll;">
                                    <table class="table table-hover borber table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th scope="col">Image</th>
                                                <th scope="col">Product Code</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ret = "SELECT * FROM  rpos_products ";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                while ($prod = $res->fetch_object()) {
                                            ?>
                                              <td>
                                                    <?php
                                                    if ($prod->prod_img) {
                                                      echo "<img src='order/order_mana/assets/img/products/$prod->prod_img' height='60' width='60 class='img-thumbnail'>";
                                                    } else {
                                                      echo "<img src='order/order_mana/assets/img/products/default.jpg' height='60' width='60 class='img-thumbnail'>";
                                                    }

                                                    ?>
                                                  </td>
                                                  <td><?php echo $prod->prod_code; ?></td>
                                                  <td><?php echo $prod->prod_name; ?></td>
                                                  <td>₱ <?php echo $prod->prod_price; ?></td>
                                                  <td>
                                                    <a href="order/order_mana/products.php?delete=<?php echo $prod->prod_id; ?>">
                                                      <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                      </button>
                                                    </a>

                                                    <a href="order/order_mana/update_product.php?update=<?php echo $prod->prod_id; ?>">
                                                      <button class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                        Update
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