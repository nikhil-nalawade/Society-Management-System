<?php
include 'db.php';

// Handle complaint deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Ensure ID is an integer to prevent SQL injection

    // Check if complaint exists before deleting
    $check = $conn->query("SELECT * FROM complaints WHERE id = $id");
    if ($check->num_rows > 0) {
        $conn->query("DELETE FROM complaints WHERE id = $id");
        echo "<script>alert('Complaint deleted successfully!'); window.location='view_complaints.php';</script>";
    } else {
        echo "<script>alert('Complaint not found!');</script>";
    }
}

// Fetch complaints
$result = $conn->query("SELECT * FROM complaints ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .complaints-container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .complaint-box {
            border: 1px solid #ddd;
            background: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: left;
        }
        .complaint-box strong {
            color: #333;
        }
       
        .back-btn {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px;
            background: #333;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="complaints-container">
        <h2>View Complaints</h2>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="complaint-box">
                <p><strong>Name:</strong> <?php echo isset($row['name']) ? $row['name'] : 'N/A'; ?></p>
                <p><strong>Flat Number:</strong> <?php echo isset($row['flat_number']) ? $row['flat_number'] : 'N/A'; ?></p>
                <p><strong>Topic:</strong> <?php echo $row['topic']; ?></p>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                <a href="view_complaints.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this complaint?');">
                    
                </a>
            </div>
        <?php } ?>
        <a href="admin_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
