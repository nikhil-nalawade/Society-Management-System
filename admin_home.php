<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">  <!-- External CSS file -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Dark Theme */
body {
    background-color: #121212;
    color: #fff;
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 0;
    padding: 0;
}

.dashboard-container {
    padding: 20px;
}

h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Card Styling */
.card-container {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.card {
    background-color: #1e1e1e;
    border-radius: 10px;
    padding: 20px;
    width: 250px;
    box-shadow: 2px 2px 10px rgba(255, 255, 255, 0.1);
}

.card h3 {
    margin: 0;
    font-size: 18px;
    color: #00adb5; /* Accent Color */
}

.card p {
    margin: 10px 0 0;
    font-size: 16px;
    color: #ccc;
}

    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="logo">SOCIETY <span class="highlight">HUB</span></h2>
    

  <!-- Placeholder for profile image -->
            <p><?php echo $_SESSION['admin']; ?></p> 
            <div class="admin-info">
        </div>
        <ul>
        <ul>
    <li><a href="manage_members.php">👥 <i class="fas fa-users"></i> Manage Members</a></li>
    <li><a href="add_notice.php">📢 <i class="fas fa-bullhorn"></i> Add Notice</a></li>
    <li><a href="view_payments.php">💳 <i class="fas fa-money-check-alt"></i> View Payments</a></li>
    <li><a href="photo_gallery.php">🖼️ <i class="fas fa-images"></i> Manage Photo Gallery</a></li>
    <li><a href="view_complaint.php">⚠️ <i class="fas fa-exclamation-triangle"></i> Complaints</a></li>
</ul>

        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h2>Welcome, Admin!</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

       
 
    <div class="dashboard-container">
        <h2>Welcome to Dashboard</h2>
        
        <div class="card-container">
            <div class="card">
                <h3>Name: Ayush Mane</h3>
                <p>Flat No: 101</p>
            </div>  

            <div class="card">
                <h3>Name: Nikhil Nalawade</h3>
                <p>Flat No: 102</p>
            </div>
        </div>
    </div>

        </div>
    </div>
</body>
</html>
