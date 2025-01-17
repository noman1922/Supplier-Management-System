<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report - Supplier Management System</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="main-content">
        <h2>Transaction Report</h2>
        <?php 
        $conn = mysqli_connect("localhost", "root", "", "db_s"); 
        $sql_transactions = "SELECT transaction_id, product_id, supplier_id, amount, date FROM transactions";
        $result_transactions = mysqli_query($conn, $sql_transactions);
        ?>
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>Product ID</th>
                <th>Supplier ID</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_transactions) > 0) {
                while ($row = mysqli_fetch_assoc($result_transactions)) {
                    echo "<tr>
                            <td>" . $row["transaction_id"] . "</td>
                            <td>" . $row["product_id"] . "</td>
                            <td>" . $row["supplier_id"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>" . $row["date"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No transaction records found.</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="footer">
        <p>Created by Md. Abdullah Al Noman Khan, Sec: 'B', ID-23103052.</p>
    </div>
</body>
</html>
