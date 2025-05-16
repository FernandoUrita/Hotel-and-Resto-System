<?php
require ('inc/essentials.php');
require ('form/db.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    
    <!-- Favicons -->
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
      
    .badge-lg {
        font-size: 0.9rem;
        padding: 0.5em 0.75em;
        border-radius: 0.25rem;
    }
    
    .action-btn {
        border-radius: 60px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .filter-section {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .report-modal .modal-dialog {
        max-width: 500px;
    }
    </style>
    
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
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="Profile">
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
                        <div class="p-4 card dashboard-heading" style="max-width: 350px;">
                            <h3>Rooms Management</h3>
                        </div>
                        
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <button class="btn btn-dark rounded me-2" data-bs-toggle="modal" data-bs-target="#addRoom">
                                        <i class="bi bi-plus-square"></i> Add Rooms
                                    </button>
                                  	<button class="btn btn-dark rounded me-2" data-bs-toggle="modal" data-bs-target="#addRoomtype">
                                        <i class="bi bi-plus-square"></i> Add Room type
                                    </button>
                                    <a href="gcash/app/Http/Controllers/index.php" class="btn btn-success rounded me-2">
                                        <i class="bi bi-money"></i> Pay Now
                                    </a>
                                  	<button class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#reportModal">
                                        <i class="bi bi-file-earmark-arrow-down"></i> Generate Report
                                    </button>
                                </div>
                                
                                <?php
                                if (isset($_GET['error'])) {
                                    echo '<div class="alert alert-danger">
                                            <i class="bi bi-exclamation-triangle"></i> Error on Delete!
                                        </div>';
                                }
                                if (isset($_GET['success'])) {
                                    echo '<div class="alert alert-success">
                                            <i class="bi bi-check-circle"></i> Successfully Deleted!
                                        </div>';
                                }
                                ?>
                                
                                <!-- Filter Section -->
                                <div class="filter-section mb-4">
                                    <form id="filterForm">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label for="roomTypeFilter" class="form-label">Room Type</label>
                                                <select class="form-select" id="roomTypeFilter">
                                                    <option value="">All Types</option>
                                                    <?php
                                                    $query = "SELECT * FROM room_type";
                                                    $result = mysqli_query($connection, $query);
                                                    while ($room_type = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $room_type['room_type_id'] . '">' . htmlspecialchars($room_type['room_type']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="statusFilter" class="form-label">Booking Status</label>
                                                <select class="form-select" id="statusFilter">
                                                    <option value="">All Status</option>
                                                    <option value="available">Available</option>
                                                    <option value="reserved">Reserved</option>
                                                    <option value="occupied">Occupied</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cleanStatusFilter" class="form-label">Clean Status</label>
                                                <select class="form-select" id="cleanStatusFilter">
                                                    <option value="">All Status</option>
                                                    <option value="Not Cleaned">Not Cleaned</option>
                                                    <option value="Needs Inspection">Needs Inspection</option>
                                                    <option value="Clean">Clean</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="button" id="resetFilters" class="btn btn-outline-secondary me-2">
                                                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-funnel"></i> Filter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Search Box -->
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search rooms...">
                                        <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                            <i class="bi bi-x"></i> Clear
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="roomsTable" class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="sortable" data-sort="room_no">Room No <i class="bi bi-arrow-down-up"></i></th>
                                                <th class="sortable" data-sort="room_type">Room Type <i class="bi bi-arrow-down-up"></i></th>
                                                <th class="sortable" data-sort="clean_status">Clean Status <i class="bi bi-arrow-down-up"></i></th>
                                                <th>Booking Status</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $room_query = "SELECT * FROM room NATURAL JOIN room_type WHERE deleteStatus = 0";
                                            $rooms_result = mysqli_query($connection, $room_query);
                                            
                                            if (mysqli_num_rows($rooms_result) > 0) {
                                                while ($rooms = mysqli_fetch_assoc($rooms_result)) {
                                                    $room_id = htmlspecialchars($rooms['room_id']);
                                                    $room_no = htmlspecialchars($rooms['room_no']);
                                                    $room_type = htmlspecialchars($rooms['room_type']);
                                                    $clean_status = $rooms['clean_status'] ?? '';
                                                    $status = $rooms['status'];
                                                    $check_in_status = $rooms['check_in_status'];
                                                    ?>
                                                    <tr>
                                                        <td><?= $room_no ?></td>
                                                        <td><?= $room_type ?></td>
                                                        <td>
                                                            <?php if (empty($clean_status)): ?>
                                                                <span class="badge bg-danger badge-lg">Not Cleaned</span>
                                                            <?php elseif ($clean_status == 'Clean'): ?>
                                                                <span class="badge bg-success badge-lg">Clean</span>
                                                            <?php elseif ($clean_status == 'Needs Inspection'): ?>
                                                                <span class="badge bg-warning text-dark badge-lg">Needs Inspection</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary badge-lg"><?= htmlspecialchars($clean_status) ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($status == 0): ?>
                                                                <a href="form/index.php?reservation&room_id=<?= $room_id ?>&room_type_id=<?= $rooms['room_type_id'] ?>" 
                                                                   class="btn btn-success btn-sm">Book Room</a>
                                                            <?php elseif ($check_in_status == 1): ?>
                                                                <span class="btn btn-danger btn-sm disabled">Occupied</span>
                                                            <?php else: ?>
                                                                <span class="btn btn-warning btn-sm disabled">Reserved</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
														    <?php
														    // Display check-in button/status
														    if ($rooms['status'] == 1 && $rooms['check_in_status'] == 0) {
														        echo '<button class="btn btn-warning" id="checkInRoom" data-id="' . $rooms['room_id'] . '" data-bs-toggle="modal" style="border-radius:0%" data-bs-target="#checkIn">Check In</button>';
														    } elseif ($rooms['status'] == 0) {
														        echo '-';
														    } else {
														        echo '<a href="#" class="btn btn-danger" style="border-radius:0%; pointer-events: none; cursor: default;">Checked In</a>';
														    }
														    ?>
														</td>
                                    					<td>
                                    					    <?php
                                    					    if ($rooms['status'] == 1 && $rooms['check_in_status'] == 1) {
                                    					        echo '<button class="btn btn-primary" style="border-radius:0%" id="checkOutRoom" data-id="' . $rooms['room_id'] . '">Check Out</button>';
                                    					    } elseif ($rooms['status'] == 0) {
                                    					        echo '-';
                                    					    }
                                    					    ?>
                                    					</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button title="Edit Room" data-bs-toggle="modal" data-bs-target="#editRoom" 
                                                                        data-id="<?= $room_id ?>" id="roomEdit" 
                                                                        class="btn btn-info action-btn">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>
                                                                
                                                                <?php if ($status == 1): ?>
                                                                    <button title="Customer Info" data-bs-toggle="modal" 
                                                                            data-bs-target="#cutomerDetailsModal" data-id="<?= $room_id ?>" 
                                                                            id="cutomerDetails" class="btn btn-warning action-btn">
                                                                        <i class="bi bi-eye"></i>
                                                                    </button>
                                                                <?php endif; ?>
                                                                
                                                                <a href="ajax.php?delete_room=<?= $room_id ?>" 
                                                                   class="btn btn-danger action-btn" 
                                                                   onclick="return confirm('Are you sure you want to delete this room?')">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                                
                                                                <button title="Update Cleaning Status" data-bs-toggle="modal"
                                                                        data-bs-target="#cleanStatusModal" data-id="<?= $room_id ?>"
                                                                        data-current-status="<?= htmlspecialchars($clean_status) ?>"
                                                                        id="updateCleanStatus" class="btn btn-secondary action-btn">
                                                                    <i class="bi bi-send"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="7" class="text-center">No Rooms Found</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-3">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
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
  
    <!-- Report Generation Modal -->
	<div id="reportModal" class="modal fade report-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Detailed Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reportForm" action="generate_report.php" method="post" target="_blank">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Report Type</label>
                            <select class="form-select" name="report_type" required>
                                <option value="">Select Report Type</option>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="word">Word</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Report Content</label>
                            <select class="form-select" name="report_content" required>
                                <option value="rooms">Rooms Only</option>
                                <option value="bookings">Bookings with Customer Details</option>
                                <option value="both">Both Rooms and Bookings</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Date From</label>
                            <input type="text" class="form-control datepicker" name="date_from" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date To</label>
                            <input type="text" class="form-control datepicker" name="date_to" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Password</label>
                        <input type="password" class="form-control" name="admin_password" required placeholder="Enter your admin password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>

     <div id="addRoom" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Room</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="addRoom" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group mb-3">
                                    <label>Room Type</label>
                                    <select class="form-control" id="room_type_id" required
                                            data-error="Select Room Type">
                                        <option selected disabled>Select Room Type</option>
                                        <?php
                                        $query = "SELECT * FROM room_type";
                                        $result = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($room_type = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Room No</label>
                                    <input class="form-control" placeholder="Room No" id="room_no"
                                           data-error="Enter Room No" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button class="btn btn-success pull-right">Add Room</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Edit Room Modal -->
    <div id="editRoom" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Room</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="roomEditFrom" data-toggle="validator" role="form">
                                <div class="edit_response"></div>
                                <div class="form-group mb-3">
                                    <label>Room Type</label>
                                    <select class="form-control" id="edit_room_type" required
                                            data-error="Select Room Type">
                                        <option selected disabled>Select Room Type</option>
                                        <?php
                                        $query = "SELECT * FROM room_type";
                                        $result = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($room_type = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $room_type['room_type_id'] . '">' . $room_type['room_type'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Room No</label>
                                    <input class="form-control" placeholder="Room No" id="edit_room_no" required
                                           data-error="Enter Room No">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="edit_room_id">
                                <button class="btn btn-success pull-right">Edit Room</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Details Modal -->
    <div id="cutomerDetailsModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Customer Name</strong></td>
                                <td id="customer_name"></td>
                            </tr>
                            <tr>
                                <td><strong>Contact Number</strong></td>
                                <td id="customer_contact_no"></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td id="customer_email"></td>
                            </tr>
                            <tr>
                                <td><strong>ID Card Type</strong></td>
                                <td id="customer_id_card_type"></td>
                            </tr>
                            <tr>
                                <td><strong>ID Card Number</strong></td>
                                <td id="customer_id_card_number"></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td id="customer_address"></td>
                            </tr>
                            <tr>
                                <td><strong>Remaining Amount</strong></td>
                                <td id="remaining_price"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Check In Modal -->
    <div id="checkIn" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"><b>Room - Check In</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td id="getCustomerName"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Type</b></td>
                                    <td id="getRoomType"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Number</b></td>
                                    <td id="getRoomNo"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut"></td>
                                </tr>
                                <tr>
                                    <td><b>Total Price</b></td>
                                    <td id="getTotalPrice"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="advancePayment">
                                <div class="payment-response"></div>
                                <div class="form-group mb-3">
                                    <label>Advance Payment</label>
                                    <input type="number" class="form-control" id="advance_payment"
                                           placeholder="Please Enter Amounts Here..">
                                </div>
                                <input type="hidden" id="getBookingID" value="">
                                <button type="reset" class="btn btn-outline-dark text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn btn-primary pull-right">Payment & Check In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Check Out Modal-->
    <div id="checkOut" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Room- Check Out</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Customer Name</b></td>
                                    <td id="getCustomerName_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Type</b></td>
                                    <td id="getRoomType_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Room Number</b></td>
                                    <td id="getRoomNo_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td id="getTotalPrice_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Remaining Amount</b></td>
                                    <td id="getRemainingPrice_n"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="checkOutRoom_n" data-toggle="validator">
                                <div class="checkout-response"></div>
                                <div class="form-group col-lg-12">
                                    <label><b>Remaining Payment</b></label>
                                    <input type="text" class="form-control" id="remaining_amount"
                                           placeholder="Remaining Payment" required
                                           data-error="Please Enter Remaining Amount">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="getBookingId_n" value="">
                                <button type="submit" class="btn btn-primary pull-right mt-3">Proceed Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>

    <!-- Clean Status Modal -->
    <div id="cleanStatusModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Cleaning Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cleanStatusForm">
                        <input type="hidden" id="cleanStatusRoomId">
                        <div class="mb-3">
                            <label class="form-label">Cleaning Status</label>
                            <select class="form-select" id="clean_status" required>
                                <option value="">Select Status</option>
                                <option value="Not Cleaned">Not Cleaned</option>
                                <option value="Needs Inspection">Needs Inspection</option>
                                <option value="Clean">Clean</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveCleanStatus" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
  	
    <?php require('inc/scripts.php'); ?>
    <script src="scripts/script.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script> 
    <script src="assets/js/jquery-3.6.0.min.js"></script> 
    <script src="assets/js/datatables.min.js"></script> 
    <script src="assets/js/pdfmake.min.js"></script> 
    <script src="assets/js/vfs_fonts.js"></script> 
    <script src="assets/js/custom.js"></script>
  	<script src="js/foundation-datepicker.min.js"></script>
    <script src="js/validator.min.js"></script>
  	<script src="js/custom.js"></script>
    <script src="form/ajax.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable with sorting and searching
        var table = $('#roomsTable').DataTable({
            "paging": true,
            "pageLength": 5,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "dom": '<"top"f>rt<"bottom"lip><"clear">',
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search rooms...",
                "paginate": {
                    "previous": "<i class='bi bi-chevron-left'></i>",
                    "next": "<i class='bi bi-chevron-right'></i>"
                }
            },
            "initComplete": function() {
                $('.dataTables_filter input').addClass('form-control');
                $('.dataTables_length select').addClass('form-select');
            }
        });
        
        // Custom search box functionality
        $('#searchInput').keyup(function() {
            table.search($(this).val()).draw();
        });
        
        // Clear search
        $('#clearSearch').click(function() {
            $('#searchInput').val('');
            table.search('').draw();
        });
        
        // Filter functionality
        $('#filterForm').submit(function(e) {
            e.preventDefault();
            var roomType = $('#roomTypeFilter').val();
            var status = $('#statusFilter').val();
            var cleanStatus = $('#cleanStatusFilter').val();
            
            // Filter by room type
            if (roomType) {
                table.column(1).search(roomType, true, false).draw();
            } else {
                table.column(1).search('').draw();
            }
            
            // Filter by booking status
            if (status) {
                if (status === 'available') {
                    table.column(3).search('Book Room', true, false).draw();
                } else if (status === 'reserved') {
                    table.column(3).search('Reserved', true, false).draw();
                } else if (status === 'occupied') {
                    table.column(3).search('Occupied', true, false).draw();
                }
            } else {
                table.column(3).search('').draw();
            }
            
            // Filter by clean status
            if (cleanStatus) {
                table.column(2).search(cleanStatus, true, false).draw();
            } else {
                table.column(2).search('').draw();
            }
        });
        
        // Reset filters
        $('#resetFilters').click(function() {
            $('#filterForm')[0].reset();
            table.columns().search('').draw();
        });
        
        // Sortable columns
        $('.sortable').click(function() {
            var column = $(this).data('sort');
            var order = table.order()[0];
            if (order[0] === table.column($(this).index()).index() && order[1] === 'asc') {
                table.order([$(this).index(), 'desc']).draw();
            } else {
                table.order([$(this).index(), 'asc']).draw();
            }
        });
        
        // Clean status modal handling
        $(document).on('click', '#updateCleanStatus', function() {
            var roomId = $(this).data('id');
            var currentStatus = $(this).data('current-status');
            
            $('#cleanStatusRoomId').val(roomId);
            $('#clean_status').val(currentStatus);
        });

        $('#saveCleanStatus').click(function() {
            var roomId = $('#cleanStatusRoomId').val();
            var cleanStatus = $('#clean_status').val();
            
            if (!cleanStatus) {
                alert('Please select a cleaning status');
                return;
            }

            $.ajax({
                url: 'update_clean_status.php',
                type: 'POST',
                data: {
                    room_id: roomId,
                    clean_status: cleanStatus
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Status updated successfully!');
                        $('#cleanStatusModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
        
        // Report generation form validation
        $('#reportForm').submit(function(e) {
            var password = $('input[name="admin_password"]').val();
            if (!password) {
                alert('Please enter your admin password to generate the report');
                e.preventDefault();
            }
        });
    });
      
    $(document).ready(function() {
    // Initialize datepicker for report range
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
    
    // Form validation for report generation
    $('#reportForm').submit(function(e) {
        const dateFrom = $('input[name="date_from"]').val();
        const dateTo = $('input[name="date_to"]').val();
        
        if (dateFrom && dateTo) {
            const fromDate = new Date(dateFrom.split('-').reverse().join('-'));
            const toDate = new Date(dateTo.split('-').reverse().join('-'));
            
            if (fromDate > toDate) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Date Range',
                    text: 'The "From" date cannot be after the "To" date'
                });
            }
        }
    });
});
    </script>
</body>
</html>