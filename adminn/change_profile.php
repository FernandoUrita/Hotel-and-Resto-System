<?php
  require 'inc/essentials.php';
  require 'inc/db_config.php';
  adminLogin();

  // Display messages if available
if (isset($_SESSION['message'])) {
  echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
  unset($_SESSION['message']); // Remove after displaying
}

if (isset($_SESSION['error'])) {
  echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
  unset($_SESSION['error']); // Remove after displaying
}
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
<?php require 'inc/links.php'; ?>

</head>
<body>

    <div class="wrapper">
      <?php require 'inc/header.php' ?>
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
              <h3>My account</h3>
            </div>
            <div class="container-fluid d-flex align-items-center">
              <div class="row">
              <div class="col-lg-7 col-md-10 p-4 card">
                <h1 class="display-2">Hello <?php echo $_SESSION['admin_name']; ?></h1>
                <p class="mt-0 mb-5">This is your profile page. You can customize your profile as you want And also change password too</p>
              </div>
              </div>
            </div>

            <div class="container-fluid d-flex align-items-center">
              <div class="col-lg-7 col-md-10 p-4 card">
                <h3>Change Profile</h3>
                <form action="change_name.php" method="POST">
                  <input type="text" name="new_admin_name" placeholder="<?php echo $_SESSION['admin_name']; ?>" required><br>
                  <button type="submit" class="btn btn-success form-control-alternative mt-2">Update Name</button>
                </form>
                <h3>Change Password</h3>
                <form action="change_password.php" method="POST">
                  <input class="mb-2" type="password" name="current_password" placeholder="Current Password" required><br>
                  <input class="mb-2" type="password" name="new_password" placeholder="New Password" required><br>
                  <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
                  

                  <button type="submit" class="btn btn-success form-control-alternative mt-2">Change Password</button>
                </form>


              </div>

            
          </div>
        
        <a href="#" class="theme-toggle">
          <i class="bi bi-moon"></i>
          <i class="bi bi-sun"></i>
        </a>
      </div>
    </div>
    


<!-- SCRIPT.PHP -->
    <?php require 'inc/scripts.php'; ?>
    
    <script src="scripts/script.js"></script>
    
</body>
</html>