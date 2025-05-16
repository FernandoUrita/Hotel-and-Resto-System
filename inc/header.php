        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <img src="image/ph-logo.webp" style="width: 75px;">
                    <a href="../hotel.php">Paradise Hotel</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        <h6>Admin Elements</h6>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="bi bi-columns-gap" style="color: #28980e;"></i> Dashboard
                        </a>
                    </li>
                    <li class="sidebar-header">
                        <h6>Front Office</h6>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#ress" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="bi bi-journal-bookmark" style="color: #28980e;"></i>
                            Reservation 
                        </a>
                        <ul id="ress" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="ress.php" class="sidebar-link">Table and Room</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="res.php" class="sidebar-link">Event</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#order" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="bi bi-box-seam" style="color: #28980e;"></i>
                            Order Management 
                        </a>
                        <ul id="order" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="olist.php" class="sidebar-link">Orders</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="Rorder.php" class="sidebar-link">Rooms Orders</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="clist.php" class="sidebar-link">Room List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="food_list.php" class="sidebar-link">Food List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="paylist.php" class="sidebar-link">Payment Details</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#rep" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="bi bi-clipboard-data" style="color: #28980e;"></i>
                            Guest Management
                        </a>
                        <ul id="rep" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="incident.php" class="sidebar-link">Incident</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="user_queries.php" class="sidebar-link">Feedback</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#room" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="bi bi-door-open" style="color: #28980e;"></i>
                            Rooms
                        </a>
                        <ul id="room" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="in.php" class="sidebar-link">Confirm Booking</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="room_mang.php" class="sidebar-link">Manage Room</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </aside>