<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            position: relative;
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
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(51, 51, 51, 0.9);
            min-width: 160px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .dropdown-content a {
            color: white;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: rgba(87, 87, 87, 0.8);
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .footer {
            background-color: rgba(51, 51, 51, 0.8);
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid white;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #FFD700;
            color: black;
        }
        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.2);
        }
        h2 {
            margin-bottom: 20px;
            color: #ffffff;
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
        <h2>Supplier View</h2>
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

// SQL query to select data from the suppliers table
$sql = "SELECT supplier_id, supplier_name, email, address, phone, other_info FROM suppliers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Supplier ID</th><th>Supplier Name</th><th>Email</th><th>Address</th><th>Phone Number</th><th>Other Info</th><th>Action</th></tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["supplier_id"] . "</td><td>" . $row["supplier_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["other_info"] . "</td><td><a href='order.php'>Order</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

$conn->close();
?>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
