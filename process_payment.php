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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $supplier_id = isset($_GET["supplier_id"]) ? $_GET["supplier_id"] : null;
    $product_id = isset($_GET["product_id"]) ? $_GET["product_id"] : null;
    $product_name = isset($_GET["product_name"]) ? $_GET["product_name"] : null;
    $quantity = isset($_GET["quantity"]) ? $_GET["quantity"] : null;
    $unit_price = isset($_GET["unit_price"]) ? $_GET["unit_price"] : null;

    if ($supplier_id && $product_id && $product_name && $quantity && $unit_price) {
        $total_price = $quantity * $unit_price;

        // Fetch supplier name from the database
        $sql = "SELECT supplier_name FROM suppliers WHERE supplier_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $supplier_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $supplier_name = $row["supplier_name"];
        } else {
            echo "Supplier not found.";
            exit;
        }
    } else {
        echo "Missing required parameters.";
        exit;
    }
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
    <title>Supplier Management System</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('p.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #ffffff;
            text-align: center;
        }
        .header {
            background-color: rgba(51, 51, 51, 0.9);
            color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        .header h1 {
            margin: 0;
            font-size: 3em;
        }
        .nav {
            margin-top: 10px;
        }
        .header a {
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 1.1em;
            margin: 0 10px;
        }
        .header a:hover {
            background-color: rgba(87, 87, 87, 0.8);
        }
        .main-content {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: left;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #ffffff;
                }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }
        .form-container button {
            background-color: #16a085;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #138567;
        }
        .footer {
            background-color: rgba(51, 51, 51, 0.9);
            color: white;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>Supplier Management System</h1>
        <div class="nav">
            <a href="home.php">Home</a>
            <a href="insert.php">Insert</a>
            <a href="view.php">View</a>
            <a href="search.php">Search</a>
            <a href="report.php">Report</a> 
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="main-content">
        <h2>Total Price: TK <?php echo $total_price; ?></h2>
        <form action="payment_receipt.php" method="POST">
            <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>">
            <input type="hidden" name="supplier_name" value="<?php echo htmlspecialchars($supplier_name); ?>">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            <input type="hidden" name="unit_price" value="<?php echo htmlspecialchars($unit_price); ?>">
            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
            <button type="submit">Pay</button>
        </form>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan. ID-23103052.</p>
    </div>
</body>
</html>
