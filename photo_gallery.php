<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Ensure the "uploads" folder exists
$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image_name = basename($_FILES["image"]["name"]);
    $image_path = $upload_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
        $conn->query("INSERT INTO gallery (image_path) VALUES ('$image_path')");
    } else {
        echo "<script>alert('Failed to upload image. Check folder permissions!');</script>";
    }
}

// Handle image deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Get the image path from the database
    $result = $conn->query("SELECT image_path FROM gallery WHERE id = $id");
    $row = $result->fetch_assoc();
    
    if ($row) {
        unlink($row['image_path']); // Delete the image file
        $conn->query("DELETE FROM gallery WHERE id = $id"); // Remove from database
        echo "<script>alert('Image deleted successfully!'); window.location='photo_gallery.php';</script>";
    }
}

// Fetch images
$result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Photo Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .gallery-container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .upload-form {
            margin-bottom: 20px;
        }
        .upload-form input,
        .upload-form button {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .gallery-item {
            position: relative;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background: white;
        }
        .gallery-item img {
            max-width: 100%;
            height: auto; /* Keeps original size */
            display: block;
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
            border-radius: 50%;
        }
        .back-btn {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="gallery-container">
        <h2>Photo Gallery</h2>
        <form method="post" enctype="multipart/form-data" class="upload-form">
            <input type="file" name="image" required>
            <button type="submit">Upload</button>
        </form>
        <div class="gallery-grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="gallery-item">
                    <img src="<?php echo $row['image_path']; ?>" alt="Gallery Image">
                    <a href="photo_gallery.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this image?');">
                        <button class="delete-btn">X</button>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a href="admin_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
