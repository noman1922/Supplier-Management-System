<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
   <style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
        border: 1px solid #ddd;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"], input[type="number"], input[type="date"], button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #3498db;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #2980b9;
    }

    .supplier-id {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
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

    <div class="container">
        <h1>Place Order</h1>

        <?php
        // Retrieve supplier ID from the query string
        if (isset($_GET['id'])) {
            $supplier_id = intval($_GET['id']);
        } else {
            die("<p>Supplier ID not provided. <a href='view_supplier.php'>Go Back</a></p>");
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_s";

            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve form data
            $product_name = $conn->real_escape_string($_POST['product_name']);
            $quantity = intval($_POST['quantity']);
            $order_date = $conn->real_escape_string($_POST['order_date']);

            // Insert data into the orders table
            $sql = "INSERT INTO orders (supplier_id, product_name, quantity, order_date) 
                    VALUES ('$supplier_id', '$product_name', '$quantity', '$order_date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Order Sended successfully by Email! <a href='view_supplier.php'>Go Back to Supplier List</a></p>";
            } else {
                echo "<p>Error placing order: " . $conn->error . "</p>";
            }

            $conn->close();
        } else {
            // Display the form
            ?>
            <!-- Display the supplier ID -->
            <div class="supplier-id">Supplier ID: <?php echo $supplier_id; ?></div>

            <!-- Order form -->
            <form method="POST" action="">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" placeholder="Enter product name" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="1" required>

                <label for="order_date">Order Date:</label>
                <input type="date" id="order_date" name="order_date" required>

                <button type="submit">Place Order</button>
            </form>
        <?php
        }
        ?>
    </div>

    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
