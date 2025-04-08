<?php  
session_start();
include 'db.php';  

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: user_login.php");
    exit();
}

// Get user details from database using email
$user_email = $_SESSION['user_email'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    die("Error: User details not found in the database.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/user.css">
    <style>
        /* Dashboard Content */
.dashboard-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.dashboard-content h3 {
    border-bottom: 3px solid #f39c12;
    padding-bottom: 10px;
    margin-bottom: 20px;
    color: #333;
    font-size: 22px;
}

/* Profile Table */
.dashboard-content table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.dashboard-content table td {
    padding: 12px;
    border: 1px solid #ddd;
    font-size: 16px;
}

.dashboard-content table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.dashboard-content strong {
    color: #2c3e50;
}

/* Society Information */
.society-info {
    background: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.society-info p {
    font-size: 16px;
    margin: 10px 0;
    color: #2c3e50;
}

.society-info strong {
    color: #2c3e50;
    font-weight: bold;
}

    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="logo">SOCIETY <span class="highlight">HUB</span></h2>
        <div class="user-info">
             
            <p><?php echo htmlspecialchars($userData['name']); ?></p>
        </div>
        <ul>
        <ul>
  <li> <a href="view_notices.php"> 📢View Notices</a></li>
  <li> <a href="make_payment.php"> 💸Make Payment</a></li>
  <li> <a href="view_gallery.php"> 📸Photo Gallery</a></li>
  <li> <a href="submit_complaint.php"> 📝 Complaint Here</a></li>
</ul>

        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h2>Welcome, <?php echo htmlspecialchars($userData['name']); ?>!</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="dashboard-content">
            <h3>Your Profile</h3>
            <table border="1" cellpadding="10">
                <tr><td><strong>Full Name:</strong></td><td><?php echo htmlspecialchars($userData['name']); ?></td></tr>
                <tr><td><strong>Flat Number:</strong></td><td><?php echo htmlspecialchars($userData['flat_number']); ?></td></tr>
                <tr><td><strong>Email:</strong></td><td><?php echo htmlspecialchars($userData['email']); ?></td></tr>
                <tr><td><strong>Mobile Number:</strong></td><td><?php echo htmlspecialchars($userData['mobile_no']); ?></td></tr>
                <tr><td><strong>Family Members:</strong></td><td><?php echo htmlspecialchars($userData['family_members']); ?></td></tr>
            </table>

            <h3>Society Information</h3>
            <p><strong>Society Name:</strong> Green Park Apartments</p>
            <p><strong>Established:</strong> 2005</p>
            <p><strong>Contact:</strong> +91-9876543210</p>
            <p><strong>Address:</strong> 123, Green Street, City, Country</p>
        </div>
    </div>
</body>
</html>
