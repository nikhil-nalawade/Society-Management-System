<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $flat_number = $_POST['flat_number'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobile_no'];
    $family_members = $_POST['family_members'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_approved = 0; // Default: waiting for admin approval

    // Secure insertion using prepared statements
    $sql = "INSERT INTO users (name, flat_number, email, mobile_no, family_members, password, is_approved) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $name, $flat_number, $email, $mobile_no, $family_members, $password, $is_approved);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Waiting for admin approval.'); window.location='user_login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s ease-in-out;
        }
        button:hover {
            background: #0056b3;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="flat_number" placeholder="Flat Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="mobile_no" placeholder="Mobile Number" required>
            <input type="number" name="family_members" placeholder="No. of Family Members" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
