<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Styles */
        table {
            width: 100%;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
            text-align: left;
        }
        th {
            background-color: #FFD700; /* Gold */
            color: black;
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.2);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-container input[type="text"],
        .form-container select,
        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }

        .form-container input[type="submit"] {
            background-color: #3498db;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .form-container p {
            color: #333;
        }

        .message {
            margin-top: 20px;
            color: green;
            font-size: 1.2em;
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
        <h2>Search</h2>
        <form class="form-container" action="search.php" method="GET">
            <select name="search_type" required>
                <option value="">Select Search Type</option>
                <option value="supplier">Supplier</option>
                <option value="product">Product</option>
            </select>
            <input type="text" name="query" placeholder="Enter ID..." required>
            <input type="submit" value="Search">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query']) && isset($_GET['search_type'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_s";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = $_GET['query'];
            $search_type = $_GET['search_type'];

            if ($search_type == 'supplier') {
                // Search suppliers by ID
                $sql_suppliers = "SELECT supplier_id, supplier_name, email, address, phone, other_info FROM suppliers WHERE supplier_id = '$query'";
                $result_suppliers = $conn->query($sql_suppliers);

                if ($result_suppliers->num_rows > 0) {
                    echo "<h2>Supplier Results</h2>";
                    echo "<table><tr><th>Supplier ID</th><th>Supplier Name</th><th>Email</th><th>Address</th><th>Phone Number</th><th>Other Info</th></tr>";
                    while ($row = $result_suppliers->fetch_assoc()) {
                        echo "<tr><td>" . $row["supplier_id"] . "</td><td>" . $row["supplier_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["other_info"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No supplier records found.</p>";
                }
            } elseif ($search_type == 'product') {
                // Search products by ID
                $sql_products = "SELECT product_id, product_name, supplier_id, quantity, unit_price FROM products WHERE product_id = '$query'";
                $result_products = $conn->query($sql_products);

                if ($result_products->num_rows > 0) {
                    echo "<h2>Product Results</h2>";
                    echo "<table><tr><th>Product ID</th><th>Product Name</th><th>Supplier ID</th><th>Quantity</th><th>Unit Price</th></tr>";
                    while ($row = $result_products->fetch_assoc()) {
                        echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["product_name"] . "</td><td>" . $row["supplier_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["unit_price"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No product records found.</p>";
                }
            }

            $conn->close();
        }
        ?>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
