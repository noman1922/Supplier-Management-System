<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$message = "";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $supplier_id = intval($_GET['id']);

    // Delete related transactions first
    $delete_transactions_sql = "DELETE FROM transactions WHERE product_id IN (SELECT product_id FROM products WHERE supplier_id='$supplier_id')";
    if ($conn->query($delete_transactions_sql) === TRUE) {
        // Delete related orders next
        $delete_orders_sql = "DELETE FROM orders WHERE supplier_id='$supplier_id'";
        if ($conn->query($delete_orders_sql) === TRUE) {
            // Delete related products next
            $delete_products_sql = "DELETE FROM products WHERE supplier_id='$supplier_id'";
            if ($conn->query($delete_products_sql) === TRUE) {
                // SQL query to delete the supplier
                $delete_supplier_sql = "DELETE FROM suppliers WHERE supplier_id='$supplier_id'";
                if ($conn->query($delete_supplier_sql) === TRUE) {
                    $message = "<p>Supplier deleted successfully!</p>";
                } else {
                    $message = "Error: " . $delete_supplier_sql . "<br>" . $conn->error;
                }
            } else {
                $message = "Error: " . $delete_products_sql . "<br>" . $conn->error;
            }
        } else {
            $message = "Error: " . $delete_orders_sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Error: " . $delete_transactions_sql . "<br>" . $conn->error;
    }
} else {
    $message = "<p>No supplier ID provided.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supplier - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .message {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            color: green;
            font-size: 1.2em;
        }

        .back-link {
            margin-top: 20px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>Supplier Management System</h1>
        <div class="nav">
            <a href="home.php">Home</a>
            <div class="dropdown">
                <a href="javascript:void(0)">Insert &#9662;</a>
                <div class="dropdown-content">
                    <a href="insert_supplier.php">Insert Supplier</a>
                    <a href="insert_product.php">Insert Product</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0)">View &#9662;</a>
                <div class="dropdown-content">
                    <a href="view_supplier.php">View Supplier</a>
                    <a href="view_product.php">View Product</a>
                </div>
            </div>
            <a href="search.php">Search</a>
            <a href="report.php">Report</a>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <h2>Delete Supplier</h2>
        <?php if (!empty($message)) { echo '<div class="message">' . $message . '</div>'; } ?>
        <div class="back-link">
            <a href="view_supplier.php">Back to Supplier List</a>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
