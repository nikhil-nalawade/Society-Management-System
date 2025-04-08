<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Function to check if a user exists
function userExists($conn, $id) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

// Approve user with validation
if (isset($_GET['approve']) && is_numeric($_GET['approve'])) {
    $id = intval($_GET['approve']);
    
    if (userExists($conn, $id)) {
        $stmt = $conn->prepare("UPDATE users SET is_approved = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

// Delete user with validation
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    if (userExists($conn, $id)) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

// Fetch users securely
$stmt = $conn->prepare("SELECT id, name, flat_number, email, mobile_no, is_approved FROM users");
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Manage Members</h2>";
echo "<table border='1'><tr><th>Name</th><th>Flat No</th><th>Email</th><th>Mobile</th><th>Approve</th><th>Delete</th></tr>";

while ($row = $result->fetch_assoc()) {
    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['name']);
    $flat = htmlspecialchars($row['flat_number']);
    $email = htmlspecialchars($row['email']);
    $mobile = htmlspecialchars($row['mobile_no']);
    $approved = $row['is_approved'] ? "✔ Approved" : "<a href='?approve=$id' onclick='return confirm(\"Approve this user?\")'>Approve</a>";

    echo "<tr>
        <td>$name</td>
        <td>$flat</td>
        <td>$email</td>
        <td>$mobile</td>
        <td>$approved</td>
        <td><a href='?delete=$id' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>
    </tr>";
}

echo "</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
        }
        a[href*="approve"] {
            background-color: #28a745;
            color: white;
        }
        a[href*="approve"]:hover {
            background-color: #218838;
        }
        a[href*="delete"] {
            background-color: #dc3545;
            color: white;
        }
        a[href*="delete"]:hover {
            background-color: #c82333;
        }
        a[href="admin_home.php"] {
            display: block;
            width: fit-content;
            margin: 20px auto;
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a[href="admin_home.php"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a href="admin_home.php">Back</a>
</body>
</html>
