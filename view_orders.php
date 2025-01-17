<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Supplier Management System</title>
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
        .container {
            margin-left: auto;
            margin-right: auto;
        }
        .print-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .print-button:hover {
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
                <a href="javascript:void(0)">Insert &#9662;</a> <!-- Dropdown sign -->
                <div class="dropdown-content">
                    <a href="insert_supplier.php">Insert Supplier</a>
                    <a href="insert_product.php">Insert Product</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0)">View &#9662;</a> <!-- Dropdown sign -->
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
        <h2>Order View</h2>
        <div class="table-container">
            <?php 
            $conn = mysqli_connect("localhost", "root", "", "db_s"); 

            // Fetch order data
            $sql_orders = "SELECT order_id, supplier_id, product_name, quantity, order_date FROM orders";
            $result_orders = mysqli_query($conn, $sql_orders);
            ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Supplier ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                </tr>
                <?php
                if (mysqli_num_rows($result_orders) > 0) {
                    while ($row = mysqli_fetch_assoc($result_orders)) {
                        echo "<tr>
                                <td>" . $row["order_id"] . "</td>
                                <td>" . $row["supplier_id"] . "</td>
                                <td>" . $row["product_name"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>" . $row["order_date"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No order records found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <button class="print-button" onclick="window.print()">Print</button>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
