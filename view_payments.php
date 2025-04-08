<?php
include 'db.php';

// Fetch payment data
$sql = "SELECT * FROM payments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Payment Details</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Flat Number</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = isset($row['user_name']) ? $row['user_name'] : "N/A"; 
                $flat_number = isset($row['flat_number']) ? $row['flat_number'] : "N/A";
                $amount = isset($row['amount']) ? $row['amount'] : "N/A";
                $date = isset($row['payment_date']) ? $row['payment_date'] : "N/A";

                echo "<tr>
                        <td>$name</td>
                        <td>$flat_number</td>
                        <td>$amount</td>
                        <td>$date</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No payments found</td></tr>";
        }
        ?>
    </table>
</div>
<a href="admin_home.php">back</a>
</body>
</html>



