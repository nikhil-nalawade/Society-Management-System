<?php
session_start();
include 'db.php';



// Fetch images from the gallery
$result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Gallery</title>
    <link rel="stylesheet" href="css/img.css">
</head>
<body>
    <div class="gallery-container">
        <h2>Image Gallery</h2>
        <div class="gallery-grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="gallery-item">
                    <img src="<?php echo $row['image_path']; ?>" alt="Gallery Image">
                </div>
            <?php } ?>
        </div>
        <a href="user_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
