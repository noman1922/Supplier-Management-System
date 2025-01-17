<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Styles */
        .table-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px; /* Rounded corners */
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            color: white; /* White text for better contrast */
        }
        th {
            background-color: #FFD700; /* Gold */
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.2);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .action-button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            background-color: #3498db;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            background-color: #2980b9;
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
        <h2>Product View</h2>
        <div class="table-container">
            <?php
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

            // SQL query to select data from the products table
            $sql = "SELECT product_id, product_name, supplier_id, quantity, unit_price FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table><tr><th>Product ID</th><th>Product Name</th><th>Supplier ID</th><th>Quantity</th><th>Unit Price</th><th>Action</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["product_name"] . "</td><td>" . $row["supplier_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["unit_price"] . "</td><td>
                        <a href='process_payment.php?supplier_id=" . $row["supplier_id"] . "&product_id=" . $row["product_id"] . "&product_name=" . urlencode($row["product_name"]) . "&quantity=" . $row["quantity"] . "&unit_price=" . $row["unit_price"] . "' class='action-button'>Pay</a>
                    </td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No records found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
