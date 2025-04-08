<?php
include 'db.php';

// Handle complaint submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['name']) || !isset($_POST['flat_number']) || !isset($_POST['topic']) || !isset($_POST['description'])) {
        echo "<script>alert('Please fill all fields!');</script>";
    } else {
        $name = $_POST['name'];
        $flat_number = $_POST['flat_number'];
        $topic = $_POST['topic'];
        $description = $_POST['description'];

        // Insert complaint data into the database
        $sql = "INSERT INTO complaints (name, flat_number, topic, description) VALUES ('$name', '$flat_number', '$topic', '$description')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Complaint Submitted!'); window.location='submit_complaint.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// Handle complaint deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete complaint from the database
    $delete_sql = "DELETE FROM complaints WHERE id = $id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Complaint deleted successfully!'); window.location='submit_complaint.php';</script>";
    } else {
        echo "<script>alert('Error deleting complaint: " . $conn->error . "');</script>";
    }
}

// Fetch all complaints
$result = $conn->query("SELECT * FROM complaints ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .complaint-box {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        input, textarea {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px;
            background: #333;
            color: white;
            border-radius: 5px;
        }
        .complaint-list {
            margin-top: 20px;
            text-align: left;
            width: 50%;
            margin: auto;
        }
        .complaint-item {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="complaint-box">
        <h2>Submit Complaint</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="flat_number" placeholder="Flat Number" required>
            <input type="text" name="topic" placeholder="Complaint Topic" required>
            <textarea name="description" placeholder="Complaint Description" rows="4" required></textarea>
            <button type="submit">Submit Complaint</button>
        </form>
        <a href="user_home.php"> back</a>
    </div>

    <div class="complaint-list">
        <h2>Your Complaints</h2>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="complaint-item">
                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                <p><strong>Flat Number:</strong> <?php echo $row['flat_number']; ?></p>
                <p><strong>Topic:</strong> <?php echo $row['topic']; ?></p>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                <a href="submit_complaint.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this complaint?');">
                    <button class="delete-btn">Delete</button>
                </a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
