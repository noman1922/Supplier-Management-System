<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_s";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Dhaka'); // Set the correct timezone

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_id = $_POST["supplier_id"];
    $supplier_name = $_POST["supplier_name"];
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];
    $total_price = $_POST["total_price"];
    $payment_method = $_POST["payment_method"];
    $transaction_date = date('Y-m-d H:i:s');

    // Insert transaction details into the transactions table
    $sql = "INSERT INTO transactions (supplier_id, supplier_name, product_id, product_name, quantity, unit_price, total_price, payment_method, transaction_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisiddss", $supplier_id, $supplier_name, $product_id, $product_name, $quantity, $unit_price, $total_price, $payment_method, $transaction_date);

    if ($stmt->execute()) {
        $transaction_id = $stmt->insert_id;
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
} else {
    echo "No data received.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt - Supplier Management System</title>
    <style>
        table {
            width: 70%;
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 18px;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .container h1, .container h2, .container p {
            margin: 20px 0;
        }
        .container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .container button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Supplier Management System</h1>
        <h2>Payment Receipt</h2>
        <p>Transaction ID: <?php echo uniqid(); ?></p>
        <p>Date: <?php echo date('Y-m-d H:i:s'); ?></p>
        <table>
            <tr>
                <th>Product</th>
                <th>Supplier Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($product_name); ?></td>
                <td><?php echo htmlspecialchars($supplier_name); ?></td>
                <td><?php echo htmlspecialchars($quantity); ?></td>
                <td>TK <?php echo htmlspecialchars($unit_price); ?></td>
                <td>TK <?php echo htmlspecialchars($total_price); ?></td>
            </tr>
            <tr>
                <th colspan="4">Paid Amount</th>
                <td>TK <?php echo htmlspecialchars($total_price); ?></td>
            </tr>
        </table>
        <p>Payment Method: <?php echo htmlspecialchars($payment_method); ?></p>
        <p>Created by Md. Abdullah Al Noman Khan. ID-23103052.</p>
        <button onclick="window.print()">Print Receipt</button>
    </div>
</body>
</html>
