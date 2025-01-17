<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
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

// Initialize message variable
$message = "";

// Check if the ID is set and valid
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $supplier_id = intval($_GET['id']); // Ensure it's an integer

    // Fetch current supplier information
    $sql = "SELECT * FROM suppliers WHERE supplier_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $message = "<p>Supplier not found.</p>";
    }
} else {
    $message = "<p>No supplier ID provided.</p>";
}

// Update supplier information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $other_info = $_POST['other_info'];

    $update_sql = "UPDATE suppliers SET supplier_name=?, email=?, address=?, phone=?, other_info=? WHERE supplier_id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $supplier_name, $email, $address, $phone, $other_info, $supplier_id);

    if ($update_stmt->execute()) {
        $message = "<p>Supplier updated successfully.</p>";
        header("Location: view_supplier.php");
        exit();
    } else {
        $message = "Error updating supplier: " . $update_stmt->error;
    }
    $update_stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7); /* Dark, semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-container h2 {
            color: #FFF;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container textarea,
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
        <form class="form-container" method="post" action="">
            <h2>Update Supplier</h2>
            <input type="hidden" name="supplier_id" value="<?php echo $row['supplier_id']; ?>">
            <label for="supplier_name">Supplier Name:</label>
            <input type="text" name="supplier_name" value="<?php echo htmlspecialchars($row['supplier_name']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            
            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
            
            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
            
            <label for="other_info">Other Info:</label>
            <textarea name="other_info"><?php echo htmlspecialchars($row['other_info']); ?></textarea>
            
            <input type="submit" value="Update">
            <?php if (!empty($message)) { echo '<div class="message">' . $message . '</div>'; } ?>
        </form>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
