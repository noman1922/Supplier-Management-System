<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-container h2 {
            color: #FFF;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container input[type="submit"],
        .form-container input[type="number"] {
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
        <form class="form-container" action="insert_product.php" method="POST">
            <h2>Insert Product</h2>
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="text" name="supplier_id" placeholder="Supplier ID" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <input type="number" name="unit_price" placeholder="Unit Price" required>
            <input type="submit" value="Insert Product">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_s";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $product_name = $_POST['product_name'];
            $supplier_id = $_POST['supplier_id'];
            $quantity = $_POST['quantity'];
            $unit_price = $_POST['unit_price'];

            $sql = "INSERT INTO products (product_name, supplier_id, quantity, unit_price) VALUES ('$product_name', '$supplier_id', '$quantity', '$unit_price')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>New product inserted successfully!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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
