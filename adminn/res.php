<?php
    require ('inc/essentials.php');
    require_once('schedule/db-connect.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="apple-touch-icon" sizes="180x180" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="32x32" href="image/ph-logo.webp">
    <link rel="icon" type="image/webp" sizes="16x16" href="image/ph-logo.webp">
    <link rel="stylesheet" href="schedule/css/bootstrap.min.css">
    <link rel="stylesheet" href="schedule/fullcalendar/lib/main.min.css">
    <script src="schedule/js/jquery-3.6.0.min.js"></script>
    <script src="schedule/js/bootstrap.min.js"></script>
    <script src="schedule/fullcalendar/lib/main.min.js"></script>
    <style>
    :root {
        --bs-success-rgb: 71, 222, 152 !important;
    }

    html,
    body {
        height: 100%;
        width: 100%;
        font-family: Apple Chancery, cursive;
    }

    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }
    table, tbody, td, tfoot, th, thead, tr {
        border-color: #ededed !important;
        border-style: solid;
        border-width: 1px !important;
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
                            <h3>Event Reservation</h3>
                        </div>

                        <!-- incident section -->     

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                    
                            <div class="container py-5" id="page-container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                        <div class="modal-header rounded-0">
                            <h5 class="modal-title">Schedule Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body rounded-0">
                            <div class="container-fluid">
                                <dl>
                                    <dt class="text-muted">Title</dt>
                                    <dd id="title" class="fw-bold fs-4"></dd>
                                    <dt class="text-muted">Description</dt>
                                    <dd id="description" class=""></dd>
                                    <dt class="text-muted">Start</dt>
                                    <dd id="start" class=""></dd>
                                    <dt class="text-muted">End</dt>
                                    <dd id="end" class=""></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="modal-footer rounded-0">
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
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
    <?php 
    $schedules = $conn->query("SELECT * FROM `schedule_list`");
    $sched_res = [];
    foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
        $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
        $sched_res[$row['id']] = $row;
    }
    ?>
    <?php 
    if(isset($conn)) $conn->close();
    ?>


<!-- SCRIPT.PHP -->
    <?php require('inc/scripts.php'); ?>

    <script src="scripts/script.js"></script>

    <script src="scripts/out.js"></script>
    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    </script>
    <script src="schedule/js/script.js"></script>
</body>
</html>