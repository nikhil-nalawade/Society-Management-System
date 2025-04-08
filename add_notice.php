<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$noticeAdded = false; // Flag to track notice creation

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    if (!empty($_POST['title']) && !empty($_POST['description'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $description = $conn->real_escape_string($_POST['description']);

        $stmt = $conn->prepare("INSERT INTO notices (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);

        if ($stmt->execute()) {
            $noticeAdded = true; // Set flag for popup message
            $_SESSION['form_submitted'] = true; // Mark form as submitted
        }
    }
}

// Unset form submission flag on page load
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    unset($_SESSION['form_submitted']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
    <link rel="stylesheet" href="css/notice.css"> <!-- Keep same theme -->
    <script>
        // Show popup message if notice was successfully added
        <?php if ($noticeAdded): ?>
            window.onload = function() {
                alert("Notice created successfully!");
                window.location.href = "add_notice.php"; // Redirect to clear form
            };
        <?php endif; ?>
    </script>
</head>
<body>
    <div class="container">
        <h2>Add Notice</h2>
        <form method="post">
            <input type="text" name="title" placeholder="Notice Title" required>
            <textarea name="description" placeholder="Notice Description" required></textarea>
            <button type="submit">Add Notice</button>
        </form>
        <a href="admin_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
