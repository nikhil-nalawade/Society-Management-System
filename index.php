<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Management System</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #121212;
            color: #ffffff;
        }

        /* Navbar */
        .navbar {
            background: #1f1f1f;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 3px 10px rgba(255, 255, 255, 0.1);
        }
        .navbar h1 {
            color: #00aaff;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            transition: 0.3s;
        }
        .navbar ul li a:hover {
            background: #00aaff;
            border-radius: 5px;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 50px;
            background: url('images/house.jpg') no-repeat center center/cover;
            height: 350px;
            display: block;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Playfair Display', serif;

             text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
        }
        .hero h2 {
            font-size: 35px;
        }
        .hero p {
            font-size: 18px;
            max-width: 600px;
        }

        /* Features Section */
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px;
            gap: 20px;
        }
        .feature-box {
            background: #1f1f1f;
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            text-align: center;
            box-shadow: 0px 3px 10px rgba(255, 255, 255, 0.1);
        }
        .feature-box img {
            width: 100%;
            height: 200px;
        }
        .feature-box h3 {
            margin: 10px 0;
            font-size: 22px;
            color: #00aaff;
        }
        .feature-box p {
            font-size: 14px;
            padding: 0 10px 15px;
            color: #bbb;
        }

        /* Footer */
        .footer {
            background: #1f1f1f;
            text-align: center;
            padding: 15px;
            color: #bbb;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Society Hub</h1>
        <ul>
            <li><a href="register.php">📝Register</a></li>
            <li><a href="user_login.php">👤User Login</a></li>
            <li><a href="admin_login.php">👨‍💼Admin Login</a></li>
            
        </ul>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <h1>SOCITY HUB</h1>
    
    </div>

    <!-- Features Section -->
    <div class="features">
        <div class="feature-box">
            <img src="images/appartment.jpg" alt="Building">
            <h3>Modern Apartment</h3>
            <p>Our society features state-of-the-art apartment buildings with all amenities.</p>
        </div>

        <div class="feature-box">
            <img src="images/garden3.jpg" alt="Garden">
            <h3>Beautiful Garden</h3>
            <p>Relax and unwind in our lush green gardens with walking tracks and benches.</p>
        </div>

        <div class="feature-box">
            <img src="images/garden2.jpg" alt="Park">
            <h3>Children's Park</h3>
            <p>A safe and fun space for children to play, featuring swings, slides, and more.</p>
        </div>

        <div class="feature-box">
            <img src="images/event.jpg" alt="Event Hall">
            <h3>Event Hall</h3>
            <p>Host your special events in our spacious event hall equipped with modern facilities.</p>
        </div>

        <div class="feature-box">
            <img src="images/swimming.jpg" alt="Swimming Pool">
            <h3>Swimming Pool</h3>
            <p>Enjoy a refreshing swim in our clean and well-maintained swimming pool.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Society Management System. All Rights Reserved.</p>
    </div>

</body>
</html>                     