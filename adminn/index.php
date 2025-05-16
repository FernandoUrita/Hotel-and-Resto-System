<?php
    require("inc/essentials.php");
    require("inc/db_config.php");

    
    session_start();
    if((isset( $_SESSION['adminLogin'] ) && $_SESSION['adminLogin'] == true)){
        // redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="apple-touch-icon" sizes="180x180" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="32x32" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="16x16" href="image/ph-logo.webp">

<!--LINK.PHP  -->
    <?php require('inc/links.php'); ?>

    <style>
        body,
        html {
            height: 100%;
            background-position: center; 
            background-repeat: no-repeat; 
            background-size: cover;
            background-image: url(image/test.jpg);
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 348px;
            padding: 20px;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .logo {
            display: block;
            margin: 0 auto 23px;
            width: 150px;
        }

        .form-control {
            border-radius: 25px;
            border: 1px solid #28a745;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }

        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 25px;

        }

        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 15px;
            }

            .logo {
                width: 150px;
            }
        }

        .input-group .form-control {
            border-radius: 20px;
        }
        .input-group .input-group-text {
            border-radius: 20px;
        }
    </style>
</head>
<body>
    
<!-- LOGIN -->
    <div class="login-container">
        <div class="form-container">
            <img src="image/ph-logo.webp" alt="Paradise Logo" class="logo">
            <h3 class="text-center text-light mb-4">Welcome Admin</h3>
            <form method="POST">
                <div class="mb-3">
                    <h6 class="text-light">Admin Username</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="admin_name" required>
                    </div>
                </div>
                <div class="mb-4">
                    <h6 class="text-light">Admin Password</h6>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="admin_pass" required>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-green text-light w-100">LOGIN</button>
            </form>
        </div>
    </div>


    <?php

        if(isset($_POST['login']))
        
        {
            $frm_data = filteration($_POST);

            $query = "SELECT * FROM `admin` WHERE `admin_name`=?";
            $values = [$frm_data['admin_name']];

            $res = select($query, $values, "s");
            if($res->num_rows == 1){
                $row = mysqli_fetch_assoc($res);
                if(password_verify($frm_data['admin_pass'], $row['admin_pass'])){
                    $_SESSION['adminLogin'] = true;
                    $_SESSION['adminId'] = $row['sr_no'];
                    redirect('dashboard.php');
                } else {
                    alert('error', 'Login failed - Invalid Credentials!');
                }
            } else {
                alert('error', 'Login failed - Invalid Credentials!');
            }
        }
        
    ?>

<!--SCRIPT.PHP  -->
    <?php require('inc/scripts.php'); ?>

</body>
</html>