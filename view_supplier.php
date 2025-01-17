<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Supplier - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Styles */
        .table-container {
            max-width: 1000px;
            margin: 30px auto;
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
            margin-right: 8px; /* Increased space between buttons */
            margin-bottom: 5px; /* Add some bottom margin to avoid vertical stacking issues */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
            display: inline-block; /* Ensure buttons are inline-block */
            text-align: center; /* Center text within buttons */
        }
        .order-button {
            background-color: #3498db; /* Blue */
        }
        .order-button:hover {
            background-color: #2980b9;
        }
        .update-button {
            background-color: #2ecc71; /* Green */
        }
        .update-button:hover {
            background-color: #27ae60;
        }
        .delete-button {
            background-color: #e74c3c; /* Red */
        }
        .delete-button:hover {
            background-color: #c0392b;
        }
        .view-orders-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #8e44ad; /* Purple */
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .view-orders-button:hover {
            background-color: #732d91;
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
        <h2>Supplier View</h2>
        <div class="table-container">
            <?php
            $servername = "localhost"; // Change as needed
            $username = "root"; // Change as needed
            $password = ""; // Change as needed
            $dbname = "db_s"; // Change as needed

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to select data from the suppliers table
            $sql = "SELECT supplier_id, supplier_name, email, address, phone, other_info FROM suppliers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table><tr><th>Supplier ID</th><th>Supplier Name</th><th>Email</th><th>Address</th><th>Phone Number</th><th>Other Info</th><th>Action</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["supplier_id"] . "</td><td>" . $row["supplier_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["other_info"] . "</td><td>
                        <a href='order.php?id=" . $row["supplier_id"] . "' class='action-button order-button'>Order</a> 
                        <a href='update_supplier.php?id=" . $row["supplier_id"] . "' class='action-button update-button'>Update</a>
                        <a href='delete_supplier.php?id=" . $row["supplier_id"] . "' class='action-button delete-button'>Delete</a>
                    </td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No records found.</p>";
            }

            $conn->close();
            ?>
        </div>
        <a href="view_orders.php" class="view-orders-button">View Orders</a>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
