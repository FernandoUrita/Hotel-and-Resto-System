<?php
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();

    if(isset($_GET['seen']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['seen']=='all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values = [1];
            if(update($q,$values,'i')){
                alert('success','Marked all as read!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
        else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
            $values = [1,$frm_data['seen']];
            if(update($q,$values,'ii')){
                alert('success','Marked as read!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
    }

    if(isset($_GET['del']))
    {
        $frm_data = filteration($_GET);

        if($frm_data['del']=='all'){
            $q = "DELETE FROM `user_queries`";
            if(mysqli_query($con,$q)){
                alert('success','All data deleted!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
        else{
            $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
            $values = [$frm_data['del']];
            if(update($q,$values,'i')){
                alert('success','Data deleted!');
            }
            else{
                alert('error','Operation Failed!');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
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
                            <h3>USER FEEDBACK</h3>
                        </div>

                        <!-- Carousel section -->     

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                        
                                <div class="text-end mb-4">
                                    <a href="?seen=all" class="btn btn-primary rounded-pill shadow-none btn-sm">
                                        <i class="bi bi-check-all"></i> Mark all read
                                    </a>
                                    <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                                        <i class="bi bi-trash"></i> Delete all
                                    </a>
                                </div>

                                <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                                    <table class="table table-hover borber table-bordered">
                                        <thead class="striky-top">
                                            <tr class="bg-dark text-light">
                                                <th scope="col">No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col" width="20%">Subject</th>
                                                <th scope="col" width="30%">Message</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                                $data = mysqli_query($con, $q);
                                                $i=1;

                                                while ($row = mysqli_fetch_array($data)) 
                                                {
                                                    $seen='';
                                                    if($row['seen']!=1){
                                                        $seen ="<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as read</a> <br>";
                                                    }
                                                    $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                                                    echo<<<query
                                                        <tr>
                                                            <td>$i</td>
                                                            <td>$row[name]</td>
                                                            <td>$row[email]</td>
                                                            <td>$row[subject]</td>
                                                            <td>$row[message]</td>
                                                            <td>$row[date]</td>
                                                            <td>$seen</td>
                                                        </tr>
                                                    query;
                                                    $i++;
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