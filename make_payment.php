<?php
session_start();
include 'db.php';

$paymentSuccess = false; // Flag to track successful payment

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    if (!empty($_POST['user_name']) && !empty($_POST['flat_number']) && !empty($_POST['amount'])) {
        $user_name = $conn->real_escape_string($_POST['user_name']);
        $flat_number = $conn->real_escape_string($_POST['flat_number']);
        $amount = floatval($_POST['amount']); // Ensure amount is a valid number

        if ($amount > 0) { // Validate amount is positive
            $stmt = $conn->prepare("INSERT INTO payments (user_name, flat_number, amount, payment_date) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("ssd", $user_name, $flat_number, $amount);

            if ($stmt->execute()) {
                $paymentSuccess = true; // Set flag for popup message
                $_SESSION['form_submitted'] = true; // Mark form as submitted
            }
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
    <title>Make Payment</title>
    <link rel="stylesheet" href="css/payment.css"> <!-- Keep same theme -->
    <script>
        // Show popup message if payment was successful
        <?php if ($paymentSuccess): ?>
            window.onload = function() {
                alert("Payment successful! Thank you for your payment.");
                window.location.href = "make_payment.php"; // Redirect to clear form
            };
        <?php endif; ?>
    </script>
</head>
<body>
    <div class="payment-container">
        <h2>Society Payment Slip</h2>
        <form method="post">
            <label>Full Name:</label>
            <input type="text" name="user_name" placeholder="Full Name" required>

            <label>Flat Number:</label>
            <input type="text" name="flat_number" placeholder="Flat Number" required>

            <label>Amount (₹):</label>
            <input type="number" step="0.01" name="amount" placeholder="Amount" min="1" required>

            <button type="submit">Make Payment</button>
        </form>
        <a href="user_home.php" class="back-btn">Back</a>
    </div>
</body>
</html>
