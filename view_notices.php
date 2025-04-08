<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM notices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: view_notices.php"); // Refresh page after deletion
    exit();
}

$result = $conn->query("SELECT * FROM notices ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notices</title>
    <link rel="stylesheet" href="css/notice.css">
</head>
<body>
    <div class="container">
        <h2>Notice Board</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Notice Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><a href="view_notices.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
        <a href="user_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
